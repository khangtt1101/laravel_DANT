<x-main-layout>

    <!-- Search Results Section -->
    @if(isset($query) && !empty($query))
        <div class="bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Kết quả tìm kiếm cho: "<span class="text-indigo-600">{{ $query }}</span>"
                    </h2>
                    <p class="text-gray-600">
                        Tìm thấy <span class="font-semibold">{{ $products->total() }}</span> sản phẩm
                    </p>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                        @foreach($products as $product)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl group">
                                <a href="{{ route('products.show', ['category' => $product->category->slug ?? $product->category->id, 'product' => $product->slug ?? $product->id]) }}">
                                    <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                                        @if($product->images->isNotEmpty())
                                            <img src="{{ Storage::url($product->images->first()->image_url) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full object-cover transition duration-300 ease-in-out group-hover:scale-105">
                                        @else
                                            <span class="text-gray-500">(Không có ảnh)</span>
                                        @endif
                                    </div>
                                </a>

                                <div class="p-6">
                                    <a href="{{ route('products.show', ['category' => $product->category->slug ?? $product->category->id, 'product' => $product->slug ?? $product->id]) }}">
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

                                        <div x-data="{ added: {{ $inCart ? 'true' : 'false' }} }" class="relative w-10 h-10">
                                            <div x-show="!added" x-transition class="absolute inset-0">
                                                <form action="{{ route('cart.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" @click="added = true"
                                                        class="w-10 h-10 p-2 bg-indigo-600 text-white rounded-full shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150"
                                                        aria-label="Thêm vào giỏ hàng">
                                                        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 4.5v15m7.5-7.5h-15" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>

                                            <div x-show="added" x-transition class="absolute inset-0" style="display: none;">
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
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Không tìm thấy sản phẩm</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Không có sản phẩm nào khớp với từ khóa "<span class="font-semibold">{{ $query }}</span>"
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('shop.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Xem tất cả sản phẩm
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @else
    <!-- Normal Shop View -->
    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Sản phẩm nổi bật</h2>

            <div class="overflow-x-auto pb-4">
                <div class="grid grid-flow-col auto-cols-[18rem] gap-8">

                    @forelse ($featuredProducts as $product)
                        {{--
                        BƯỚC 1: Kiểm tra xem sản phẩm đã có trong session 'cart' chưa.
                        --}}
                        @php
                            $inCart = session('cart', []) && array_key_exists($product->id, session('cart', []));
                        @endphp

                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl group">

                            <a
                                href="{{ route('products.show', ['category' => $product->category, 'product' => $product]) }}">
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

                                    {{--
                                    BƯỚC 2: Khởi tạo Alpine.js
                                    x-data="{ added: {{ $inCart ? 'true' : 'false' }} }"
                                    --}}
                                    <div x-data="{ added: {{ $inCart ? 'true' : 'false' }} }" class="relative w-10 h-10">

                                        {{--
                                        BƯỚC 3: Nút "Thêm vào giỏ" (Chỉ hiển thị khi added = false)
                                        --}}
                                        <div x-show="!added" x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-90" class="absolute inset-0">
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">

                                                <button type="submit" {{-- BƯỚC 4: Khi click, đổi 'added'=true, sau đó form
                                                    submit --}} @click="added = true"
                                                    class="w-10 h-10 p-2 bg-indigo-600 text-white rounded-full shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150"
                                                    aria-label="Thêm vào giỏ hàng">
                                                    <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        {{--
                                        BƯỚC 5: Nút "Xem giỏ hàng" (Chỉ hiển thị khi added = true)
                                        --}}
                                        <div x-show="added" x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-90" class="absolute inset-0"
                                            style="display: none;"> {{-- Thêm style để tránh FOUC --}}
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
    </div>

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">

            @foreach ($categoriesWithProducts as $category)
                @if ($category->products->isNotEmpty())
                    <section>
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h2>
                            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Xem tất cả &rarr;
                            </a>
                        </div>

                        <div class="overflow-x-auto pb-4">
                            <div class="grid grid-flow-col auto-cols-[18rem] gap-8">
                                @foreach ($category->products as $product)
                                    <div
                                        class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl">
                                        <a href="#" class="group">
                                            <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                                                @if (!$product->images->isEmpty())
                                                    <img src="{{ Storage::url($product->images->first()->image_url) }}"
                                                        alt="{{ $product->name }}"
                                                        class="w-full h-full object-cover transition duration-300 ease-in-out group-hover:scale-105">
                                                @else
                                                    <span class="text-gray-500">(Không có ảnh)</span>
                                                @endif
                                            </div>
                                            <div class="p-6">
                                                <h3 class="text-lg font-semibold text-gray-900 truncate"
                                                    title="{{ $product->name }}">
                                                    {{ $product->name }}
                                                </h3>
                                                <p class="mt-2 text-gray-500 text-sm">
                                                    {{ $category->name }}
                                                </p>
                                                <p class="mt-4 text-xl font-bold text-indigo-600">
                                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach

        </div>
    </div>
    @endif

</x-main-layout>