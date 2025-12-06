<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * Xử lý tin nhắn từ user và trả về phản hồi
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'nullable|string',
        ]);

        $userMessage = trim($request->message);
        $sessionId = $request->session_id ?? $this->generateSessionId();

        // Lưu tin nhắn của user
        ChatMessage::create([
            'session_id' => $sessionId,
            'sender' => 'user',
            'message' => $userMessage,
        ]);

        // Xử lý và tạo phản hồi
        $botResponse = $this->processMessage($userMessage);

        // Lưu phản hồi của bot
        ChatMessage::create([
            'session_id' => $sessionId,
            'sender' => 'bot',
            'message' => $botResponse['message'],
            'metadata' => $botResponse['metadata'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $sessionId,
            'response' => $botResponse,
        ]);
    }

    /**
     * Lấy lịch sử chat
     */
    public function getHistory(Request $request)
    {
        $sessionId = $request->session_id ?? $this->generateSessionId();

        $messages = ChatMessage::where('session_id', $sessionId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    /**
     * Xử lý tin nhắn và tạo phản hồi
     */
    private function processMessage(string $message): array
    {
        $originalMessage = $message; // Giữ nguyên message gốc để tìm sản phẩm
        $messageLower = mb_strtolower($message, 'UTF-8');

        // 1. Chào hỏi - ưu tiên cao nhất
        if ($this->matches($messageLower, ['xin chào', 'chào', 'hello', 'hi', 'hey'])) {
            return [
                'message' => 'Xin chào! 👋 Tôi là trợ lý AI của PolyTech Store. Tôi có thể giúp bạn:\n\n• Tìm kiếm sản phẩm\n• Tư vấn sản phẩm\n• Trả lời câu hỏi về đơn hàng\n• Hướng dẫn mua hàng\n\nBạn cần hỗ trợ gì?',
                'type' => 'text',
            ];
        }

        // 1.5. Câu hỏi đùa/vui - trả lời thông minh
        if ($this->matches($messageLower, ['tình yêu', 'love', 'người yêu', 'bạn gái', 'bạn trai', 'crush'])) {
            return [
                'message' => 'Haha, tình yêu thì tôi không bán được đâu! 😄\n\nNhưng tôi có thể giúp bạn tìm:\n• Điện thoại, laptop\n• Tai nghe, loa\n• Phụ kiện công nghệ\n\nBạn muốn tìm sản phẩm gì?',
                'type' => 'text',
            ];
        }

        // 2. FAQ về vận chuyển - ưu tiên cao
        if ($this->matches($messageLower, ['vận chuyển', 'ship', 'giao hàng', 'phí ship', 'phí vận chuyển', 'giao', 'shipping'])) {
            return [
                'message' => '🚚 **Thông tin vận chuyển:**\n\n• Miễn phí ship cho đơn hàng từ 500.000đ\n• Phí ship: 30.000đ cho đơn hàng dưới 500.000đ\n• Thời gian giao hàng: 2-5 ngày làm việc\n• Hỗ trợ giao hàng toàn quốc\n\nBạn có câu hỏi gì khác không?',
                'type' => 'text',
            ];
        }

        // 3. FAQ về thanh toán - ưu tiên cao (nhưng không nếu đang hỏi về giá sản phẩm)
        if ($this->matches($messageLower, ['thanh toán', 'payment', 'trả tiền', 'phương thức thanh toán', 'cách thanh toán']) && 
            !$this->matches($messageLower, ['giá', 'bao nhiêu', 'cost', 'price'])) {
            return [
                'message' => '💳 **Phương thức thanh toán:**\n\n• Thanh toán khi nhận hàng (COD)\n• Chuyển khoản ngân hàng\n• Ví điện tử (MoMo, ZaloPay)\n• Thẻ tín dụng/ghi nợ\n\nBạn muốn thanh toán bằng cách nào?',
                'type' => 'text',
            ];
        }

        // 4. FAQ về đổi trả - ưu tiên cao
        if ($this->matches($messageLower, ['đổi trả', 'đổi hàng', 'trả hàng', 'hoàn hàng', 'bảo hành', 'warranty', 'return'])) {
            return [
                'message' => '🔄 **Chính sách đổi trả:**\n\n• Đổi trả trong vòng 7 ngày kể từ ngày nhận hàng\n• Sản phẩm phải còn nguyên vẹn, chưa sử dụng\n• Miễn phí đổi trả nếu lỗi từ nhà sản xuất\n• Bảo hành theo chính sách của hãng\n\nBạn cần hỗ trợ đổi trả sản phẩm nào?',
                'type' => 'text',
            ];
        }

        // 5. Hướng dẫn đặt hàng - ưu tiên cao
        if ($this->matches($messageLower, ['đặt hàng', 'mua hàng', 'order', 'checkout', 'cách mua', 'làm sao mua'])) {
            return [
                'message' => '🛒 **Hướng dẫn đặt hàng:**\n\n1. Chọn sản phẩm bạn muốn mua\n2. Thêm vào giỏ hàng\n3. Điền thông tin giao hàng\n4. Chọn phương thức thanh toán\n5. Xác nhận đơn hàng\n\nBạn cần hỗ trợ bước nào?',
                'type' => 'text',
            ];
        }

        // 6. Tìm sản phẩm - nhận diện các câu hỏi tìm kiếm tự nhiên
        $searchKeywords = ['tìm', 'tìm kiếm', 'search', 'có', 'bán', 'mua', 'sản phẩm', 'hãy tìm', 'cho tôi', 'giúp tôi tìm', 'muốn tìm', 'cần tìm'];
        if ($this->matches($messageLower, $searchKeywords) || 
            $this->looksLikeProductName($originalMessage)) {
            $searchResult = $this->searchProducts($originalMessage);
            // Chỉ trả về nếu tìm thấy sản phẩm thật sự
            if ($searchResult['type'] === 'products' && 
                isset($searchResult['metadata']['products']) && 
                count($searchResult['metadata']['products']) > 0) {
                return $searchResult;
            }
            // Nếu có từ khóa tìm, luôn trả về kết quả (kể cả không tìm thấy)
            if ($this->matches($messageLower, $searchKeywords)) {
                return $searchResult;
            }
        }

        // 7. Câu hỏi không hiểu - thử tìm sản phẩm một lần nữa (fallback)
        // Chỉ thử nếu message có vẻ giống tên sản phẩm
        if ($this->looksLikeProductName($originalMessage)) {
            $searchResult = $this->searchProducts($originalMessage);
            if ($searchResult['type'] === 'products' && 
                isset($searchResult['metadata']['products']) && 
                count($searchResult['metadata']['products']) > 0) {
                return $searchResult;
            }
        }

        // 8. Câu hỏi không hiểu
        return [
            'message' => 'Xin lỗi, tôi chưa hiểu câu hỏi của bạn. 😅\n\nBạn có thể:\n• Tìm kiếm sản phẩm (ví dụ: "Tìm iPhone")\n• Hỏi về vận chuyển, thanh toán\n• Hỏi về đổi trả, bảo hành\n• Hướng dẫn đặt hàng\n\nTôi có thể giúp gì khác?',
            'type' => 'text',
        ];
    }

    /**
     * Kiểm tra xem message có giống tên sản phẩm không
     */
    private function looksLikeProductName(string $message): bool
    {
        // Nếu message có độ dài hợp lý và có số hoặc chữ cái viết hoa (thường là tên sản phẩm)
        $trimmed = trim($message);
        if (strlen($trimmed) < 3 || strlen($trimmed) > 100) {
            return false;
        }
        
        // Nếu có số (thường là model sản phẩm như iPhone 15, Dell XPS 15)
        if (preg_match('/\d/', $trimmed)) {
            return true;
        }
        
        // Nếu có chữ cái viết hoa (thường là tên hãng như iPhone, Dell, Samsung)
        if (preg_match('/[A-Z]/', $trimmed)) {
            return true;
        }
        
        return false;
    }

    /**
     * Tìm kiếm sản phẩm
     */
    private function searchProducts(string $message): array
    {
        // Loại bỏ các từ khóa không cần thiết
        $keywords = $this->extractKeywords($message);
        
        if (empty($keywords)) {
            return [
                'message' => 'Bạn muốn tìm sản phẩm gì? Ví dụ: "Tìm iPhone", "Điện thoại dưới 10 triệu", "Laptop gaming"...',
                'type' => 'text',
            ];
        }

        // Tìm kiếm sản phẩm
        $query = Product::query();

        // Tìm theo tên
        foreach ($keywords as $keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // Tìm theo giá (nếu có từ khóa giá)
        if (preg_match('/(\d+)\s*(triệu|tr|nghìn|k)/i', $message, $matches)) {
            $amount = (int)$matches[1];
            $unit = strtolower($matches[2]);
            
            if (in_array($unit, ['triệu', 'tr'])) {
                $maxPrice = $amount * 1000000;
            } elseif (in_array($unit, ['nghìn', 'k'])) {
                $maxPrice = $amount * 1000;
            } else {
                $maxPrice = $amount;
            }

            if (strpos($message, 'dưới') !== false || strpos($message, '<') !== false) {
                $query->where('price', '<=', $maxPrice);
            } elseif (strpos($message, 'trên') !== false || strpos($message, '>') !== false) {
                $query->where('price', '>=', $maxPrice);
            }
        }

        $products = $query->with('images', 'category')
            ->where('stock_quantity', '>', 0)
            ->limit(5)
            ->get();

        if ($products->isEmpty()) {
            // Kiểm tra xem có phải câu hỏi đùa không
            $jokeKeywords = ['tình yêu', 'love', 'người yêu', 'bạn gái', 'bạn trai', 'crush', 'hạnh phúc', 'tiền', 'money', 'giàu'];
            $messageLower = mb_strtolower($message, 'UTF-8');
            if ($this->matches($messageLower, $jokeKeywords)) {
                return [
                    'message' => 'Haha, cái này tôi không bán được đâu! 😄\n\nNhưng tôi có thể giúp bạn tìm sản phẩm công nghệ như:\n• Điện thoại, laptop\n• Tai nghe, loa\n• Phụ kiện\n\nBạn muốn tìm gì?',
                    'type' => 'text',
                ];
            }
            
            return [
                'message' => 'Không tìm thấy sản phẩm phù hợp. 😔\n\nBạn thử tìm với từ khóa khác hoặc xem tất cả sản phẩm tại trang chủ nhé!',
                'type' => 'text',
            ];
        }

        // Tạo danh sách sản phẩm
        $productList = $products->map(function($product) {
            $firstImage = $product->images->first();
            $imageUrl = $firstImage ? asset('storage/' . $firstImage->image_url) : asset('images/placeholder.jpg');
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => number_format($product->price, 0, ',', '.') . 'đ',
                'slug' => $product->slug,
                'image' => $imageUrl,
                'category' => $product->category->name ?? '',
            ];
        })->toArray();

        $message = "Tôi tìm thấy **{$products->count()}** sản phẩm phù hợp:\n\n";
        foreach ($productList as $index => $product) {
            $message .= ($index + 1) . ". **{$product['name']}**\n";
            $message .= "   💰 Giá: {$product['price']}\n";
            $message .= "   🔗 [Xem chi tiết →](/products/{$product['slug']})\n\n";
        }

        return [
            'message' => $message,
            'type' => 'products',
            'metadata' => [
                'products' => $productList,
            ],
        ];
    }

    /**
     * Trích xuất từ khóa từ câu hỏi
     */
    private function extractKeywords(string $message): array
    {
        // Loại bỏ các từ không cần thiết
        $stopWords = ['tìm', 'tìm kiếm', 'có', 'bán', 'mua', 'cho', 'tôi', 'bạn', 'với', 'giá', 'dưới', 'trên', 'khoảng', 'hãy', 'giúp', 'muốn', 'cần', 'sản phẩm', 'sp'];
        
        $message = mb_strtolower($message, 'UTF-8');
        $words = explode(' ', $message);
        $keywords = [];
        
        foreach ($words as $word) {
            $word = trim($word);
            // Loại bỏ dấu câu
            $word = preg_replace('/[^\p{L}\p{N}]/u', '', $word);
            if (strlen($word) > 1 && !in_array($word, $stopWords)) {
                $keywords[] = $word;
            }
        }
        
        return $keywords;
    }

    /**
     * Kiểm tra xem message có chứa các từ khóa không
     */
    private function matches(string $message, array $keywords): bool
    {
        foreach ($keywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Tạo session ID mới
     */
    private function generateSessionId(): string
    {
        return 'chat_' . Str::random(32);
    }
}

