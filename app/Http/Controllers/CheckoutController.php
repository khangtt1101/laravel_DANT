<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

class CheckoutController extends Controller
{
    /**
     * Hiển thị trang thanh toán.
     */
    public function index()
    {
        // Lấy giỏ hàng checkout từ session
        $checkoutCart = session('checkout_cart', []);

        // Nếu giỏ hàng checkout rỗng, quay lại trang giỏ hàng
        if (count($checkoutCart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Vui lòng chọn sản phẩm để thanh toán.');
        }

        // Lấy voucher từ session checkout (nếu có)
        $checkoutVoucher = session('checkout_voucher');
        $checkoutVoucherDiscount = session('checkout_voucher_discount', 0);
        $checkoutTotal = session('checkout_total', 0);
        $finalTotal = max(0, $checkoutTotal - $checkoutVoucherDiscount);

        return view('checkout.index', compact('checkoutVoucher', 'checkoutVoucherDiscount', 'checkoutTotal', 'finalTotal'));
    }

    /**
     * Xử lý việc đặt hàng.
     */
    public function placeOrder(Request $request)
    {
        // 1. Validate input
        $validated = $request->validate([
            'user_address_id' => 'required|exists:user_addresses,id',
            'payment_method' => 'required|string|in:COD,MoMo',
        ]);

        // 2. Lấy dữ liệu từ Session
        $checkoutCart = session('checkout_cart', []);
        $totalPrice = session('checkout_total', 0);
        $user = $request->user();
        
        // Lấy voucher từ session checkout (nếu có)
        $appliedVoucher = session('checkout_voucher');
        $voucherDiscount = session('checkout_voucher_discount', 0);
        $voucherCode = null;
        $finalAmount = $totalPrice;
        
        if ($appliedVoucher && isset($appliedVoucher['id'])) {
            $voucher = Voucher::find($appliedVoucher['id']);
            if ($voucher) {
                // Validate lại voucher trước khi đặt hàng
                $validation = $voucher->isValid($user, $totalPrice);
                if ($validation['valid']) {
                    $voucherDiscount = $voucher->calculateDiscount($totalPrice);
                    $finalAmount = max(0, $totalPrice - $voucherDiscount);
                    $voucherCode = $voucher->code;
                } else {
                    // Nếu voucher không hợp lệ, bỏ qua
                    $voucherDiscount = 0;
                    $appliedVoucher = null;
                }
            }
        }

        // Lấy chi tiết địa chỉ
        $address = UserAddress::find($validated['user_address_id']);
        // Đảm bảo địa chỉ này thuộc về user đang đăng nhập
        if ($address->user_id !== $user->id) {
            return back()->with('error', 'Địa chỉ không hợp lệ.');
        }

        // Bắt đầu Transaction
        DB::beginTransaction();

        try {
            // 3. Tạo Đơn hàng (Order)
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $finalAmount, // Tổng tiền sau khi giảm giá
                'status' => 'pending', // Trạng thái mặc định
                'shipping_address' => sprintf(
                    "%s, %s, %s.",
                    $address->address_line,
                    $address->district,
                    $address->city
                ),
                'payment_method' => $validated['payment_method'],
                'voucher_code' => $voucherCode,
                'discount_amount' => $voucherDiscount,
            ]);

            // 4. Tạo các Chi tiết Đơn hàng (Order Items)
            foreach ($checkoutCart as $productId => $details) {
                $product = Product::find($productId);
                
                // (Nâng cao) Kiểm tra tồn kho
                if ($product->stock_quantity < $details['quantity']) {
                    throw new \Exception('Sản phẩm ' . $product->name . ' không đủ hàng.');
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
                
                // (Nâng cao) Trừ kho
                $product->decrement('stock_quantity', $details['quantity']);
            }
            
            // 4.5. Nếu có voucher, tạo VoucherUsage và cập nhật số lần sử dụng
            if ($voucherCode && $voucher) {
                VoucherUsage::create([
                    'voucher_id' => $voucher->id,
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'discount_amount' => $voucherDiscount,
                ]);
                
                // Tăng số lần đã sử dụng
                $voucher->increment('used_count');
            }
            
            // 5. Commit Transaction
            DB::commit();

            // 6. Xóa session checkout và voucher
            session()->forget(['checkout_cart', 'checkout_total', 'checkout_voucher', 'checkout_voucher_discount', 'applied_voucher', 'voucher_discount']);

            // 7. Gửi email xác nhận đơn hàng
            try {
                $order->load(['items.product', 'user']);
                Mail::to($user->email)->send(new OrderPlaced($order));
            } catch (\Exception $mailException) {
                // Log lỗi gửi email nhưng không làm gián đoạn quá trình đặt hàng
                Log::error('Lỗi gửi email xác nhận đơn hàng: ' . $mailException->getMessage());
            }

            // 8. Chuyển hướng đến trang Thành công
            // Truyền ID đơn hàng để hiển thị
            return redirect()->route('checkout.success')->with('order_id', $order->id);

        } catch (\Exception $e) {
            // 9. Nếu có lỗi, rollback
            DB::rollBack();
            Log::error('Lỗi đặt hàng: ' . $e->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi khi đặt hàng: ' . $e->getMessage());
        }
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
        ]);

        $validated['user_id'] = $request->user()->id;

        // (Tùy chọn: bạn có thể set địa chỉ mới này làm mặc định)
        // $request->user()->addresses()->update(['is_default' => false]);
        // $validated['is_default'] = true;

        $newAddress = UserAddress::create($validated);

        // Trả về địa chỉ mới dưới dạng JSON
        return response()->json([
            'success' => true,
            'newAddress' => $newAddress
        ]);
    }

    /**
     * Hiển thị trang đặt hàng thành công.
     */
    public function success()
    {
        $orderId = session('order_id');
        if (!$orderId) {
            return redirect()->route('shop.index');
        }

        $order = Order::find($orderId);
        
        return view('checkout.success', compact('order'));
    }
}
