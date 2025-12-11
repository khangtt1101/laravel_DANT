<x-main-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gray-100" x-data="{
            addresses: {{ Auth::user()->addresses->toJson() }},
            showAddressModal: false,
            newAddress: {
                address_line: '',
                city: '',
                district: '',
                phone_number: ''
            },
            
            // Hàm xử lý AJAX (fetch) để thêm địa chỉ
            addNewAddress() {
                fetch('{{ route('checkout.address.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.newAddress)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // 1. Thêm địa chỉ mới vào mảng 'addresses' (tự động cập nhật UI)
                        this.addresses.push(data.newAddress);
                        // 2. Đóng modal
                        this.showAddressModal = false;
                        // 3. Reset form
                        this.newAddress = { address_line: '', city: '', district: '', phone_number: '' };
                    } else {
                        alert(data.message || 'Lỗi. Vui lòng kiểm tra lại thông tin.');
                    }
                })
                .catch(() => {
                    alert('Lỗi kết nối, vui lòng thử lại.');
                });
            }
         }">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Thanh toán</h1>

        {{-- Lấy dữ liệu từ Session --}}
        @php
            // Lấy giỏ hàng sẽ thanh toán
            $checkoutCart = session('checkout_cart', []);

            // Tính lại tổng tiền từ giỏ hàng để đảm bảo luôn chính xác
            $totalPrice = 0;
            foreach ($checkoutCart as $id => $details) {
                $totalPrice += $details['price'] * $details['quantity'];
            }

            // Lấy thông tin voucher (nếu có)
            $checkoutVoucher = session('checkout_voucher');
            $checkoutVoucherDiscount = session('checkout_voucher_discount', 0);

            // Thành tiền cuối cùng sau giảm giá
            $finalTotal = max(0, $totalPrice - $checkoutVoucherDiscount);
        @endphp

        @if(count($checkoutCart) > 0)
            <form id="checkoutForm" action="{{ route('checkout.placeOrder') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <div class="md:col-span-2 space-y-6">

                        <div class="bg-white shadow rounded-lg p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Chọn địa chỉ nhận hàng</h2>
                            <div class="space-y-4">
                                <template x-for="(address, index) in addresses" :key="address.id">
                                    <label class="flex items-center p-4 border rounded-md cursor-pointer">
                                        <input type="radio" name="user_address_id" :value="address.id"
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" :checked="index === 0">
                                        {{-- Tự động chọn địa chỉ đầu tiên --}}
                                        <div class="ml-3 text-sm">
                                            <p class="font-medium text-gray-900">{{ Auth::user()->full_name }}</p>
                                            <p class="text-gray-600" x-text="address.phone_number"></p>
                                            <p class="text-gray-600"
                                                x-text="`${address.address_line}, ${address.district}, ${address.city}`">
                                            </p>
                                        </div>
                                    </label>
                                </template>

                                {{-- Hiển thị nếu không có địa chỉ (bằng Alpine.js) --}}
                                <div x-show="addresses.length === 0" class="text-sm text-gray-500">
                                    Bạn chưa có địa chỉ nào. Vui lòng thêm một địa chỉ.
                                </div>
                                @error('user_address_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <button type="button" @click="showAddressModal = true"
                                class="mt-6 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                + Thêm địa chỉ mới
                            </button>
                        </div>

                        <div class="bg-white shadow rounded-lg p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Chọn phương thức thanh toán</h2>
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border rounded-md cursor-pointer">
                                    <input type="radio" name="payment_method" value="COD"
                                        onchange="document.getElementById('checkoutForm').action = '{{ route('checkout.placeOrder') }}'"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500" checked>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Thanh toán khi nhận hàng
                                        (COD)</span>
                                </label>
                                <label class="flex items-center p-4 border rounded-md cursor-pointer">
                                    <input type="radio" name="payment_method" value="VNPay"
                                        onchange="document.getElementById('checkoutForm').action = '{{ route('checkout.vnpay') }}'"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-3 text-sm font-medium text-gray-900">Thanh toán qua VNPay</span>
                                </label>
                                @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-1">
                        <div class="bg-white shadow rounded-lg p-6 sticky top-8">
                            <h2 class="text-lg font-medium text-gray-900">Tóm tắt đơn hàng</h2>

                            <ul class="divide-y divide-gray-200 mt-4">
                                @foreach($checkoutCart as $id => $details)
<<<<<<< HEAD
                                <li class="py-4 flex">
                                    <img src="{{ Storage::url($details['image_url']) }}" alt="{{ $details['name'] }}" class="h-16 w-16 rounded-md object-cover">
                                    <li class="py-4 flex">
                                        <img src="{{ Storage::url($details['image_url']) }}" alt="{{ $details['name'] }}"
                                            class="h-16 w-16 rounded-md object-cover">
                                        <div class="ml-3 flex-1">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $details['name'] }}</h4>
                                            <p class="text-sm text-gray-500">SL: {{ $details['quantity'] }}</p>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }} đ
                                        </p>
                                    </li>
                                @endforeach
                            </ul>

                            <dl class="mt-6 space-y-4 border-t border-gray-200 pt-6">
                                <div class="flex items-center justify-between text-base font-medium text-gray-900">
                                    <dt>Tổng tiền</dt>
                                    <dd>{{ number_format($totalPrice, 0, ',', '.') }} đ</dd>
                                </div>

                                @if($checkoutVoucherDiscount > 0)
                                <div class="flex items-center justify-between text-sm text-green-600">
                                    <dt>Giảm giá</dt>
                                    <dd>-{{ number_format($checkoutVoucherDiscount, 0, ',', '.') }} đ</dd>
                                </div>
                                <div class="flex items-center justify-between text-base font-medium text-gray-900 border-t border-gray-200 pt-4">
                                    <dt>Thành tiền</dt>
                                    <dd>{{ number_format($finalTotal, 0, ',', '.') }} đ</dd>
                                </div>
                                @endif
                            </dl>
                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                    Đặt hàng
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        @else
            <div class="text-center py-12 bg-white shadow rounded-lg">
                <p class="text-xl text-gray-700">Không có sản phẩm nào để thanh toán.</p>
                <a href="{{ route('shop.index') }}"
                    class="mt-6 inline-block bg-indigo-600 text-white font-medium py-3 px-8 rounded-md shadow-md hover:bg-indigo-700">
                    Tiếp tục mua sắm
                </a>
            </div>
        @endif
        <div x-show="showAddressModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 "
            style="background-color: rgba(0, 0, 0, 0.50);" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" style="display: none;">

            {{-- Nội dung Modal --}}
            <div @click.away="showAddressModal = false" class="bg-white rounded-lg shadow-xl w-full max-w-md"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                <h3 class="text-lg font-medium text-gray-900 p-6 border-b">Thêm địa chỉ mới</h3>

                {{-- Form được xử lý bằng @submit.prevent của Alpine --}}
                <form @submit.prevent="addNewAddress">
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="address_line" class="block text-sm font-medium text-gray-700">Địa chỉ (Số nhà,
                                tên đường)</label>
                            <input x-model="newAddress.address_line" type="text" id="address_line"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required maxlength="255">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700">Quận /
                                    Huyện</label>
                                <input x-model="newAddress.district" type="text" id="district"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    required maxlength="100">
                            </div>
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">Tỉnh / Thành
                                    phố</label>
                                <input x-model="newAddress.city" type="text" id="city"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                    required maxlength="100">
                            </div>
                        </div>
                        <div>
                            <label for="phone_number_modal" class="block text-sm font-medium text-gray-700">Số điện
                                thoại</label>
                            <input x-model="newAddress.phone_number" type="tel" id="phone_number_modal"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required maxlength="15" {{-- Thêm maxlength --}} pattern="0[0-9]{9,10}"
                                title="Số điện thoại phải bắt đầu bằng 0 và có 10-11 chữ số">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3 bg-gray-50 p-4 rounded-b-lg">
                        <button type="button" @click="showAddressModal = false"
                            class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Hủy
                        </button>
                        <button type="submit"
                            class="rounded-md border border-transparent bg-indigo-600 text-white py-2 px-4 text-sm font-medium shadow-sm hover:bg-indigo-700">
                            Lưu địa chỉ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-main-layout>