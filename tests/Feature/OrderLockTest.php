<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderLockTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_update_delivered_order()
    {
        // 1. Create Admin User
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // 2. Create a Delivered Order
        $order = new Order();
        $order->user_id = $admin->id; // Just assign to admin for simplicity
        $order->total_amount = 1000;
        $order->status = 'delivered';
        $order->shipping_address = 'Test Address';
        $order->payment_method = 'cod';
        // order_code is auto-generated in boot
        $order->save();

        // 3. Attempt to update status to 'cancelled'
        $response = $this->actingAs($admin)
            ->put(route('admin.orders.update', $order), [
                'status' => 'cancelled',
            ]);

        // 4. Assert Redirect and Error
        $response->assertSessionHas('error', 'Đơn hàng đã giao hoặc đã hủy không thể thay đổi trạng thái.');

        // 5. Assert Status Unchanged
        $this->assertEquals('delivered', $order->fresh()->status);
    }

    public function test_can_update_pending_order()
    {
        // 1. Create Admin User
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // 2. Create a Pending Order
        $order = new Order();
        $order->user_id = $admin->id;
        $order->total_amount = 1000;
        $order->status = 'pending';
        $order->shipping_address = 'Test Address';
        $order->payment_method = 'cod';
        $order->save();

        // 3. Attempt to update status to 'processing'
        $response = $this->actingAs($admin)
            ->put(route('admin.orders.update', $order), [
                'status' => 'processing',
            ]);

        // 4. Assert Redirect and Success
        $response->assertSessionHas('success');

        // 5. Assert Status Changed
        $this->assertEquals('processing', $order->fresh()->status);
    }

    public function test_cannot_update_cancelled_order()
    {
        // 1. Create Admin User
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // 2. Create a Cancelled Order
        $order = new Order();
        $order->user_id = $admin->id;
        $order->total_amount = 1000;
        $order->status = 'cancelled';
        $order->shipping_address = 'Test Address';
        $order->payment_method = 'cod';
        $order->save();

        // 3. Attempt to update status to 'pending'
        $response = $this->actingAs($admin)
            ->put(route('admin.orders.update', $order), [
                'status' => 'pending',
            ]);

        // 4. Assert Redirect and Error
        $response->assertSessionHas('error', 'Đơn hàng đã giao hoặc đã hủy không thể thay đổi trạng thái.');

        // 5. Assert Status Unchanged
        $this->assertEquals('cancelled', $order->fresh()->status);
    }
}
