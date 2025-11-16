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
    public function index(Request $request)
    {
        $categoryId = $request->input('category');
        $categorySlug = $request->input('category_slug');
        
        // Nếu có category được chọn
        if ($categoryId || $categorySlug) {
            $category = null;
            
            if ($categorySlug) {
                $category = Category::where('slug', $categorySlug)->first();
            } elseif ($categoryId) {
                $category = Category::find($categoryId);
            }
            
            if ($category) {
                // Lấy tất cả sản phẩm của category và các category con
                $categoryIds = [$category->id];
                $categoryIds = array_merge($categoryIds, $category->children->pluck('id')->toArray());
                
                $products = Product::with(['category', 'images'])
                    ->whereIn('category_id', $categoryIds)
                    ->latest()
                    ->paginate(12);
                
                $categories = Category::whereNull('parent_id')->get();
                $query = null;
                $featuredProducts = collect();
                $categoriesWithProducts = collect();
                
                return view('shop', compact('products', 'categories', 'query', 'featuredProducts', 'categoriesWithProducts', 'category'));
            }
        }
        
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

    /**
     * Tìm kiếm sản phẩm.
     */
    public function search(Request $request)
    {
        $query = $request->input('search');
        
        // Nếu không có từ khóa, redirect về shop
        if (empty($query)) {
            return redirect()->route('shop.index');
        }

        // Tìm kiếm sản phẩm theo tên hoặc mô tả
        $products = Product::with(['category', 'images'])
            ->where(function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->latest()
            ->paginate(12);

        // Lấy các danh mục để hiển thị filter
        $categories = Category::whereNull('parent_id')->get();
        
        // Thêm các biến cần thiết cho view (để tránh lỗi khi view không có $query)
        $featuredProducts = collect(); // Empty collection
        $categoriesWithProducts = collect(); // Empty collection

        return view('shop', compact('products', 'categories', 'query', 'featuredProducts', 'categoriesWithProducts'));
    }
}