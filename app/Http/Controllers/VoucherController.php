<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\VoucherUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    /**
     * Validate và tính toán giảm giá cho voucher
     */
    public function validate(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'total_amount' => 'nullable|numeric|min:0', // Tổng tiền từ client (các sản phẩm đã chọn)
        ]);

        $code = strtoupper(trim($request->code));
        $voucher = Voucher::where('code', $code)->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã voucher không tồn tại.',
            ], 404);
        }

        // Tính tổng tiền: ưu tiên từ request, nếu không có thì tính từ toàn bộ giỏ hàng
        $totalAmount = $request->input('total_amount');
        if ($totalAmount === null || $totalAmount === '') {
            $cart = session()->get('cart', []);
            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }
        }

        // Kiểm tra voucher có hợp lệ không
        $user = Auth::user();
        $validation = $voucher->isValid($user, $totalAmount);

        if (!$validation['valid']) {
            return response()->json([
                'success' => false,
                'message' => $validation['message'],
            ], 400);
        }

        // Tính toán số tiền giảm giá
        $discountAmount = $voucher->calculateDiscount($totalAmount);
        $finalAmount = max(0, $totalAmount - $discountAmount);

        // Lưu voucher vào session
        session()->put('applied_voucher', [
            'code' => $voucher->code,
            'name' => $voucher->name,
            'type' => $voucher->type,
            'value' => $voucher->value,
            'id' => $voucher->id,
        ]);
        session()->put('voucher_discount', $discountAmount);

        return response()->json([
            'success' => true,
            'voucher' => [
                'code' => $voucher->code,
                'name' => $voucher->name,
                'type' => $voucher->type,
                'value' => $voucher->value,
            ],
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'final_amount' => $finalAmount,
            'message' => 'Áp dụng voucher thành công!',
        ]);
    }

    /**
     * Xóa voucher khỏi session
     */
    public function remove(Request $request)
    {
        session()->forget(['applied_voucher', 'voucher_discount']);
        
        // Tính lại tổng tiền
        $cart = session()->get('cart', []);
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'total_amount' => $totalAmount,
            'final_amount' => $totalAmount,
            'discount_amount' => 0,
            'message' => 'Đã xóa voucher.',
        ]);
    }
}

