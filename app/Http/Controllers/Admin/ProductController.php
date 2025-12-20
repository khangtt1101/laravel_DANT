<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // ... các phương thức index, create, edit, show giữ nguyên ...
    public function index(Request $request) // <-- Thêm Request $request
    {
        // 1. Lấy danh sách categories để hiển thị trong dropdown filter
        $categories = Category::all();

        // 2. Bắt đầu truy vấn sản phẩm
        $query = Product::with('category')->latest();

        // 3. Xử lý tìm kiếm (nếu có)
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // 4. Xử lý lọc theo danh mục (nếu có)
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // 5. Lấy kết quả, phân trang và giữ lại các tham số query (search, category)
        $products = $query->paginate(10)->withQueryString();

        // 6. Trả về view với cả $products và $categories
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images'); // <-- Tải các ảnh liên quan
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Lưu sản phẩm mới và ảnh vào database.
     */
    public function store(StoreProductRequest $request)
    {
        // Sử dụng dữ liệu đã được validate và xử lý từ StoreProductRequest
        $validatedData = $request->validated();

        // Bắt đầu một transaction
        DB::beginTransaction();

        try {
            // Lấy dữ liệu sản phẩm (không bao gồm ảnh)
            $productData = collect($validatedData)->except('images')->toArray();
            if (isset($productData['specifications'])) {
                $productData['specifications'] = array_values($productData['specifications']);
            }
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
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            // 1. Cập nhật thông tin sản phẩm (trừ ảnh)
            $productData = $request->except(['_token', '_method', 'images', 'delete_images']);
            if (isset($productData['specifications'])) {
                $productData['specifications'] = array_values($productData['specifications']);
            }
            $productData['slug'] = Str::slug($request->name);
            $product->update($productData);

            // 2. Xử lý xóa ảnh cũ (nếu có)
            if ($request->has('delete_images')) {
                foreach ($request->input('delete_images') as $imageId) {
                    $image = ProductImage::find($imageId);
                    if ($image) {
                        // Xóa file khỏi storage
                        Storage::disk('public')->delete($image->image_url);
                        // Xóa bản ghi khỏi database
                        $image->delete();
                    }
                }
            }

            // 3. Xử lý tải ảnh mới (nếu có)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('products', $fileName, 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $path,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return back()->with('error', 'Đã xảy ra lỗi khi cập nhật.')->withInput();
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            // Lấy tất cả ảnh liên quan
            $images = $product->images;

            // 1. Xóa tất cả file ảnh khỏi storage
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->image_url);
            }

            // 2. Xóa các bản ghi ảnh (sẽ tự động nếu có onDelete('cascade'))
            // $product->images()->delete(); // Bỏ comment dòng này nếu bạn không set cascade

            // 3. Xóa sản phẩm
            $product->delete(); // Thao tác này sẽ tự động xóa images và order_items nếu migration của bạn có onDelete('cascade')

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm.');
        }
    }
}