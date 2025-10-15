<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import model User
use Illuminate\Support\Facades\Hash; // <-- Import Hash để mã hóa mật khẩu

class UserSeeder extends Seeder
{
    /**
     * Chạy seeder để tạo dữ liệu mẫu cho bảng users.
     */
    public function run(): void
    {
        // 1. Tạo tài khoản Admin 👨‍💻
        // Tài khoản này sẽ có quyền truy cập vào trang quản trị.
        User::create([
            'full_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('123123'), // Mật khẩu là 'password'
            'role' => 'admin',
            'phone_number' => '0987654321',
            'address' => '123 Admin Street, Da Nang',
            'email_verified_at' => now(), // Tự động xác thực email
        ]);

        // 2. Tạo tài khoản Customer mẫu 👤
        // Tài khoản này dùng để đóng vai khách hàng thông thường.
        User::create([
            'full_name' => 'Nguyễn Văn An',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'), // Mật khẩu là 'password'
            'role' => 'customer',
            'phone_number' => '0123456789',
            'address' => '456 Customer Avenue, Da Nang',
            'email_verified_at' => now(),
        ]);
    }
}