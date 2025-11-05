<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     */
    public function index(): View
    {
        // Lấy sản phẩm nổi bật (8 sản phẩm đầu tiên)
        $featuredProducts = Product::with(['category', 'images'])
            ->latest()
            ->take(8)
            ->get();

        // Lấy tất cả danh mục
        $categories = Category::with('products')
            ->whereNull('parent_id') // Chỉ lấy danh mục cha
            ->get();

        // Lấy sản phẩm mới nhất
        $newProducts = Product::with(['category', 'images'])
            ->latest()
            ->take(12)
            ->get();

        // Lấy sản phẩm bán chạy (best seller) - giả sử là sản phẩm có nhiều đơn hàng nhất
        $bestSellers = Product::with(['category', 'images'])
            ->inRandomOrder() // Tạm thời random, sau có thể sort theo số lượng bán
            ->take(8)
            ->get();

        // Lấy sản phẩm giảm giá (deal sốc)
        $hotDeals = Product::with(['category', 'images'])
            ->where('price', '>', 5000000) // Giả sử sản phẩm giá cao sẽ có discount
            ->latest()
            ->take(6)
            ->get();

        // Lấy đánh giá mới nhất
        $reviews = \App\Models\Review::with(['user', 'product'])
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact(
            'featuredProducts', 
            'categories', 
            'newProducts',
            'bestSellers',
            'hotDeals',
            'reviews'
        ));
    }
}


















?>