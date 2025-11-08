<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use Carbon\Carbon;

class ProductViewController extends Controller
{
    /**
     * Track khi người dùng xem sản phẩm
     */
    public function track(Request $request, $productId)
    {
        try {
            // Validate productId
            $productId = (int) $productId;
            if ($productId <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid product ID'
                ], 400);
            }

            // Kiểm tra sản phẩm có tồn tại không
            if (!Product::find($productId)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            // Lấy session ID
            $sessionId = session()->getId();
            if (!$sessionId) {
                // Nếu chưa có session, tạo mới
                session()->start();
                $sessionId = session()->getId();
            }

            $key = "product_viewing_{$productId}";
            
            // Lấy danh sách session đang xem sản phẩm này
            $viewers = Cache::get($key, []);
            
            // Đảm bảo $viewers là array
            if (!is_array($viewers)) {
                $viewers = [];
            }
            
            // Thêm session hiện tại vào danh sách (nếu chưa có)
            if (!in_array($sessionId, $viewers)) {
                $viewers[] = $sessionId;
            }
            
            // Lưu lại với thời gian 5 phút
            Cache::put($key, $viewers, now()->addMinutes(5));
            
            return response()->json([
                'success' => true,
                'viewing_count' => count($viewers)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error tracking view',
                'viewing_count' => 0
            ], 500);
        }
    }
    
    /**
     * Lấy số người đang xem sản phẩm
     */
    public function getViewingCount($productId)
    {
        try {
            $productId = (int) $productId;
            if ($productId <= 0) {
                return response()->json([
                    'viewing_count' => 0
                ]);
            }

            $key = "product_viewing_{$productId}";
            $viewers = Cache::get($key, []);
            
            // Đảm bảo là array
            if (!is_array($viewers)) {
                $viewers = [];
            }
            
            return response()->json([
                'viewing_count' => count($viewers)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'viewing_count' => 0
            ]);
        }
    }
    
    /**
     * Lấy số người đang xem nhiều sản phẩm cùng lúc
     */
    public function getMultipleViewingCounts(Request $request)
    {
        try {
            $productIds = $request->input('product_ids', []);
            
            // Validate input
            if (!is_array($productIds) || empty($productIds)) {
                return response()->json([
                    'counts' => []
                ]);
            }

            // Giới hạn số lượng để tránh quá tải
            $productIds = array_slice($productIds, 0, 50);
            
            $counts = [];
            
            foreach ($productIds as $productId) {
                $productId = (int) $productId;
                if ($productId > 0) {
                    $key = "product_viewing_{$productId}";
                    $viewers = Cache::get($key, []);
                    
                    // Đảm bảo là array
                    if (!is_array($viewers)) {
                        $viewers = [];
                    }
                    
                    $counts[$productId] = count($viewers);
                }
            }
            
            return response()->json([
                'counts' => $counts
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'counts' => []
            ]);
        }
    }
}

