<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    /**
     * Hiển thị trang khuyến mãi cùng danh sách voucher đang hoạt động.
     */
    public function index()
    {
        $now = Carbon::now();

        $activeVouchers = Voucher::query()
            ->with('categories')
            ->where('is_active', true)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->orderBy('end_date')
            ->get();

        $colorPresets = [
            'dien-thoai' => [
                'card' => 'from-indigo-500/10 to-indigo-100',
                'pill' => 'bg-indigo-100 text-indigo-600',
                'button' => 'bg-indigo-600 text-white hover:bg-indigo-700',
            ],
            'phone' => [
                'card' => 'from-indigo-500/10 to-indigo-100',
                'pill' => 'bg-indigo-100 text-indigo-600',
                'button' => 'bg-indigo-600 text-white hover:bg-indigo-700',
            ],
            'laptop' => [
                'card' => 'from-pink-500/10 to-pink-100',
                'pill' => 'bg-pink-100 text-pink-600',
                'button' => 'bg-pink-600 text-white hover:bg-pink-700',
            ],
            'phu-kien' => [
                'card' => 'from-violet-500/10 to-violet-100',
                'pill' => 'bg-violet-100 text-violet-600',
                'button' => 'bg-violet-600 text-white hover:bg-violet-700',
            ],
            'doanh-nghiep' => [
                'card' => 'from-amber-500/10 to-amber-100',
                'pill' => 'bg-amber-100 text-amber-600',
                'button' => 'bg-amber-500 text-white hover:bg-amber-600',
            ],
            'all' => [
                'card' => 'from-slate-500/10 to-slate-100',
                'pill' => 'bg-slate-100 text-slate-600',
                'button' => 'bg-slate-600 text-white hover:bg-slate-700',
            ],
        ];

        $flashDeals = $activeVouchers->map(function ($voucher) use ($colorPresets) {
            $categoryData = $voucher->categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => Str::slug($category->name),
                ];
            });

            if ($categoryData->isEmpty()) {
                $categoryData = collect([[
                    'id' => null,
                    'name' => 'Toàn bộ sản phẩm',
                    'slug' => 'all',
                ]]);
            }

            $primarySlug = $categoryData->first()['slug'] ?? 'all';
            $colors = $colorPresets[$primarySlug] ?? $colorPresets['all'];

            return [
                'id' => $voucher->id,
                'code' => $voucher->code,
                'title' => $voucher->name,
                'description' => $voucher->description ?? 'Áp dụng cho đơn hàng đủ điều kiện.',
                'tag' => $voucher->type === 'percentage'
                    ? 'Giảm ' . rtrim(rtrim($voucher->value, '0'), '.') . '%'
                    : 'Giảm ' . number_format($voucher->value, 0, ',', '.') . 'đ',
                'expires' => optional($voucher->end_date)->format('d/m'),
                'categories' => $categoryData->values()->all(),
                'colors' => $colors,
            ];
        })->take(6);

        $flashFilters = collect($flashDeals)
            ->flatMap(fn ($deal) => $deal['categories'])
            ->unique('slug')
            ->values()
            ->map(function ($category) {
                return [
                    'label' => $category['name'],
                    'slug' => $category['slug'],
                ];
            })
            ->all();

        array_unshift($flashFilters, [
            'label' => 'Tất cả',
            'slug' => 'all',
        ]);

        // Phân nhóm để hiển thị đẹp mắt trên giao diện
        $percentageVouchers = $activeVouchers->filter(fn ($voucher) => $voucher->type === 'percentage');
        $remaining = $activeVouchers->diff($percentageVouchers);

        $highValueVouchers = $remaining->filter(fn ($voucher) => $voucher->min_order_amount >= 10000000);
        $remaining = $remaining->diff($highValueVouchers);

        $generalVouchers = $remaining;

        $voucherGroups = [
            [
                'key' => 'percentage',
                'label' => 'Giảm theo phần trăm',
                'color' => 'indigo',
                'vouchers' => $percentageVouchers,
            ],
            [
                'key' => 'high_value',
                'label' => 'Đơn lớn giảm sâu',
                'color' => 'emerald',
                'vouchers' => $highValueVouchers,
            ],
            [
                'key' => 'general',
                'label' => 'Áp dụng toàn shop',
                'color' => 'pink',
                'vouchers' => $generalVouchers,
            ],
        ];

        return view('pages.promotions', [
            'activeVouchers' => $activeVouchers,
            'voucherGroups' => $voucherGroups,
            'flashDeals' => $flashDeals,
            'flashFilters' => $flashFilters,
        ]);
    }
}
