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
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()
            ->take(8)
            ->get();

        // Lấy tất cả danh mục
        $categories = Category::with('products')
            ->whereNull('parent_id') // Chỉ lấy danh mục cha
            ->get();

        // Lấy sản phẩm mới nhất
        $newProducts = Product::with(['category', 'images'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()
            ->take(12)
            ->get();

        // Lấy sản phẩm bán chạy (best seller) - giả sử là sản phẩm có nhiều đơn hàng nhất
        $bestSellers = Product::with(['category', 'images'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->inRandomOrder() // Tạm thời random, sau có thể sort theo số lượng bán
            ->take(8)
            ->get();

        // Lấy sản phẩm giảm giá (deal sốc)
        $hotDeals = Product::with(['category', 'images'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('price', '>', 5000000) // Giả sử sản phẩm giá cao sẽ có discount
            ->latest()
            ->take(6)
            ->get();

        // Lấy đánh giá mới nhất
        $reviews = \App\Models\Review::with(['user', 'product'])
            ->latest()
            ->take(6)
            ->get();

        // Lấy sản phẩm có review để hiển thị như video reviews
        // Đảm bảo luôn có đủ 4 sản phẩm (có thể lặp lại nếu không đủ)
        $allProducts = Product::with(['category', 'images', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()
            ->get();
        
        $videoReviews = collect();
        
        // Ưu tiên lấy sản phẩm có review trước
        $productsWithReviews = $allProducts->filter(function($product) {
            return $product->reviews->count() > 0;
        })->take(4);
        
        $videoReviews = $videoReviews->merge($productsWithReviews);
        
        // Nếu chưa đủ 4, lấy thêm từ tất cả sản phẩm (loại trừ những cái đã có)
        if ($videoReviews->count() < 4) {
            $remaining = 4 - $videoReviews->count();
            $existingIds = $videoReviews->pluck('id')->toArray();
            
            $additionalProducts = $allProducts
                ->whereNotIn('id', $existingIds)
                ->take($remaining);
            
            $videoReviews = $videoReviews->merge($additionalProducts);
        }
        
        // Nếu vẫn chưa đủ 4 (ví dụ chỉ có 2 sản phẩm trong DB), lặp lại để đủ 4
        if ($videoReviews->count() < 4 && $allProducts->isNotEmpty()) {
            $needMore = 4 - $videoReviews->count();
            $allProductsArray = $allProducts->all();
            $index = 0;
            
            while ($videoReviews->count() < 4 && count($allProductsArray) > 0) {
                $product = $allProductsArray[$index % count($allProductsArray)];
                $videoReviews->push($product);
                $index++;
            }
        }
        
        // Đảm bảo chỉ lấy đúng 4 cái đầu tiên
        $videoReviews = $videoReviews->take(4);

        // Lấy sản phẩm đã qua sử dụng (có thể thêm field is_used vào Product sau)
        $usedProducts = Product::with(['category', 'images'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->inRandomOrder() // Tạm thời random, sau có thể filter theo is_used = true
            ->take(12)
            ->get();

        // Lấy các danh mục lớn để hiển thị trong Category Showcase (3 cột)
        $mainCategories = Category::with(['products' => function($query) {
            $query->with('images')
                ->withAvg('reviews', 'rating')
                ->withCount('reviews')
                ->latest()
                ->take(6);
        }])
            ->whereNull('parent_id')
            ->take(3)
            ->get();

        // Brands phổ biến (có thể lấy từ tên sản phẩm hoặc tạo riêng)
        $popularBrands = [
            'Xiaomi', 'Philips', 'Panasonic', 'Roborock', 
            'Ecovacs', 'Dreame', 'Samsung', 'Sharp', 'Apple', 'Sony'
        ];

        return view('welcome', compact(
            'featuredProducts', 
            'categories', 
            'newProducts',
            'bestSellers',
            'hotDeals',
            'reviews',
            'usedProducts',
            'mainCategories',
            'popularBrands',
            'videoReviews'
        ));
    }
}


















?>