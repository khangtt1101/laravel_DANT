<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * Bảng này không dùng timestamps (created_at, updated_at).
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'image_url',
        'alt_text',
    ];

    /**
     * Một hình ảnh thuộc về một sản phẩm.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}