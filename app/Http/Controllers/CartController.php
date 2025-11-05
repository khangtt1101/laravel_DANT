<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Hiển thị trang giỏ hàng.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;

        // Tính tổng tiền
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'totalPrice'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function add(Request $request)
    {
        // ===== BẮT ĐẦU SỬA LỖI =====
        // 1. Dùng Validator::make() để đọc request JSON
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // 2. Tự kiểm tra nếu validation thất bại
        if ($validator->fails()) {
            // 3. Luôn luôn trả về 422 JSON
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors' => $validator->errors()
            ], 422); // 422 = Unprocessable Entity
        }
        // ===== KẾT THÚC SỬA LỖI =====

        // Lấy dữ liệu đã được validate
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::with('images')->find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại!'], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image_url' => $product->images->isEmpty() ? '' : $product->images->first()->image_url,
            ];
        }

        session()->put('cart', $cart);

        // Tính lại tổng số lượng
        $newCartCount = 0;
        foreach($cart as $id => $details) {
            $newCartCount += $details['quantity'];
        }
        
        // Trả về JSON thành công
        return response()->json([
            'success' => true,
            'message' => 'Đã thêm sản phẩm!',
            'cartCount' => $newCartCount 
        ]);
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     */
    public function update(Request $request, $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return back()->with('success', 'Cập nhật giỏ hàng thành công!');
        }

        return back()->with('error', 'Sản phẩm không có trong giỏ!');
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Xóa sản phẩm
            session()->put('cart', $cart);
            return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
        }

        return back()->with('error', 'Sản phẩm không có trong giỏ!');
    }
}