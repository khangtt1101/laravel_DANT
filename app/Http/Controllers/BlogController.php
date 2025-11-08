<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Danh sách bài viết blog
     */
    public function index()
    {
        $posts = $this->getBlogPosts();
        return view('blog-list', compact('posts'));
    }

    /**
     * Chi tiết bài viết
     */
    public function show($slug)
    {
        $posts = $this->getBlogPosts();
        $post = collect($posts)->firstWhere('slug', $slug);
        
        if (!$post) {
            abort(404);
        }

        // Lấy các bài viết liên quan (loại trừ bài hiện tại)
        $relatedPosts = collect($posts)
            ->where('id', '!=', $post['id'])
            ->take(3)
            ->values();

        return view('blog-detail', compact('post', 'relatedPosts'));
    }

    /**
     * Lấy danh sách bài viết (tạm thời dùng static data)
     * Sau này có thể thay bằng Model Blog
     */
    private function getBlogPosts()
    {
        return [
            [
                'id' => 1,
                'slug' => 'top-10-san-pham-cong-nghe-hot-nhat-nam-2024',
                'title' => 'Top 10 sản phẩm công nghệ hot nhất năm 2024',
                'excerpt' => 'Khám phá những sản phẩm công nghệ đang được săn đón nhất trong năm 2024, từ smartphone đến laptop và các thiết bị thông minh.',
                'content' => '<h2>Giới thiệu</h2>
                <p>Năm 2024 đánh dấu một bước tiến lớn trong ngành công nghệ với nhiều sản phẩm đột phá. Từ những chiếc smartphone với camera AI thông minh đến laptop gaming hiệu năng cao, thị trường công nghệ đang sôi động hơn bao giờ hết.</p>
                
                <h2>1. iPhone 15 Pro Max - Flagship của Apple</h2>
                <p>iPhone 15 Pro Max tiếp tục khẳng định vị thế với chip A17 Pro mạnh mẽ, camera 48MP và thiết kế titan cao cấp. Đây là lựa chọn hàng đầu cho những người dùng yêu thích iOS và muốn trải nghiệm tốt nhất.</p>
                
                <h2>2. Samsung Galaxy S24 Ultra</h2>
                <p>Với bút S Pen tích hợp, màn hình Dynamic AMOLED 2X 120Hz và camera 200MP, Galaxy S24 Ultra là đối thủ đáng gờm của iPhone trong phân khúc flagship Android.</p>
                
                <h2>3. MacBook Pro M3 Max</h2>
                <p>MacBook Pro với chip M3 Max mang lại hiệu năng vượt trội cho các tác vụ chuyên nghiệp như video editing, 3D rendering và phát triển phần mềm.</p>
                
                <h2>4. iPad Pro 12.9 inch M2</h2>
                <p>iPad Pro với chip M2 và màn hình Liquid Retina XDR là công cụ hoàn hảo cho các designer và artist chuyên nghiệp.</p>
                
                <h2>5. AirPods Pro 2</h2>
                <p>Với tính năng chống ồn chủ động cải tiến và chất lượng âm thanh spatial audio, AirPods Pro 2 là tai nghe không dây tốt nhất hiện nay.</p>
                
                <h2>6. Sony WH-1000XM5</h2>
                <p>Tai nghe chống ồn hàng đầu với thời lượng pin 30 giờ và chất lượng âm thanh Hi-Res Audio.</p>
                
                <h2>7. Apple Watch Series 9</h2>
                <p>Smartwatch với chip S9 mới, màn hình Always-On sáng hơn và tính năng sức khỏe nâng cao.</p>
                
                <h2>8. Nintendo Switch OLED</h2>
                <p>Phiên bản nâng cấp với màn hình OLED 7 inch, âm thanh stereo và dock cải tiến.</p>
                
                <h2>9. Oculus Quest 3</h2>
                <p>VR headset standalone với độ phân giải cao hơn và hiệu năng mạnh mẽ hơn thế hệ trước.</p>
                
                <h2>10. DJI Mini 4 Pro</h2>
                <p>Drone nhỏ gọn với camera 4K, tính năng tránh vật cản 360 độ và thời lượng bay lên đến 34 phút.</p>
                
                <h2>Kết luận</h2>
                <p>Năm 2024 là năm của sự đổi mới và đột phá trong công nghệ. Từ smartphone đến laptop, từ tai nghe đến smartwatch, mỗi sản phẩm đều mang lại trải nghiệm tuyệt vời cho người dùng. Hãy chọn cho mình sản phẩm phù hợp nhất với nhu cầu và ngân sách của bạn.</p>',
                'category' => 'Tin tức',
                'category_color' => 'indigo',
                'image' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=800&q=80',
                'author' => 'DATN Store',
                'published_at' => now()->format('d/m/Y'),
                'read_time' => '8 phút',
                'views' => 1250,
            ],
            [
                'id' => 2,
                'slug' => 'cach-chon-mua-dien-thoai-phu-hop-voi-nhu-cau',
                'title' => 'Cách chọn mua điện thoại phù hợp với nhu cầu',
                'excerpt' => 'Hướng dẫn chi tiết giúp bạn chọn được chiếc smartphone phù hợp nhất với nhu cầu và ngân sách của mình.',
                'content' => '<h2>Giới thiệu</h2>
                <p>Chọn mua điện thoại là một quyết định quan trọng vì đây là thiết bị bạn sẽ sử dụng hàng ngày. Với hàng trăm mẫu smartphone trên thị trường, việc chọn được chiếc phù hợp có thể là thách thức. Bài viết này sẽ hướng dẫn bạn cách chọn điện thoại đúng nhu cầu.</p>
                
                <h2>1. Xác định ngân sách</h2>
                <p>Bước đầu tiên và quan trọng nhất là xác định ngân sách của bạn. Điện thoại được chia thành các phân khúc:</p>
                <ul>
                    <li><strong>Phân khúc giá rẻ (dưới 5 triệu):</strong> Phù hợp cho nhu cầu cơ bản như gọi, nhắn tin, lướt web.</li>
                    <li><strong>Phân khúc tầm trung (5-15 triệu):</strong> Cân bằng giữa giá cả và tính năng, phù hợp đa số người dùng.</li>
                    <li><strong>Phân khúc cao cấp (15-30 triệu):</strong> Hiệu năng mạnh, camera tốt, thiết kế cao cấp.</li>
                    <li><strong>Phân khúc flagship (trên 30 triệu):</strong> Tính năng tốt nhất, thiết kế premium.</li>
                </ul>
                
                <h2>2. Xác định nhu cầu sử dụng</h2>
                <p>Mỗi người có nhu cầu sử dụng khác nhau:</p>
                <ul>
                    <li><strong>Người dùng cơ bản:</strong> Gọi, nhắn tin, lướt web, mạng xã hội → Chọn điện thoại tầm trung.</li>
                    <li><strong>Người dùng chụp ảnh:</strong> Ưu tiên camera chất lượng cao → Chọn điện thoại có camera tốt.</li>
                    <li><strong>Game thủ:</strong> Cần hiệu năng mạnh, màn hình tốt → Chọn điện thoại gaming hoặc flagship.</li>
                    <li><strong>Doanh nhân:</strong> Cần pin lâu, hiệu năng ổn định → Chọn điện thoại business.</li>
                </ul>
                
                <h2>3. Các yếu tố cần quan tâm</h2>
                
                <h3>3.1. Hiệu năng (CPU, RAM)</h3>
                <p>Hiệu năng quyết định tốc độ xử lý và khả năng chạy ứng dụng nặng. Với nhu cầu cơ bản, chip tầm trung là đủ. Với gaming hoặc công việc chuyên nghiệp, cần chip flagship.</p>
                
                <h3>3.2. Màn hình</h3>
                <p>Kích thước màn hình phụ thuộc vào sở thích cá nhân. Màn hình lớn tốt cho xem phim, chơi game nhưng khó cầm một tay. Độ phân giải Full HD+ trở lên cho trải nghiệm tốt.</p>
                
                <h3>3.3. Camera</h3>
                <p>Nếu bạn thích chụp ảnh, hãy quan tâm đến:
                <ul>
                    <li>Số megapixel (không phải yếu tố duy nhất)</li>
                    <li>Khẩu độ (f/ số càng nhỏ càng tốt)</li>
                    <li>Chế độ chụp đêm</li>
                    <li>Video 4K</li>
                </ul>
                </p>
                
                <h3>3.4. Pin</h3>
                <p>Dung lượng pin từ 4000mAh trở lên đảm bảo sử dụng cả ngày. Tính năng sạc nhanh cũng rất hữu ích.</p>
                
                <h3>3.5. Hệ điều hành</h3>
                <p>iOS (iPhone) và Android có ưu nhược điểm khác nhau:
                <ul>
                    <li><strong>iOS:</strong> Mượt mà, bảo mật tốt, nhưng giá cao và ít tùy biến.</li>
                    <li><strong>Android:</strong> Đa dạng lựa chọn, giá cả phải chăng, tùy biến cao.</li>
                </ul>
                </p>
                
                <h2>4. So sánh các mẫu phổ biến</h2>
                <p>Một số gợi ý theo phân khúc:</p>
                <ul>
                    <li><strong>Giá rẻ:</strong> Samsung Galaxy A series, Xiaomi Redmi Note series</li>
                    <li><strong>Tầm trung:</strong> iPhone SE, Samsung Galaxy A5x series, Xiaomi Mi series</li>
                    <li><strong>Cao cấp:</strong> iPhone 14/15, Samsung Galaxy S series, Google Pixel</li>
                    <li><strong>Flagship:</strong> iPhone Pro Max, Samsung Galaxy S Ultra, Xiaomi 13 Pro</li>
                </ul>
                
                <h2>5. Mua ở đâu uy tín?</h2>
                <p>Nên mua tại:
                <ul>
                    <li>Cửa hàng chính hãng hoặc đại lý ủy quyền</li>
                    <li>Website thương mại điện tử uy tín</li>
                    <li>Kiểm tra tem bảo hành và hóa đơn đầy đủ</li>
                </ul>
                </p>
                
                <h2>Kết luận</h2>
                <p>Chọn điện thoại phù hợp cần cân nhắc nhiều yếu tố: ngân sách, nhu cầu, tính năng. Đừng chỉ chạy theo xu hướng mà hãy chọn sản phẩm thực sự phù hợp với bạn. Nếu cần tư vấn, hãy liên hệ với chúng tôi để được hỗ trợ tốt nhất.</p>',
                'category' => 'Hướng dẫn',
                'category_color' => 'green',
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800&q=80',
                'author' => 'DATN Store',
                'published_at' => now()->subDay()->format('d/m/Y'),
                'read_time' => '10 phút',
                'views' => 980,
            ],
            [
                'id' => 3,
                'slug' => 'review-chi-tiet-laptop-moi-nhat-2024',
                'title' => 'Review chi tiết: Laptop mới nhất 2024 có gì đặc biệt?',
                'excerpt' => 'Đánh giá toàn diện về các dòng laptop mới nhất năm 2024, so sánh hiệu năng, giá cả và tính năng nổi bật.',
                'content' => '<h2>Giới thiệu</h2>
                <p>Năm 2024 chứng kiến sự bùng nổ của các dòng laptop mới với nhiều cải tiến đột phá. Từ MacBook với chip M3 đến laptop gaming với card đồ họa RTX 40 series, thị trường laptop đang sôi động hơn bao giờ hết. Bài review này sẽ giúp bạn hiểu rõ về các dòng laptop mới nhất.</p>
                
                <h2>1. MacBook Pro M3 Max - Vua của hiệu năng</h2>
                <p>MacBook Pro M3 Max là sự lựa chọn hàng đầu cho các chuyên gia. Với chip M3 Max mới, máy có hiệu năng vượt trội:</p>
                <ul>
                    <li>CPU: 16 lõi (12 hiệu năng + 4 tiết kiệm điện)</li>
                    <li>GPU: 40 lõi</li>
                    <li>RAM: Lên đến 128GB</li>
                    <li>Màn hình: Liquid Retina XDR 14" hoặc 16"</li>
                </ul>
                <p><strong>Ưu điểm:</strong> Hiệu năng cực mạnh, pin lâu, màn hình tuyệt đẹp, thiết kế premium.</p>
                <p><strong>Nhược điểm:</strong> Giá cao, nặng, ít cổng kết nối.</p>
                <p><strong>Phù hợp với:</strong> Video editor, 3D artist, developer, designer chuyên nghiệp.</p>
                
                <h2>2. Dell XPS 15 2024 - Windows flagship</h2>
                <p>Dell XPS 15 tiếp tục là một trong những laptop Windows tốt nhất:</p>
                <ul>
                    <li>CPU: Intel Core i9-13900H hoặc AMD Ryzen 9</li>
                    <li>GPU: NVIDIA RTX 4070</li>
                    <li>RAM: Lên đến 64GB</li>
                    <li>Màn hình: OLED 15.6" 4K</li>
                </ul>
                <p><strong>Ưu điểm:</strong> Màn hình OLED tuyệt đẹp, hiệu năng mạnh, thiết kế đẹp.</p>
                <p><strong>Nhược điểm:</strong> Pin không lâu bằng MacBook, giá cao.</p>
                <p><strong>Phù hợp với:</strong> Designer, content creator, doanh nhân.</p>
                
                <h2>3. ASUS ROG Zephyrus G16 - Laptop gaming hàng đầu</h2>
                <p>Laptop gaming với hiệu năng cực mạnh:</p>
                <ul>
                    <li>CPU: Intel Core i9-14900HX</li>
                    <li>GPU: NVIDIA RTX 4090</li>
                    <li>RAM: 32GB DDR5</li>
                    <li>Màn hình: 16" QHD+ 240Hz</li>
                </ul>
                <p><strong>Ưu điểm:</strong> Hiệu năng gaming cực mạnh, màn hình 240Hz mượt mà, thiết kế đẹp.</p>
                <p><strong>Nhược điểm:</strong> Pin ngắn khi gaming, nặng, giá rất cao.</p>
                <p><strong>Phù hợp với:</strong> Game thủ chuyên nghiệp, streamer.</p>
                
                <h2>4. Lenovo ThinkPad X1 Carbon Gen 12 - Business laptop</h2>
                <p>Laptop business với độ bền cao:</p>
                <ul>
                    <li>CPU: Intel Core i7-1365U</li>
                    <li>RAM: Lên đến 32GB</li>
                    <li>Màn hình: 14" WQXGA</li>
                    <li>Bàn phím: ThinkPad keyboard nổi tiếng</li>
                </ul>
                <p><strong>Ưu điểm:</strong> Bàn phím tốt nhất, bền bỉ, nhẹ, pin lâu.</p>
                <p><strong>Nhược điểm:</strong> Hiệu năng không bằng gaming laptop, giá cao.</p>
                <p><strong>Phù hợp với:</strong> Doanh nhân, nhân viên văn phòng, developer.</p>
                
                <h2>5. HP Spectre x360 14 - 2-in-1 premium</h2>
                <p>Laptop 2-in-1 với thiết kế đẹp:</p>
                <ul>
                    <li>CPU: Intel Core i7-1355U</li>
                    <li>RAM: Lên đến 32GB</li>
                    <li>Màn hình: OLED 14" touchscreen</li>
                    <li>Thiết kế: 360 độ xoay</li>
                </ul>
                <p><strong>Ưu điểm:</strong> Thiết kế đẹp, màn hình cảm ứng, linh hoạt.</p>
                <p><strong>Nhược điểm:</strong> Hiệu năng không bằng laptop thông thường, giá cao.</p>
                <p><strong>Phù hợp với:</strong> Người dùng cần tính linh hoạt, designer, student.</p>
                
                <h2>So sánh tổng quan</h2>
                <table class="w-full border-collapse border border-gray-300 my-6">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-3 text-left">Model</th>
                            <th class="border border-gray-300 p-3 text-left">Hiệu năng</th>
                            <th class="border border-gray-300 p-3 text-left">Pin</th>
                            <th class="border border-gray-300 p-3 text-left">Giá (ước tính)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-3">MacBook Pro M3 Max</td>
                            <td class="border border-gray-300 p-3">⭐⭐⭐⭐⭐</td>
                            <td class="border border-gray-300 p-3">⭐⭐⭐⭐⭐</td>
                            <td class="border border-gray-300 p-3">80-120 triệu</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-3">Dell XPS 15</td>
                            <td class="border border-gray-300 p-3">⭐⭐⭐⭐</td>
                            <td class="border border-gray-300 p-3">⭐⭐⭐</td>
                            <td class="border border-gray-300 p-3">50-70 triệu</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-3">ASUS ROG Zephyrus G16</td>
                            <td class="border border-gray-300 p-3">⭐⭐⭐⭐⭐</td>
                            <td class="border border-gray-300 p-3">⭐⭐</td>
                            <td class="border border-gray-300 p-3">60-90 triệu</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-3">ThinkPad X1 Carbon</td>
                            <td class="border border-gray-300 p-3">⭐⭐⭐</td>
                            <td class="border border-gray-300 p-3">⭐⭐⭐⭐</td>
                            <td class="border border-gray-300 p-3">40-60 triệu</td>
                        </tr>
                    </tbody>
                </table>
                
                <h2>Kết luận</h2>
                <p>Mỗi dòng laptop đều có ưu nhược điểm riêng. MacBook Pro M3 Max phù hợp cho các chuyên gia cần hiệu năng cực mạnh. Dell XPS 15 là lựa chọn tốt cho người dùng Windows. ASUS ROG phù hợp với game thủ. ThinkPad X1 Carbon lý tưởng cho doanh nhân. Hãy chọn laptop phù hợp với nhu cầu và ngân sách của bạn.</p>',
                'category' => 'Đánh giá',
                'category_color' => 'orange',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800&q=80',
                'author' => 'DATN Store',
                'published_at' => now()->subDays(2)->format('d/m/Y'),
                'read_time' => '12 phút',
                'views' => 1560,
            ],
        ];
    }
}

