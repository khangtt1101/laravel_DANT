<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy thông tin sản phẩm để tính tổng tiền
        $iphone = Product::find(1);
        $macbook = Product::find(2);

        // Tạo đơn hàng cho User có ID = 2
        $order = Order::create([
            'id' => 1,
            'user_id' => 2,
            'shipping_address' => '123 Đường ABC, Quận 1, TP.HCM',
            'payment_method' => 'COD',
            'total_amount' => ($iphone->price * 1) + ($macbook->price * 1), // Tính tổng tiền
            'status' => 'delivered'
        ]);

        // Thêm các sản phẩm vào đơn hàng
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $iphone->id,
            'quantity' => 1,
            'price' => $iphone->price
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $macbook->id,
            'quantity' => 1,
            'price' => $macbook->price
        ]);
    }
}