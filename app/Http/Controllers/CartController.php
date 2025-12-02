<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Hiển thị trang giỏ hàng.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;

        // Tính tổng tiền
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Lấy voucher đã áp dụng (nếu có)
        $appliedVoucher = session()->get('applied_voucher');
        $discountAmount = 0;
        $finalPrice = $totalPrice;

        if ($appliedVoucher) {
            $voucher = \App\Models\Voucher::where('code', $appliedVoucher['code'])->first();
            if ($voucher) {
                $discountAmount = $voucher->calculateDiscount($totalPrice);
                $finalPrice = max(0, $totalPrice - $discountAmount);
            }
        }

        return view('cart.index', compact('cart', 'totalPrice', 'discountAmount', 'finalPrice', 'appliedVoucher'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function add(Request $request)
    {
        // ===== BẮT ĐẦU SỬA LỖI =====
        // 1. Dùng Validator::make() để đọc request JSON
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // 2. Tự kiểm tra nếu validation thất bại
        if ($validator->fails()) {
            // 3. Luôn luôn trả về 422 JSON
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors' => $validator->errors()
            ], 422); // 422 = Unprocessable Entity
        }
        // ===== KẾT THÚC SỬA LỖI =====

        // Lấy dữ liệu đã được validate
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::with('images')->find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại!'], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image_url' => $product->images->isEmpty() ? '' : $product->images->first()->image_url,
            ];
        }

        session()->put('cart', $cart);

        // Tính lại tổng số lượng
        $newCartCount = 0;
        foreach ($cart as $id => $details) {
            $newCartCount += $details['quantity'];
        }

        // Trả về JSON thành công
        return response()->json([
            'success' => true,
            'message' => 'Đã thêm sản phẩm!',
            'cartCount' => $newCartCount
        ]);
    }

    public function update(Request $request, $productId)
    {
        // Dùng Validator thủ công
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Số lượng không hợp lệ.'], 422);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            // Tính lại tổng số lượng
            $newCartCount = 0;
            foreach ($cart as $id => $details) {
                $newCartCount += $details['quantity'];
            }

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật giỏ hàng thành công!',
                'cartCount' => $newCartCount
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Sản phẩm không có trong giỏ!'], 404);
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng (HỖ TRỢ AJAX).
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Xóa sản phẩm
            session()->put('cart', $cart);

            // Tính lại tổng số lượng
            $newCartCount = 0;
            foreach ($cart as $id => $details) {
                $newCartCount += $details['quantity'];
            }

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa sản phẩm!',
                'cartCount' => $newCartCount
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Sản phẩm không có trong giỏ!'], 404);
    }
    /**
     * Xử lý và chuyển hướng đến trang thanh toán.
     */
    public function checkout(Request $request)
    {
        // 1. Validate dữ liệu gửi lên (mảng các ID sản phẩm được chọn)
        $validated = $request->validate([
            'selected_products' => 'required|array',
            'selected_products.*' => 'integer|exists:products,id' // Đảm bảo mọi ID đều tồn tại
        ]);

        $cart = session()->get('cart', []);
        $selectedProductIds = $validated['selected_products'];
        $checkoutItems = [];
        $totalPrice = 0;

        // 2. Lọc giỏ hàng, chỉ giữ lại những sản phẩm được chọn
        foreach ($selectedProductIds as $id) {
            if (isset($cart[$id])) {
                $checkoutItems[$id] = $cart[$id];
                $totalPrice += $cart[$id]['price'] * $cart[$id]['quantity'];
            }
        }

        // 3. Nếu không có sản phẩm nào hợp lệ, quay lại
        if (count($checkoutItems) === 0) {
            return back()->with('error', 'Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
        }

        // 4. Lưu giỏ hàng SẼ THANH TOÁN vào một session riêng
        session()->put('checkout_cart', $checkoutItems);
        session()->put('checkout_total', $totalPrice);
        
        // Lưu voucher vào session checkout (nếu có)
        $appliedVoucher = session('applied_voucher');
        $voucherDiscount = session('voucher_discount', 0);
        if ($appliedVoucher) {
            session()->put('checkout_voucher', $appliedVoucher);
            session()->put('checkout_voucher_discount', $voucherDiscount);
        }

        foreach ($selectedProductIds as $id) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        
        return redirect()->route('checkout.index');

        
    }
}