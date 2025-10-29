<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * Bảng này chỉ có created_at, không có updated_at.
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    /**
     * Một đánh giá thuộc về một người dùng.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Một đánh giá thuộc về một sản phẩm.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}