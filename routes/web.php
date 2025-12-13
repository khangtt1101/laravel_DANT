<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AccountController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductViewController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// ROUTE CHO USER THÔNG THƯỜNG (của Breeze)
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/search', [ShopController::class, 'search'])->name('shop.search');
Route::get('/products/{category:slug}/{product:slug}', [ShopController::class, 'show'])
    ->name('products.show')
    ->scopeBindings();
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ===== BẮT ĐẦU CÁC ROUTE GIỎ HÀNG (KHÔNG CẦN ĐĂNG NHẬP) =====
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/voucher/validate', [CartController::class, 'validateVoucher'])->name('voucher.validate');
Route::post('/voucher/remove', [CartController::class, 'removeVoucher'])->name('voucher.remove');
// ===== KẾT THÚC CÁC ROUTE GIỎ HÀNG =====

// ===== ROUTE TRACKING SỐ NGƯỜI ĐANG XEM SẢN PHẨM =====
Route::post('/api/products/{productId}/track-view', [ProductViewController::class, 'track'])->name('products.track-view');
Route::get('/api/products/{productId}/viewers', [ProductViewController::class, 'getViewers'])->name('products.viewers');
Route::post('/api/products/viewers', [ProductViewController::class, 'getMultipleViewers'])->name('products.viewers.multiple');
// ===== KẾT THÚC ROUTE TRACKING =====

// ROUTE CHO ADMIN
Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.') // <-- THÊM DÒNG NÀY ĐỂ TẠO TIỀN TỐ TÊN
    ->group(function () {

        // Route cho trang dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Các resource route khác
        Route::resource('products', ProductController::class);
        Route::get('orders/{order}/export-pdf', [OrderController::class, 'exportPdf'])->name('orders.exportPdf');
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('reviews', ReviewController::class)->only(['index', 'destroy']);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
        Route::resource('vouchers', AdminVoucherController::class);
    });

Route::middleware(['auth', 'verified'])->prefix('account')->name('account.')->group(function () {
    Route::get('/orders', [AccountController::class, 'orderHistory'])->name('orders');
    Route::get('/orders/{order}', [AccountController::class, 'showOrder'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [AccountController::class, 'cancelOrder'])->name('orders.cancel');
    Route::get('/support', [AccountController::class, 'support'])->name('support');
});

// ROUTE PROFILE (của Breeze)
Route::middleware('auth')->group(function () {

    Route::post('/profile/address', [UserAddressController::class, 'store'])->name('profile.address.store');
    Route::delete('/profile/address/{address}', [UserAddressController::class, 'destroy'])->name('profile.address.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===== ROUTE CHECKOUT (CẦN ĐĂNG NHẬP) =====
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    
    // ===== ROUTE THANH TOÁN =====
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/vnpay', [CheckoutController::class, 'vnpayPayment'])->name('checkout.vnpay');
    
    Route::post('/checkout/address/store', [CheckoutController::class, 'storeAddress'])->name('checkout.address.store');
    // Tuyến xử lý (POST)
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    
    // Trang cảm ơn (GET)
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    // ===== KẾT THÚC ROUTE THANH TOÁN =====

    Route::post('/products/{product}/reviews', [ProductReviewController::class, 'store'])
        ->name('products.reviews.store');
    Route::put('/products/{product}/reviews/{review}', [ProductReviewController::class, 'update'])
        ->name('products.reviews.update');
    Route::delete('/products/{product}/reviews/{review}', [ProductReviewController::class, 'destroy'])
        ->name('products.reviews.destroy');
});

// VNPay return callback (không yêu cầu đăng nhập)
Route::get('/checkout/vnpay-return', [CheckoutController::class, 'vnpayReturn'])->name('checkout.vnpayReturn');
// Trang cảm ơn (public)
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

require __DIR__ . '/auth.php';