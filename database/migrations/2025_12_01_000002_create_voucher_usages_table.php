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
        Schema::create('voucher_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // nullable để cho phép guest
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('discount_amount', 15, 2);
            $table->timestamps();
            
            // Đảm bảo mỗi user chỉ dùng voucher một số lần nhất định
            $table->index(['voucher_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_usages');
    }
};

