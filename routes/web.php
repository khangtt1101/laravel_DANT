<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// ROUTE CHO USER THÔNG THƯỜNG (của Breeze)
Route::get('/dashboard', function () {
    return view('dashboard'); // Trỏ đến view 'dashboard.blade.php'
})->middleware(['auth', 'verified'])->name('dashboard');

// ROUTE CHO ADMIN
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.') // <-- THÊM DÒNG NÀY ĐỂ TẠO TIỀN TỐ TÊN
    ->group(function () {
    
    // Route cho trang dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard'); // Tên đầy đủ sẽ là 'admin.dashboard'

    // Các resource route khác
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('reviews', ReviewController::class)->only(['index', 'destroy']);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
});

// ROUTE PROFILE (của Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';