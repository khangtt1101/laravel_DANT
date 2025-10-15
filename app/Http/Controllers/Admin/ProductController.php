<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage; // <-- Thêm model ProductImage
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Thêm DB Facade để dùng transaction
use Illuminate\Support\Str; // <-- Thêm Str để tạo slug

class ProductController extends Controller
{
    // ... các phương thức index, create, edit, show giữ nguyên ...
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Lưu sản phẩm mới và ảnh vào database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products',
            'description' => 'nullable|string',
            'images' => 'nullable|array', // Phải là một mảng
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048' // Validate từng file trong mảng
        ]);

        // Bắt đầu một transaction
        DB::beginTransaction();

        try {
            // Lấy dữ liệu sản phẩm (không bao gồm ảnh)
            $productData = collect($validatedData)->except('images')->toArray();
            $productData['slug'] = Str::slug($productData['name']);

            // 1. Tạo sản phẩm
            $product = Product::create($productData);

            // 2. Xử lý tải ảnh (nếu có)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    // Tạo tên file duy nhất
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    // Lưu file vào storage/app/public/products
                    $path = $file->storeAs('products', $fileName, 'public');

                    // Tạo bản ghi trong bảng product_images
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $path,
                    ]);
                }
            }

            // Nếu mọi thứ thành công, commit transaction
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công.');

        } catch (\Exception $e) {
            // Nếu có lỗi, rollback transaction
            DB::rollBack();
            // Ghi log lỗi (quan trọng cho debug)
            \Log::error($e);
            // Và trả về thông báo lỗi
            return back()->with('error', 'Đã xảy ra lỗi. Vui lòng thử lại.')->withInput();
        }
    }


    /**
     * Cập nhật thông tin sản phẩm và ảnh.
     */
    public function update(Request $request, Product $product)
    {
        // Tương tự phương thức store, bạn cũng sẽ cần cập nhật logic cho việc
        // tải lên ảnh mới và xóa các ảnh cũ nếu cần.
        // Tạm thời chúng ta sẽ tập trung vào việc tạo mới trước.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            // ... các validation khác
        ]);

        $productData = $request->except(['_token', '_method', 'images']);
        $productData['slug'] = Str::slug($request->name);
        
        $product->update($productData);
        // Logic xử lý ảnh cho update sẽ được thêm vào sau...

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy(Product $product)
    {
        // Thêm logic xóa file ảnh trong storage trước khi xóa bản ghi
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}