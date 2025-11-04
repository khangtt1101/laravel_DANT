<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    /**
     * Hiển thị trang sản phẩm chính.
     */
    public function index()
    {
        // 1. Lấy 4 sản phẩm nổi bật (ví dụ: mới nhất)
        $featuredProducts = Product::with(['category', 'images'])
                                    ->latest()
                                    ->take(9)
                                    ->get();

        // 2. Lấy các danh mục (cấp cha) và mỗi danh mục lấy 4 sản phẩm
        $categoriesWithProducts = Category::whereNull('parent_id')
            ->with(['products' => function ($query) {
                // Với mỗi danh mục, tải 4 sản phẩm mới nhất và ảnh của chúng
                $query->with('images')->latest()->take(4);
            }])
            ->get();

        // 3. Trả về view với cả 2 bộ dữ liệu
        return view('shop', compact('featuredProducts', 'categoriesWithProducts'));
    }

    public function show(Category $category, Product $product)
    {
        // Nhờ scopeBindings(), $product đã được tự động
        // xác thực là thuộc về $category.
        
        // Tải các thông tin liên quan (ảnh)
        $product->load(['images']); 

        // Trả về view
        return view('product-detail', compact('product', 'category'));
    }
}