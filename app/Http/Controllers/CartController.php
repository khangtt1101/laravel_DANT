<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::with('images')->find($request->product_id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại!'
                ], 404);
            }

            // Lấy giỏ hàng từ session
            $cart = session()->get('cart', []);

            // Kiểm tra nếu sản phẩm đã có trong giỏ
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $request->quantity;
            } else {
                // Thêm mới sản phẩm vào giỏ
                $cart[$product->id] = [
                    'name' => $product->name,
                    'quantity' => $request->quantity,
                    'price' => $product->price,
                    'image_url' => $product->images->isEmpty() ? '' : $product->images->first()->image_url,
                ];
            }

            // Lưu giỏ hàng trở lại session
            session()->put('cart', $cart);

            // Tính tổng số lượng sản phẩm trong giỏ
            $cartCount = array_sum(array_column($cart, 'quantity'));

            // Luôn trả về JSON nếu request có Content-Type: application/json, Accept: application/json, hoặc là AJAX
            $isJsonRequest = $request->ajax() 
                || $request->expectsJson() 
                || $request->wantsJson() 
                || $request->header('Content-Type') === 'application/json'
                || $request->header('Accept') === 'application/json'
                || $request->header('X-Requested-With') === 'XMLHttpRequest';

            if ($isJsonRequest) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm sản phẩm vào giỏ hàng!',
                    'cart_count' => $cartCount
                ]);
            }

            // Fallback: nếu không phải AJAX request, redirect như cũ
            return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ!',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra. Vui lòng thử lại.'
            ], 500);
        }
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