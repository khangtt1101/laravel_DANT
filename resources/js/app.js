import './bootstrap';

import Alpine from 'alpinejs';
import 'lazysizes'; 
import 'lazysizes/plugins/parent-fit/ls.parent-fit';

// ===== BẮT ĐẦU THÊM CODE MỚI =====

// 1. Định nghĩa "Kho chứa" (Store)
document.addEventListener('alpine:initializing', () => {
    Alpine.store('cart', {
        
        // 2. Bộ nhớ (State): Lưu danh sách ID các sản phẩm trong giỏ
        items: [], 
        
        // 3. Hàm khởi tạo: Nhận dữ liệu giỏ hàng từ PHP (sẽ làm ở Bước 2)
        init(initialItemIds) {
            this.items = initialItemIds;
        },

        // 4. Hàm kiểm tra: Sản phẩm này có trong giỏ không?
        isInCart(productId) {
            return this.items.includes(productId);
        },

        // 5. HÀM LOGIC: Định nghĩa addToCart MỘT LẦN DUY NHẤT
        addToCart(productId) {
            // 5a. Cập nhật UI ngay lập tức
            if (!this.isInCart(productId)) {
                this.items.push(productId);
            }
            
            // 5b. Gửi request AJAX (Fetch)
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => {
                // ===== BẮT ĐẦU SỬA LỖI =====
                // Kiểm tra xem server có trả về lỗi 401 (Chưa đăng nhập) không
                if (response.status === 401) { 
                    // Nếu đúng, chuyển hướng người dùng đến trang đăng nhập
                    window.location.href = '/login';
                    // Ném lỗi để dừng tiến trình
                    throw new Error('Chưa đăng nhập, đang chuyển hướng...');
                }
                // ===== KẾT THÚC SỬA LỖI =====

                if (!response.ok) {
                    // Ném các lỗi khác (như 422, 500)
                    throw new Error('Server response not OK');
                }

                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // 5c. Phát sự kiện cho Header
                    window.dispatchEvent(new CustomEvent('cart-updated', {
                        detail: { cartCount: data.cartCount }
                    }));
                } else {
                    // 5d. Nếu lỗi: Xóa sản phẩm khỏi UI
                    this.items = this.items.filter(id => id !== productId);
                    alert(data.message || 'Lỗi thêm vào giỏ.');
                }
            })
            .catch(error => {
                // 5e. Nếu lỗi mạng hoặc lỗi 401: Xóa sản phẩm khỏi UI
                this.items = this.items.filter(id => id !== productId);
                
                // Không 'alert' nếu là lỗi 401 (vì đã chuyển hướng)
                if (error.message !== 'Chưa đăng nhập, đang chuyển hướng...') {
                     console.error('Lỗi khi thêm vào giỏ:', error);
                     alert(error.message || 'Lỗi kết nối.');
                }
            });
        }
    });
});

// ===== KẾT THÚC CODE MỚI =====

window.Alpine = Alpine;

Alpine.start();
