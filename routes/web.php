<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ShopController;
use App\Models\Product;

Route::get('/', function () {
    // Lấy 8 sản phẩm mới nhất, đồng thời tải trước ảnh và danh mục
    $featuredProducts = Product::with(['category', 'images'])
                               ->latest() // Sắp xếp theo ngày tạo mới nhất
                               ->take(8)    // Giới hạn 8 sản phẩm
                               ->get();

    // Trả về view 'welcome' và truyền biến $featuredProducts vào
    return view('welcome', compact('featuredProducts'));
});

// ROUTE CHO USER THÔNG THƯỜNG (của Breeze)
Route::get('/home', function () {
    return view('dashboard'); // Trỏ đến view 'dashboard.blade.php'
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

// ROUTE CHO ADMIN
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.') // <-- THÊM DÒNG NÀY ĐỂ TẠO TIỀN TỐ TÊN
    ->group(function () {
    
    // Route cho trang dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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