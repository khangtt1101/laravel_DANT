<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'user_id',
        'order_id',
        'discount_amount',
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
    ];

    /**
     * Một lần sử dụng thuộc về một voucher
     */
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    /**
     * Một lần sử dụng thuộc về một user (có thể null cho guest)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Một lần sử dụng thuộc về một đơn hàng
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}


