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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->index(); // Session ID để phân biệt các cuộc chat
            $table->enum('sender', ['user', 'bot']); // Người gửi: user hoặc bot
            $table->text('message'); // Nội dung tin nhắn
            $table->json('metadata')->nullable(); // Dữ liệu bổ sung (ví dụ: danh sách sản phẩm tìm được)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};

