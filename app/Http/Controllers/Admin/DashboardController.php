<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang tổng quan của admin.
     */
    public function index()
    {
        // Lấy các số liệu thống kê
        $totalProducts = Product::count();
        $lowStockCount = Product::where('stock_quantity', '<=', 10)->where('stock_quantity', '>', 0)->count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalOrders = Order::count();

        // Tính tổng doanh thu từ các đơn hàng đã "delivered"
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');

        // Lấy 5 đơn hàng mới nhất
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // --- Dữ liệu cho biểu đồ Doanh thu (30 ngày gần nhất) ---
        $revenueData = Order::where('status', 'delivered')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Chuẩn bị mảng ngày và doanh thu đầy đủ cho 30 ngày (kể cả ngày không có doanh thu)
        $dates = [];
        $revenues = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = $date;

            $record = $revenueData->firstWhere('date', $date);
            $revenues[] = $record ? $record->total : 0;
        }

        // --- Dữ liệu cho biểu đồ Trạng thái đơn hàng ---
        $orderStatusData = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Đảm bảo có đủ các key để tránh lỗi JS nếu thiếu status
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $statusCounts = [];
        foreach ($statuses as $status) {
            $statusCounts[] = $orderStatusData[$status] ?? 0;
        }

        // --- Top 5 sản phẩm bán chạy nhất (theo doanh thu) ---
        $topProducts = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'delivered')
            ->select(
                'order_items.product_id',
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'),
                DB::raw('SUM(order_items.quantity) as total_sold')
            )
            ->groupBy('order_items.product_id')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->with('product')
            ->get();

        // Trả về view với các dữ liệu đã lấy
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCustomers',
            'totalOrders',
            'totalRevenue',
            'recentOrders',
            'dates',
            'revenues',
            'statuses',
            'statusCounts',
            'topProducts',
            'lowStockCount'
        ));
    }
}