<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'used_count',
        'usage_limit_per_user',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'usage_limit_per_user' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Kiểm tra voucher có hợp lệ không
     * @param array $productCategories Mảng ID các category của sản phẩm trong giỏ hàng
     */
    public function isValid($user = null, $orderAmount = 0, $productCategories = [])
    {
        // Kiểm tra trạng thái kích hoạt
        if (!$this->is_active) {
            return ['valid' => false, 'message' => 'Voucher không còn hiệu lực.'];
        }

        // Kiểm tra thời gian
        $now = Carbon::now();
        if ($now->lt($this->start_date)) {
            return ['valid' => false, 'message' => 'Voucher chưa có hiệu lực.'];
        }
        if ($now->gt($this->end_date)) {
            return ['valid' => false, 'message' => 'Voucher đã hết hạn.'];
        }

        // Kiểm tra số lần sử dụng
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return ['valid' => false, 'message' => 'Voucher đã hết lượt sử dụng.'];
        }

        // Kiểm tra giá trị đơn hàng tối thiểu
        if ($orderAmount < $this->min_order_amount) {
            return ['valid' => false, 'message' => 'Đơn hàng tối thiểu ' . number_format($this->min_order_amount, 0, ',', '.') . ' đ để áp dụng voucher này.'];
        }

        // Kiểm tra category: Nếu voucher có category được chọn, phải kiểm tra sản phẩm có thuộc category đó không
        try {
            if ($this->relationLoaded('categories') || \Illuminate\Support\Facades\Schema::hasTable('voucher_categories')) {
                if (!$this->relationLoaded('categories')) {
                    $this->load('categories');
                }
                
                if ($this->categories->isNotEmpty() && !empty($productCategories)) {
                    $hasValidCategory = false;
                    foreach ($productCategories as $categoryId) {
                        if ($this->appliesToCategory($categoryId)) {
                            $hasValidCategory = true;
                            break;
                        }
                    }
                    
                    if (!$hasValidCategory) {
                        $categoryNames = $this->categories->pluck('name')->join(', ');
                        return ['valid' => false, 'message' => 'Voucher này chỉ áp dụng cho danh mục: ' . $categoryNames];
                    }
                }
            }
        } catch (\Exception $e) {
            // Nếu bảng voucher_categories chưa tồn tại, bỏ qua kiểm tra category
            // Voucher sẽ áp dụng cho tất cả sản phẩm
        }

        // Kiểm tra số lần sử dụng của user
        if ($user && $this->usage_limit_per_user) {
            $userUsageCount = \App\Models\VoucherUsage::where('voucher_id', $this->id)
                ->where('user_id', $user->id)
                ->count();
            
            if ($userUsageCount >= $this->usage_limit_per_user) {
                return ['valid' => false, 'message' => 'Bạn đã sử dụng hết lượt voucher này.'];
            }
        }

        return ['valid' => true, 'message' => 'Voucher hợp lệ.'];
    }

    /**
     * Tính toán số tiền giảm giá
     */
    public function calculateDiscount($orderAmount)
    {
        if ($this->type === 'percentage') {
            $discount = ($orderAmount * $this->value) / 100;
            
            // Áp dụng giới hạn giảm tối đa nếu có
            if ($this->max_discount_amount && $discount > $this->max_discount_amount) {
                $discount = $this->max_discount_amount;
            }
            
            return round($discount, 2);
        } else {
            // Fixed amount
            return min($this->value, $orderAmount); // Không được giảm nhiều hơn giá trị đơn hàng
        }
    }

    /**
     * Một voucher có nhiều lần sử dụng
     */
    public function usages()
    {
        return $this->hasMany(\App\Models\VoucherUsage::class);
    }

    /**
     * Một voucher có thể áp dụng cho nhiều danh mục (many-to-many)
     * Nếu không có category nào được chọn, voucher áp dụng cho tất cả sản phẩm
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'voucher_categories');
    }

    /**
     * Kiểm tra voucher có áp dụng cho category không
     */
    public function appliesToCategory($categoryId)
    {
        // Nếu voucher không có category nào được chọn, áp dụng cho tất cả
        if ($this->categories->isEmpty()) {
            return true;
        }
        
        // Kiểm tra category có trong danh sách không
        return $this->categories->contains('id', $categoryId);
    }
}




