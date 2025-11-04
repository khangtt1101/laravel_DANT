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
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::with('images')->find($request->product_id);
        if (!$product) {
            return back()->with('error', 'Sản phẩm không tồn tại!');
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

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
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