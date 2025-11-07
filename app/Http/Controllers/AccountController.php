<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}