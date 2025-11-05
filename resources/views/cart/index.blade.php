<x-main-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
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

        @if(isset($cart) && count($cart) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2">
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($cart as $id => $details)
                                <li class="p-4 sm:p-6 flex">
                                    <div
                                        class="flex-shrink-0 w-24 h-24 sm:w-32 sm:h-32 border border-gray-200 rounded-md overflow-hidden">
                                        @if($details['image_url'])
                                            <img src="{{ Storage::url($details['image_url']) }}" alt="{{ $details['name'] }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                                (Không ảnh)</div>
                                        @endif
                                    </div>

                                    <div class="ml-4 flex-1 flex flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>{{ $details['name'] }}</h3>
                                                <p class="ml-4">
                                                    {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }} đ
                                                </p>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ number_format($details['price'], 0, ',', '.') }} đ / cái
                                            </p>
                                        </div>
                                        <div class="flex-1 flex items-end justify-between text-sm">

                                            <form action="{{ route('cart.update', $id) }}" method="POST"
                                                class="flex items-center" {{-- 1. Khởi tạo Alpine component với state 'quantity'
                                                --}} x-data="{ quantity: {{ $details['quantity'] }} }" {{-- 2. Đặt tên (ref) cho
                                                form này là 'form' --}} x-ref="form" {{-- 3. Tự động submit form BẤT CỨ KHI NÀO
                                                state 'quantity' thay đổi --}}
                                                x-init="$watch('quantity', () => $refs.form.submit())">
                                                @csrf
                                                <label for="quantity-{{ $id }}" class="mr-2 text-gray-500">Số lượng:</label>

                                                {{-- 4. Bọc các nút và input trong một div cho đẹp --}}
                                                <div class="flex items-center border border-gray-300 rounded-md shadow-sm">

                                                    <button type="button" {{-- Giảm số lượng, không cho phép thấp hơn 1 --}}
                                                        @click="quantity = Math.max(1, quantity - 1)"
                                                        class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-l-md focus:outline-none">
                                                        -
                                                    </button>

                                                    <input type="number" name="quantity" id="quantity-{{ $id }}" min="1" {{-- 5.
                                                        Binding giá trị input với state 'quantity' --}} x-model="quantity" {{--
                                                        6. Chỉ đọc, không cho người dùng gõ số vào --}} readonly
                                                        class="w-10 text-right border-y-0 border-x border-gray-300 focus:ring-0 p-0 py-1 sm:text-sm">

                                                    <button type="button" {{-- Tăng số lượng --}} @click="quantity++"
                                                        class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded-r-md focus:outline-none">
                                                        +
                                                    </button>
                                                </div>
                                            </form>
                                
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="font-medium text-red-600 hover:text-red-800">Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-lg font-medium text-gray-900">Tóm tắt đơn hàng</h2>
                        <dl class="mt-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <dt class="text-sm text-gray-600">Tổng cộng</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ number_format($totalPrice, 0, ',', '.') }}
                                    đ</dd>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                <dt class="text-base font-medium text-gray-900">Tổng tiền</dt>
                                <dd class="text-base font-medium text-gray-900">
                                    {{ number_format($totalPrice, 0, ',', '.') }} đ
                                </dd>
                            </div>
                        </dl>
                        <div class="mt-6">
                            <a href="#"
                                class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                Tiến hành thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        @else
            <div class="text-center py-12 bg-white shadow rounded-lg">
                <p class="text-xl text-gray-700">Giỏ hàng của bạn đang trống.</p>
                <a href="{{ route('shop.index') }}"
                    class="mt-6 inline-block bg-indigo-600 text-white font-medium py-3 px-8 rounded-md shadow-md hover:bg-indigo-700">
                    Tiếp tục mua sắm
                </a>
            </div>
        @endif
    </div>
</x-main-layout>