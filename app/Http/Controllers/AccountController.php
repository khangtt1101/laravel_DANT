<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
class AccountController extends Controller
{
    /**
     * Hiển thị trang "Tổng quan" (dùng lại route 'dashboard' của Breeze)
     */
    public function dashboard()
    {
        $recentOrders = Auth::user()->orders()
                            ->with('items.product') // Tải trước thông tin
                            ->latest()
                            ->take(3) // Lấy 3 đơn hàng mới nhất
                            ->get();
        
        // (Bạn có thể thêm logic lấy voucher ở đây)
        
        return view('dashboard', compact('recentOrders'));
    }

    /**
     * Hiển thị trang "Lịch sử đơn hàng"
     */
    public function orderHistory()
    {
        $orders = Auth::user()->orders()
                        ->latest()
                        ->paginate(10); // Phân trang

        return view('account.orders', compact('orders'));
    }

    /**
     * Hiển thị trang "Góp ý & Hỗ trợ"
     */
    public function support()
    {
        return view('account.support');
    }

    public function showOrder(Request $request, Order $order)
    {
        // BẢO MẬT: Đảm bảo người dùng chỉ xem được đơn hàng của chính họ
        if ($request->user()->id !== $order->user_id) {
            abort(403); // Báo lỗi 403 (Cấm truy cập)
        }

        // Tải thông tin liên quan (sản phẩm trong đơn hàng)
        $order->load('items.product.images');

        return view('account.orders-show', compact('order'));
    }

    /**
     * Cho phép người dùng huỷ đơn khi đơn còn ở trạng thái xử lý ban đầu.
     */
    public function cancelOrder(Request $request, Order $order)
    {
        if ($request->user()->id !== $order->user_id) {
            abort(403);
        }

        if (!in_array($order->status, ['pending', 'processing'])) {
            return back()->with('error', 'Đơn hàng chỉ có thể huỷ khi đang chờ xử lý.');
        }

        DB::transaction(function () use ($order) {
            $order->loadMissing('items.product', 'voucherUsage.voucher');

            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock_quantity', $item->quantity);
                }
            }

            if ($order->voucherUsage) {
                $voucher = $order->voucherUsage->voucher;
                if ($voucher && $voucher->used_count > 0) {
                    $voucher->decrement('used_count');
                }
                $order->voucherUsage->delete();
            }

            $order->status = 'cancelled';
            $order->save();
        });

        return redirect()
            ->route('account.orders.show', $order)
            ->with('success', 'Đơn hàng đã được huỷ.');
    }
}