<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\OrderDelivered;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        // Xử lý logic tìm kiếm
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');

            $query->where(function ($q) use ($searchTerm) {
                // 1. Tìm theo Mã đơn hàng
                $q->where('order_code', 'like', '%' . $searchTerm . '%')
                    // 2. Hoặc tìm theo tên sản phẩm (thông qua quan hệ)
                    ->orWhereHas('items.product', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lấy kết quả và phân trang (giữ lại query string)
        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order')); // <-- Cập nhật
    }

    public function update(Request $request, Order $order)
    {
        if ($order->status == 'delivered' || $order->status == 'cancelled') {
            return redirect()->back()->with('error', 'Đơn hàng đã giao hoặc đã hủy không thể thay đổi trạng thái.');
        }

        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);
        $order->update(['status' => $request->status]);

        if ($request->status == 'delivered') {
            Mail::to($order->user->email)->send(new OrderDelivered($order));
        }

        return redirect()->route('admin.orders.index', $order)->with('success', 'Trạng thái đơn hàng đã được cập nhật.'); // <-- Cập nhật
    }

    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xóa.');
    }

    public function exportPdf(Order $order)
    {
        $order->load(['items.product', 'user']);
        $pdf = Pdf::loadView('admin.orders.pdf', compact('order'));
        return $pdf->download('invoice-' . $order->order_code . '.pdf');
    }
}