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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // Cột mới
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Giữ lại để xác thực email sau này
            $table->string('password');
            $table->string('phone_number')->nullable(); // Cột mới
            $table->text('address')->nullable(); // Cột mới
            $table->enum('role', ['customer', 'admin'])->default('customer'); // Cột mới
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};