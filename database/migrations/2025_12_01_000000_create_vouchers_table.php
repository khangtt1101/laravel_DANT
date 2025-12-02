<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->enum('type', ['percentage', 'fixed'])->default('percentage'); // percentage: giảm %, fixed: giảm số tiền cố định
            $table->decimal('value', 10, 2); // Giá trị giảm (nếu percentage thì là %, nếu fixed thì là số tiền)
            $table->decimal('min_order_amount', 15, 2)->default(0); // Đơn hàng tối thiểu
            $table->decimal('max_discount_amount', 15, 2)->nullable(); // Giảm tối đa (chỉ áp dụng với percentage)
            $table->integer('usage_limit')->nullable(); // Giới hạn số lần sử dụng (null = không giới hạn)
            $table->integer('used_count')->default(0); // Số lần đã sử dụng
            $table->integer('usage_limit_per_user')->default(1); // Giới hạn số lần mỗi user được dùng
            $table->dateTime('start_date'); // Ngày bắt đầu
            $table->dateTime('end_date'); // Ngày kết thúc
            $table->boolean('is_active')->default(true); // Trạng thái kích hoạt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};

