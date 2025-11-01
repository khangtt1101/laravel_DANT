<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // <-- 1. Thêm dòng này
use App\Models\Category; // <-- 2. Thêm dòng này

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 3. Thêm đoạn code này vào
        // Tự động chia sẻ biến $allCategories đến view 'layouts.partials.header'
        View::composer('layouts.partials.header', function ($view) {
            
            // Lấy tất cả danh mục. Lấy cả 'children' để sau này bạn làm menu dropdown
            $categories = Category::whereNull('parent_id')
                                  ->with('children') 
                                  ->get();
            
            // Gửi biến $allCategories đến view
            $view->with('allCategories', $categories);
        });
    }
}