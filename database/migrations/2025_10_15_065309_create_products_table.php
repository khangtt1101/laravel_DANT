<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại đến bảng categories
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->json('specifications')->nullable(); // Lưu thông số kỹ thuật dạng JSON
            $table->decimal('price', 12, 2);
            $table->integer('stock_quantity')->default(0);
            $table->string('sku')->unique(); // Mã sản phẩm
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};