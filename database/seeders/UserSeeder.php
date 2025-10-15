<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id' => 1, // Gán ID cứng để dễ tham chiếu
            'full_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'id' => 2, // Gán ID cứng
            'full_name' => 'Nguyễn Văn An',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'address' => '123 Đường ABC, Quận 1, TP.HCM'
        ]);
    }
}