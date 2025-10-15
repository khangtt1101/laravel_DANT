<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = []; // Cho phép mass assignment

    // Một Category có nhiều Products
    public function products() {
        return $this->hasMany(Product::class);
    }
}