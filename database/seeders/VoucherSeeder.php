<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vouchers = [
            [
                'code' => 'POLY-VNPAY150K',
                'name' => 'Giảm 150K khi thanh toán VNPay',
                'description' => 'Giảm 150K khi thanh toán VNPay từ 2.5 triệu',
                'type' => 'fixed',
                'value' => 150000,
                'min_order_amount' => 2500000,
                'max_discount_amount' => null,
                'usage_limit' => 100,
                'used_count' => 0,
                'usage_limit_per_user' => 1,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'code' => 'POLY-MOMO200K',
                'name' => 'Giảm 200K cho đơn 5 triệu',
                'description' => 'Giảm 200K cho đơn 5 triệu, ví MoMo',
                'type' => 'fixed',
                'value' => 200000,
                'min_order_amount' => 5000000,
                'max_discount_amount' => null,
                'usage_limit' => 50,
                'used_count' => 0,
                'usage_limit_per_user' => 1,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'code' => 'MEMBER-SILVER',
                'name' => 'Giảm 5% cho thành viên Silver',
                'description' => 'Giảm 5% tối đa 300K cho hạng Silver',
                'type' => 'percentage',
                'value' => 5,
                'min_order_amount' => 1000000,
                'max_discount_amount' => 300000,
                'usage_limit' => 200,
                'used_count' => 0,
                'usage_limit_per_user' => 3,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addMonths(6),
                'is_active' => true,
            ],
            [
                'code' => 'MEMBER-GOLD',
                'name' => 'Giảm 8% cho thành viên Gold/Platinum',
                'description' => 'Giảm 8% tối đa 500K cho hạng Gold/Platinum',
                'type' => 'percentage',
                'value' => 8,
                'min_order_amount' => 2000000,
                'max_discount_amount' => 500000,
                'usage_limit' => 100,
                'used_count' => 0,
                'usage_limit_per_user' => 5,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addMonths(6),
                'is_active' => true,
            ],
            [
                'code' => 'SHIP0K-HN',
                'name' => 'Miễn phí giao nhanh nội thành',
                'description' => 'Miễn phí giao nhanh nội thành HN/HCM',
                'type' => 'fixed',
                'value' => 50000, // Giả sử phí ship là 50k
                'min_order_amount' => 500000,
                'max_discount_amount' => null,
                'usage_limit' => null, // Không giới hạn
                'used_count' => 0,
                'usage_limit_per_user' => 10,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addMonths(12),
                'is_active' => true,
            ],
            [
                'code' => 'SHIP0K-TOANQUOC',
                'name' => 'Miễn phí ship toàn quốc',
                'description' => 'Đơn từ 2 triệu áp dụng toàn quốc',
                'type' => 'fixed',
                'value' => 30000, // Giả sử phí ship là 30k
                'min_order_amount' => 2000000,
                'max_discount_amount' => null,
                'usage_limit' => null,
                'used_count' => 0,
                'usage_limit_per_user' => 5,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addMonths(12),
                'is_active' => true,
            ],
            [
                'code' => 'GIAM10',
                'name' => 'Giảm 10% cho đơn hàng đầu tiên',
                'description' => 'Giảm 10% tối đa 500K cho đơn hàng đầu tiên',
                'type' => 'percentage',
                'value' => 10,
                'min_order_amount' => 1000000,
                'max_discount_amount' => 500000,
                'usage_limit' => 500,
                'used_count' => 0,
                'usage_limit_per_user' => 1,
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->addMonths(6),
                'is_active' => true,
            ],
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
}

