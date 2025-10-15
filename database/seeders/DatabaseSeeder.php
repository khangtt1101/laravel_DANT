<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            // ProductImageSeeder::class, // Bạn có thể thêm sau
            OrderSeeder::class,
            // ReviewSeeder::class, // Bạn có thể thêm sau
        ]);
    }
}