<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'specifications',
        'price',
        'stock_quantity',
        'sku',
        'is_active',
    ];

    /**
     * Tự động chuyển đổi cột 'specifications' từ JSON trong DB sang array trong PHP.
     *
     * @var array
     */
    protected $casts = [
        'specifications' => 'array',
    ];

    /**
     * Một sản phẩm thuộc về một danh mục.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Một sản phẩm có nhiều hình ảnh.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Một sản phẩm có nhiều đánh giá.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}