<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductViewController extends Controller
{
    /**
     * Track khi người dùng đang xem sản phẩm
     */
    public function track(Request $request, $productId)
    {
        $sessionId = session()->getId();
        $cacheKey = "product_viewers_{$productId}";
        
        // Lấy danh sách session IDs đang xem sản phẩm này
        $viewers = Cache::get($cacheKey, []);
        
        // Thêm session ID hiện tại vào danh sách (nếu chưa có)
        if (!in_array($sessionId, $viewers)) {
            $viewers[] = $sessionId;
        }
        
        // Lưu lại với TTL 5 phút (300 giây)
        Cache::put($cacheKey, $viewers, now()->addMinutes(5));
        
        return response()->json([
            'success' => true,
            'viewers_count' => count($viewers)
        ]);
    }
    
    /**
     * Lấy số người đang xem sản phẩm
     */
    public function getViewers($productId)
    {
        $cacheKey = "product_viewers_{$productId}";
        $viewers = Cache::get($cacheKey, []);
        
        // Loại bỏ các session ID trùng lặp
        $viewers = array_unique($viewers);
        
        $count = count($viewers);
        
        // Nếu không có ai đang xem, trả về số ngẫu nhiên từ 3-15 để tạo social proof
        if ($count === 0) {
            $count = rand(3, 15);
        }
        
        return response()->json([
            'viewers_count' => $count
        ]);
    }
    
    /**
     * Lấy số người đang xem cho nhiều sản phẩm cùng lúc
     */
    public function getMultipleViewers(Request $request)
    {
        $productIds = $request->input('product_ids', []);
        $result = [];
        
        foreach ($productIds as $productId) {
            $cacheKey = "product_viewers_{$productId}";
            $viewers = Cache::get($cacheKey, []);
            $count = count($viewers);
            
            // Nếu không có ai đang xem, trả về số ngẫu nhiên từ 3-15
            if ($count === 0) {
                $count = rand(3, 15);
            }
            
            $result[$productId] = $count;
        }
        
        return response()->json($result);
    }
}

