<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Điện thoại
        Product::create([
            'id' => 1,
            'category_id' => 1, // ID của danh mục "Điện thoại"
            'name' => 'iPhone 17 Pro Max 256GB',
            'slug' => 'iphone-17-pro-max-256gb',
            'description' => 'Siêu phẩm công nghệ từ Apple.',
            'price' => 35000000,
            'stock_quantity' => 50,
            'sku' => 'APP-IP17PM-256'
        ]);

        // Laptop
        Product::create([
            'id' => 2,
            'category_id' => 2, // ID của danh mục "Laptop"
            'name' => 'MacBook Pro M4 14-inch',
            'slug' => 'macbook-pro-m4-14-inch',
            'description' => 'Hiệu năng đỉnh cao cho người dùng chuyên nghiệp.',
            'price' => 55000000,
            'stock_quantity' => 20,
            'sku' => 'APP-MBP14-M4'
        ]);
    }
}