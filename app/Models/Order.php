<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'payment_method',
        'order_code',
    ];

    /**
     * Một đơn hàng thuộc về một người dùng.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        // 2. Thêm hàm creating này
        static::creating(function ($order) {
            // Tạo một mã ngẫu nhiên, lặp lại cho đến khi chắc chắn nó là duy nhất
            do {
                $code = 'ORD-' . strtoupper(Str::random(8));
            } while (static::where('order_code', $code)->exists());
            
            $order->order_code = $code;
        });
    }

    /**
     * Một đơn hàng có nhiều chi tiết sản phẩm (order items).
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}