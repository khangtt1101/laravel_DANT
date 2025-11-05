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
use App\Http\Controllers\CartController;
use App\Models\Product;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// ROUTE CHO USER THÔNG THƯỜNG (của Breeze)
Route::get('/home', function () {
    return view('dashboard'); // Trỏ đến view 'dashboard.blade.php'
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/products/{category:slug}/{product:slug}', [ShopController::class, 'show'])
     ->name('products.show')
     ->scopeBindings();

// ===== BẮT ĐẦU CÁC ROUTE GIỎ HÀNG =====
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
// ===== KẾT THÚC CÁC ROUTE GIỎ HÀNG =====
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