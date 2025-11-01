<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang tổng quan của admin.
     */
    public function index()
    {
        // Lấy các số liệu thống kê
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalOrders = Order::count();
        
        // Tính tổng doanh thu từ các đơn hàng đã "delivered"
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');

        // Lấy 5 đơn hàng mới nhất
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // Trả về view với các dữ liệu đã lấy
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCustomers',
            'totalOrders',
            'totalRevenue',
            'recentOrders'
        ));
    }
}