<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ['specifications' => 'array']; // Tự động chuyển JSON sang array

    // Một Product thuộc về một Category
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Một Product có nhiều Images
    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    // Một Product có nhiều Reviews
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}