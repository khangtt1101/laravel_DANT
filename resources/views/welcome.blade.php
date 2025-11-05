<x-main-layout>
    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 text-center">
            <h1 class="text-4xl md:text-6xl font-sans text-gray-900 leading-tight">
                Sản phẩm <span class="text-indigo-600">Công nghệ</span>
                <br>
                Dẫn đầu Xu hướng
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-500">
                Khám phá bộ sưu tập điện thoại, laptop, và phụ kiện mới nhất với giá ưu đãi nhất.
            </p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="{{ route('shop.index') }}"
                    class="inline-block bg-indigo-600 text-white font-medium py-3 px-8 rounded-md shadow-md hover:bg-indigo-700">
                    Mua ngay
                </a>
                <a href="#"
                    class="inline-block bg-gray-200 text-gray-700 font-medium py-3 px-8 rounded-md hover:bg-gray-300">
                    Tìm hiểu thêm
                </a>
            </div>
        </div>
    </div>

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Sản phẩm nổi bật</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @php
                    $cart = session('cart', []);
                @endphp

                @forelse ($featuredProducts as $product)
                    @php
                        $inCart = array_key_exists($product->id, $cart);
                    @endphp

                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl group">

                        <a href="{{ route('products.show', ['category' => $product->category, 'product' => $product]) }}">
                            <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                                @if (!$product->images->isEmpty())
                                    <img src="{{ Storage::url($product->images->first()->image_url) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition duration-300 ease-in-out group-hover:scale-105">
                                @else
                                    <span class="text-gray-500">(Không có ảnh)</span>
                                @endif
                            </div>
                        </a>

                        <div class="p-6">
                            <a
                                href="{{ route('products.show', ['category' => $product->category, 'product' => $product]) }}">
                                <h3 class="text-lg font-semibold text-gray-900 truncate" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            <p class="mt-2 text-gray-500 text-sm">
                                {{ $product->category->name ?? 'N/A' }}
                            </p>

                            <div class="mt-4 flex items-center justify-between">
                                <p class="text-xl font-bold text-indigo-600">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </p>

                                <div x-data="{ 
                                                    added: {{ $inCart ? 'true' : 'false' }},

                                                    // Định nghĩa hàm addToCart
                                                    addToCart(productId) {
                                                        this.added = true; // 1. Cập nhật UI ngay lập tức

                                                        // 2. Gửi request AJAX
                                                        fetch('/cart/add', {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json',
                                                                'X-Requested-With': 'XMLHttpRequest',
                                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                            },
                                                            body: JSON.stringify({
                                                                product_id: productId,
                                                                quantity: 1
                                                            })
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            if (data.success) {
                                                                // 3. Phát sự kiện toàn cục với số lượng giỏ hàng mới
                                                                window.dispatchEvent(new CustomEvent('cart-updated', {
                                                                    detail: { cartCount: data.cartCount }
                                                                }));
                                                            } else {
                                                                // 4. Nếu lỗi, trả lại nút
                                                                this.added = false; 
                                                                alert(data.message || 'Đã xảy ra lỗi.');
                                                            }
                                                        })
                                                        .catch(error => { // <-- Nhận 'error' để log
                                    // IN LỖI RA CONSOLE
                                    console.error('Lỗi khi thêm vào giỏ:', error); 

                                    this.added = false;
                                    // Hiển thị lỗi cụ thể hơn
                                    alert(error.message || 'Lỗi kết nối, vui lòng thử lại.');
                                });
                                                    }
                                                }" class="relative w-10 h-10">

                                    <div x-show="!added" x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-90" class="absolute inset-0">

                                        <button type="button" {{-- <-- Sửa lỗi: type="button" --}}
                                            @click="addToCart({{ $product->id }})"
                                            class="w-10 h-10 p-2 bg-indigo-600 text-white rounded-full shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150"
                                            aria-label="Thêm vào giỏ hàng">
                                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div x-show="added" x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-90" class="absolute inset-0"
                                        style="display: none;">
                                        <a href="{{ route('cart.index') }}"
                                            class="w-10 h-10 p-2 flex items-center justify-center bg-green-500 text-white rounded-full shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150"
                                            aria-label="Xem giỏ hàng">
                                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-span-4 text-gray-500">Chưa có sản phẩm nổi bật nào.</p>
                @endforelse

            </div>
        </div>
    </div>

</x-main-layout>