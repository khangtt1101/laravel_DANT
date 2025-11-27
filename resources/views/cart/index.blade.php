<x-main-layout>
    {{-- 
        BƯỚC 1: Khởi tạo Alpine component ở thẻ cha
        - cart: Chứa toàn bộ giỏ hàng (từ PHP)
        - selected: Mảng chứa ID của các sản phẩm được chọn
    --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12"
         x-data="{
            cart: {{ json_encode($cart) }},
            selected: [],

            // Hàm kiểm tra 'Chọn tất cả'
            get isAllSelected() {
                // Chỉ chọn khi giỏ hàng có hàng
                if (Object.keys(this.cart).length === 0) return false;
                return this.selected.length === Object.keys(this.cart).length;
            },

            // Hàm tính tổng tiền (chỉ tính các sp được chọn)
            get total() {
                let calculatedTotal = 0;
                this.selected.forEach(id => {
                    if (this.cart[id]) {
                        calculatedTotal += this.cart[id].price * this.cart[id].quantity;
                    }
                });
                return calculatedTotal;
            },

            // Hàm 'Chọn tất cả'
            toggleSelectAll() {
                if (this.isAllSelected) {
                    this.selected = []; // Bỏ chọn tất cả
                } else {
                    // Lấy tất cả các 'keys' (chính là ID) từ object 'cart'
                    this.selected = Object.keys(this.cart); 
                }
            },

            // === HÀM CẬP NHẬT SỐ LƯỢNG (AJAX) ===
            updateQuantity(id, newQuantity) {
                // 1. Đảm bảo số lượng luôn >= 1
                newQuantity = Math.max(1, newQuantity);
                
                // 2. Cập nhật UI ngay lập tức
                // Chúng ta cần gán lại toàn bộ object để Alpine nhận biết thay đổi sâu
                let updatedCart = { ...this.cart };
                updatedCart[id].quantity = newQuantity;
                this.cart = updatedCart;

                // 3. Gửi fetch request (không cần $el.submit() nữa)
                fetch(`/cart/update/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: newQuantity,
                        _method: 'POST' 
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật lại giỏ hàng trên Header
                        window.dispatchEvent(new CustomEvent('cart-updated', {
                            detail: { cartCount: data.cartCount }
                        }));
                    } else {
                        alert(data.message || 'Lỗi cập nhật');
                        // (Bạn có thể thêm logic phục hồi số lượng cũ nếu lỗi)
                    }
                })
                .catch(() => alert('Lỗi kết nối.'));
            },
            
            // === HÀM XÓA SẢN PHẨM (AJAX) ===
            removeItem(id) {
                if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                    return;
                }

                fetch(`/cart/remove/${id}`, {
                    method: 'POST', // Route của bạn là POST
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                     body: JSON.stringify({
                        _method: 'POST' // Giả lập phương thức DELETE
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // 1. Tạo một bản sao của giỏ hàng
                        let updatedCart = { ...this.cart }; 
                        // 2. Xóa sản phẩm khỏi bản sao
                        delete updatedCart[id]; 
                        // 3. GÁN LẠI: Đây là bước báo cho Alpine biết
                        this.cart = updatedCart;
                        // 4. Xóa khỏi mảng 'selected'
                        this.selected = this.selected.filter(itemId => itemId != id);
                        // 5. Cập nhật Header
                        window.dispatchEvent(new CustomEvent('cart-updated', {
                            detail: { cartCount: data.cartCount }
                        }));
                    } else {
                        alert(data.message || 'Lỗi khi xóa');
                    }
                })
                .catch(() => alert('Lỗi kết nối.'));
            }
         }">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Giỏ hàng của bạn</h1>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form 'Thanh toán' giờ sẽ bọc toàn bộ --}}
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            
            {{-- 
                Bí mật: Gửi mảng 'selected' đi
                Chúng ta tạo các input[type=hidden] bằng Alpine.js
            --}}
            <template x-for="id in selected" :key="id">
                <input type="hidden" name="selected_products[]" :value="id">
            </template>
            
            {{-- 
                BƯỚC 2: Dùng x-show để hiển thị giỏ hàng hoặc thông báo "trống"
                thay vì dùng @if
            --}}
            <div x-show="Object.keys(cart).length > 0"
                 style="display: none;" {{-- Tránh FOUC --}}
            >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                            
                            <div class="p-4 sm:p-6 border-b border-gray-200">
                                <label class="flex items-center">
                                    <input type="checkbox" 
                                           @click="toggleSelectAll()"
                                           :checked="isAllSelected"
                                           class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-3 text-sm font-medium text-gray-700">
                                        Chọn tất cả (<span x-text="Object.keys(cart).length">0</span> sản phẩm)
                                    </span>
                                </label>
                            </div>

                        <ul role="list" class="divide-y divide-gray-200">
                                {{-- 
                                    BƯỚC 3: Dùng template để lặp qua 'cart' của Alpine
                                    Điều này cho phép xóa sản phẩm khỏi UI mà không cần tải lại trang
                                --}}
                                <template x-for="id in Object.keys(cart)" :key="id">
                                    <li class="p-4 sm:p-6 flex items-start">
                                        
                                        <label class="flex-shrink-0 pt-1">
                                            <input type="checkbox" 
                                                   name="selected_products[]" {{-- Thêm name --}}
                                                   :value="id" {{-- Sửa lỗi: Bỏ $ --}}
                                                   x-model="selected"
                                                   class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        </label>

                                        <div class="flex-shrink-0 w-24 h-24 sm:w-32 sm:h-32 border border-gray-200 rounded-md overflow-hidden ml-4">
                                            <img :src="'/storage/' + cart[id].image_url" :alt="cart[id].name" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/no-placeholder.jpg') }}'">
                                    </div>

                                    <div class="ml-4 flex-1 flex flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3 x-text="cart[id].name"></h3>
                                                    <p class="ml-4" x-text="new Intl.NumberFormat('vi-VN').format(cart[id].price * cart[id].quantity) + ' đ'"></p>
                                            </div>
                                                <p class="mt-1 text-sm text-gray-500" x-text="new Intl.NumberFormat('vi-VN').format(cart[id].price) + ' đ / cái'"></p>
                                        </div>
                                        <div class="flex-1 flex items-end justify-between text-sm">

                                                {{-- 
                                                    BƯỚC 4: Khối Tăng/Giảm (VIẾT ĐẦY ĐỦ)
                                                    Không còn là <form> nữa, chỉ là <div>
                                                --}}
                                                <div class="flex items-center">
                                                    <label :for="'quantity-' + id" class="mr-2 text-gray-500">Số lượng:</label>
                                                <div class="flex items-center border border-gray-300 rounded-md shadow-sm">
                                                        <button type="button" 
                                                                @click="updateQuantity(id, cart[id].quantity - 1)"
                                                        class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-l-md focus:outline-none">
                                                        -
                                                    </button>
                                                        <input type="number" :name="'quantity-' + id" :id="'quantity-' + id" min="1"
                                                               x-model="cart[id].quantity"
                                                               readonly
                                                        class="w-10 text-right border-y-0 border-x border-gray-300 focus:ring-0 p-0 py-1 sm:text-sm">
                                                        <button type="button" 
                                                                @click="updateQuantity(id, cart[id].quantity + 1)"
                                                        class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-r-md focus:outline-none">
                                                        +
                                                    </button>
                                                    </div>
                                                </div>

                                                {{-- 
                                                    BƯỚC 5: Nút Xóa (VIẾT ĐẦY ĐỦ)
                                                    Không còn là <form> nữa, chỉ là <button>
                                                --}}
                                                <button type="button" 
                                                        @click="removeItem(id)"
                                                        class="font-medium text-red-600 hover:text-red-800">Xóa
                                                </button>
                                        </div>
                                    </div>
                                </li>
                                </template>
                        </ul>
                    </div>
                </div>

                <div class="md:col-span-1">
                        <div class="bg-white shadow rounded-lg p-6 sticky top-8">
                        <h2 class="text-lg font-medium text-gray-900">Tóm tắt đơn hàng</h2>
                        <dl class="mt-6 space-y-4">
                            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                <dt class="text-base font-medium text-gray-900">Tổng tiền</dt>
                                <dd class="text-base font-medium text-gray-900">
                                        <span x-text="new Intl.NumberFormat('vi-VN').format(total)">0</span> đ
                                </dd>
                            </div>
                        </dl>
                        <div class="mt-6">
                                <button type="submit"
                                        :disabled="selected.length === 0"
                                        class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-400 disabled:cursor-not-allowed">
                                    Tiến hành thanh toán (<span x-text="selected.length">0</span>)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 
                BƯỚC 6: Khối "Giỏ hàng trống" (Sử dụng x-show)
            --}}
            <div x-show="Object.keys(cart).length === 0"
                 style="display: none;" {{-- Tránh FOUC --}}
                 class="text-center py-12 bg-white shadow rounded-lg">
                <p class="text-xl text-gray-700">Giỏ hàng của bạn đang trống.</p>
                <a href="{{ route('shop.index') }}"
                    class="mt-6 inline-block bg-indigo-600 text-white font-medium py-3 px-8 rounded-md shadow-md hover:bg-indigo-700">
                    Tiếp tục mua sắm
                </a>
            </div>
            
        </form>
    </div>
</x-main-layout>