<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders')); // <-- Cập nhật
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order')); // <-- Cập nhật
    }

    public function update(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);
        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders.show', $order)->with('success', 'Trạng thái đơn hàng đã được cập nhật.'); // <-- Cập nhật
    }

    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xóa.'); // <-- Cập nhật
    }
}