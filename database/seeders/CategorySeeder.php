<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['id' => 1, 'name' => 'Điện thoại', 'slug' => 'dien-thoai']);
        Category::create(['id' => 2, 'name' => 'Laptop', 'slug' => 'laptop']);
        Category::create(['id' => 3, 'name' => 'Tai nghe', 'slug' => 'tai-nghe']);
    }
}