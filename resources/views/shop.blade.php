<x-main-layout>

    <!-- Search Results Section -->
    @if(isset($query) && !empty($query))
    <div class="bg-gradient-to-br from-gray-50 to-white min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 transition">Trang chủ</a></li>
                    <li class="text-gray-400">/</li>
                    <li><a href="{{ route('shop.index') }}" class="text-gray-500 hover:text-indigo-600 transition">Sản phẩm</a></li>
                    <li class="text-gray-400">/</li>
                    <li class="text-gray-900 font-medium">Tìm kiếm</li>
                </ol>
            </nav>

            <div class="mb-6">
                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    Kết quả tìm kiếm: <span class="text-indigo-600">{{ $query }}</span>
                </h1>
                <p class="text-gray-600 text-lg">
                    Tìm thấy <span class="font-semibold text-indigo-600">{{ $products->total() }}</span> sản phẩm
                </p>
            </div>

            <!-- Category Filter Bar -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
                    @php
                        $allCategories = \App\Models\Category::whereNull('parent_id')->get();
                    @endphp
                    <a href="{{ route('shop.index') }}" 
                        class="flex items-center gap-2 px-5 py-3 rounded-lg font-semibold text-sm whitespace-nowrap transition-all duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span>Tất cả</span>
                    </a>
                    @foreach($allCategories as $cat)
                        <a href="{{ route('shop.index', ['category' => $cat->id]) }}" 
                            class="flex items-center gap-2 px-5 py-3 rounded-lg font-semibold text-sm whitespace-nowrap transition-all duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200">
                            @if($cat->name == 'Laptop' || str_contains(strtolower($cat->name), 'laptop'))
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @elseif($cat->name == 'PC' || str_contains(strtolower($cat->name), 'pc') || str_contains(strtolower($cat->name), 'máy tính'))
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                                </svg>
                            @elseif($cat->name == 'Màn hình' || str_contains(strtolower($cat->name), 'màn hình') || str_contains(strtolower($cat->name), 'monitor'))
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @elseif(str_contains(strtolower($cat->name), 'linh kiện') || str_contains(strtolower($cat->name), 'component'))
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                </svg>
                            @elseif(str_contains(strtolower($cat->name), 'máy in') || str_contains(strtolower($cat->name), 'printer'))
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            @endif
                            <span>{{ $cat->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            @if($products->count() > 0)
                <!-- Filters & Sort Bar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600 font-medium">Sắp xếp theo:</span>
                        <select class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option>Mới nhất</option>
                            <option>Giá tăng dần</option>
                            <option>Giá giảm dần</option>
                            <option>Bán chạy nhất</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span>Hiển thị: {{ $products->count() }} / {{ $products->total() }}</span>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @php
                        $cart = session('cart', []);
                    @endphp
                    @foreach($products as $product)
                        @php
                            $inCart = array_key_exists($product->id, $cart);
                        @endphp
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group product-card transform hover:-translate-y-1">
                            <a href="{{ route('products.show', ['category' => $product->category->slug ?? $product->category->id, 'product' => $product->slug ?? $product->id]) }}">
                                <div class="relative h-64 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                                    @if($product->images->isNotEmpty())
                                        <img src="{{ Storage::url($product->images->first()->image_url) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-gray-400">Chưa có ảnh</span>
                                        </div>
                                    @endif
                                    <!-- Badges -->
                                    <div class="absolute top-3 left-3 flex flex-col gap-2">
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">HOT</span>
                                        @if($product->stock_quantity > 0)
                                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">Còn hàng</span>
                                        @endif
                                    </div>
                                    <!-- Quick View Button -->
                                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="bg-white/90 backdrop-blur-sm hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </a>

                            <div class="p-5">
                                <div class="mb-2">
                                    <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">
                                        {{ $product->category->name ?? 'N/A' }}
                                    </span>
                                </div>
                                <a href="{{ route('products.show', ['category' => $product->category->slug ?? $product->category->id, 'product' => $product->slug ?? $product->id]) }}">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3.5rem]" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </h3>
                                </a>

                                <!-- Rating -->
                                <div class="flex items-center gap-1 mb-3">
                                    <div class="flex text-yellow-400">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-600">(128)</span>
                                </div>

                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-2xl font-bold text-indigo-600">
                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                    </p>
                                    </div>
                                </div>

                                <!-- Add to Cart Button -->
                                <div x-data="{ added: {{ $inCart ? 'true' : 'false' }}, loading: false }" class="relative">
                                    <button x-show="!added" 
                                        @click="loading = true; fetch('{{ route('cart.add') }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }, body: JSON.stringify({ product_id: {{ $product->id }}, quantity: 1 }) }).then(r => r.json()).then(data => { if(data.success) { added = true; loading = false; window.dispatchEvent(new CustomEvent('cart-updated', { detail: { cartCount: data.cartCount } })); } else { loading = false; alert(data.message || 'Có lỗi xảy ra'); } }).catch(err => { loading = false; alert('Có lỗi xảy ra'); console.error(err); });"
                                        :disabled="loading"
                                        x-transition
                                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg x-show="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path>
                                            </svg>
                                            <svg x-show="loading" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span x-text="loading ? 'Đang thêm...' : 'Thêm vào giỏ'"></span>
                                        </span>
                                    </button>
                                    <a x-show="added" x-transition href="{{ route('cart.index') }}"
                                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02] flex items-center justify-center gap-2"
                                        style="display: none;">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                        </svg>
                                        Đã thêm - Xem giỏ
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Không tìm thấy sản phẩm</h3>
                    <p class="text-gray-600 mb-6">
                        Không có sản phẩm nào khớp với từ khóa "<span class="font-semibold text-indigo-600">{{ $query }}</span>"
                    </p>
                    <a href="{{ route('shop.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition shadow-md hover:shadow-lg">
                        Xem tất cả sản phẩm
                    </a>
                </div>
            @endif
        </div>
    </div>

    @elseif(isset($category) && $category)
        <!-- Category Filter View -->
        <div class="bg-gradient-to-br from-gray-50 to-white min-h-screen">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Breadcrumb -->
                <nav class="mb-6" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 transition">Trang chủ</a></li>
                        <li class="text-gray-400">/</li>
                        <li><a href="{{ route('shop.index') }}" class="text-gray-500 hover:text-indigo-600 transition">Sản phẩm</a></li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-900 font-medium">{{ $category->name }}</li>
                    </ol>
                </nav>

                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-gray-900 mb-3">
                        Danh mục: <span class="text-indigo-600">{{ $category->name }}</span>
                    </h1>
                    <p class="text-gray-600 text-lg">
                        Tìm thấy <span class="font-semibold text-indigo-600">{{ $products->total() }}</span> sản phẩm
                    </p>
                </div>

                <!-- Category Filter Bar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
                    <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
                        @php
                            $allCategories = \App\Models\Category::whereNull('parent_id')->get();
                            $currentCategoryId = $category->id;
                        @endphp
                        <a href="{{ route('shop.index') }}" 
                            class="flex items-center gap-2 px-5 py-3 rounded-lg font-semibold text-sm whitespace-nowrap transition-all duration-200 bg-gray-100 text-gray-700 hover:bg-gray-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span>Tất cả</span>
                        </a>
                        @foreach($allCategories as $cat)
                            <a href="{{ route('shop.index', ['category' => $cat->id]) }}" 
                                class="flex items-center gap-2 px-5 py-3 rounded-lg font-semibold text-sm whitespace-nowrap transition-all duration-200 {{ $currentCategoryId == $cat->id ? 'bg-red-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                @if($cat->name == 'Laptop' || str_contains(strtolower($cat->name), 'laptop'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                @elseif($cat->name == 'PC' || str_contains(strtolower($cat->name), 'pc') || str_contains(strtolower($cat->name), 'máy tính'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                                    </svg>
                                @elseif($cat->name == 'Màn hình' || str_contains(strtolower($cat->name), 'màn hình') || str_contains(strtolower($cat->name), 'monitor'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                @elseif(str_contains(strtolower($cat->name), 'linh kiện') || str_contains(strtolower($cat->name), 'component'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                    </svg>
                                @elseif(str_contains(strtolower($cat->name), 'máy in') || str_contains(strtolower($cat->name), 'printer'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                @endif
                                <span>{{ $cat->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                @if($products->count() > 0)
                    <!-- Filters & Sort Bar -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600 font-medium">Sắp xếp theo:</span>
                            <select class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option>Mới nhất</option>
                                <option>Giá tăng dần</option>
                                <option>Giá giảm dần</option>
                                <option>Bán chạy nhất</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <span>Hiển thị: {{ $products->count() }} / {{ $products->total() }}</span>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                        @php
                            $cart = session('cart', []);
                        @endphp
                        @foreach($products as $product)
                            @php
                                $inCart = array_key_exists($product->id, $cart);
                            @endphp
                            <div class="bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group product-card transform hover:-translate-y-1">
                                <a href="{{ route('products.show', ['category' => $product->category->slug ?? $product->category->id, 'product' => $product->slug ?? $product->id]) }}">
                                    <div class="relative h-64 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                                        @if($product->images->isNotEmpty())
                                            <img src="{{ Storage::url($product->images->first()->image_url) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-gray-400">Chưa có ảnh</span>
                                            </div>
                                        @endif
                                        <!-- Badges -->
                                        <div class="absolute top-3 left-3 flex flex-col gap-2">
                                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">HOT</span>
                                            @if($product->stock_quantity > 0)
                                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">Còn hàng</span>
                                            @endif
                                        </div>
                                        <!-- Quick View Button -->
                                        <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button class="bg-white/90 backdrop-blur-sm hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all hover:scale-110">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </button>
                                        </div>
                                    </div>
                                </a>

                                <div class="p-5">
                                    <div class="mb-2">
                                        <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">
                                            {{ $product->category->name ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <a href="{{ route('products.show', ['category' => $product->category->slug ?? $product->category->id, 'product' => $product->slug ?? $product->id]) }}">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3.5rem]" title="{{ $product->name }}">
                                            {{ $product->name }}
                                        </h3>
                                    </a>

                                    <!-- Rating -->
                                    <div class="flex items-center gap-1 mb-3">
                                        <div class="flex text-yellow-400">
                                            @for($i = 0; $i < 5; $i++)
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-600">(128)</span>
                                    </div>

                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <p class="text-2xl font-bold text-indigo-600">
                                                {{ number_format($product->price, 0, ',', '.') }} đ
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Add to Cart Button -->
                                    <div x-data="{ added: {{ $inCart ? 'true' : 'false' }}, loading: false }" class="relative">
                                        <button x-show="!added" 
                                            @click="loading = true; fetch('{{ route('cart.add') }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }, body: JSON.stringify({ product_id: {{ $product->id }}, quantity: 1 }) }).then(r => r.json()).then(data => { if(data.success) { added = true; loading = false; window.dispatchEvent(new CustomEvent('cart-updated', { detail: { cartCount: data.cartCount } })); } else { loading = false; alert(data.message || 'Có lỗi xảy ra'); } }).catch(err => { loading = false; alert('Có lỗi xảy ra'); console.error(err); });"
                                            :disabled="loading"
                                            x-transition
                                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg x-show="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path>
                                                </svg>
                                                <svg x-show="loading" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                <span x-text="loading ? 'Đang thêm...' : 'Thêm vào giỏ'"></span>
                                            </span>
                                        </button>
                                        <a x-show="added" x-transition href="{{ route('cart.index') }}"
                                            class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02] flex items-center justify-center gap-2"
                                            style="display: none;">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                            </svg>
                                            Đã thêm - Xem giỏ
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        {{ $products->links() }}
                        </div>
                @else
                    <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Không có sản phẩm</h3>
                        <p class="text-gray-600 mb-6">
                            Danh mục "<span class="font-semibold text-indigo-600">{{ $category->name }}</span>" chưa có sản phẩm
                        </p>
                        <a href="{{ route('shop.index') }}"
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition shadow-md hover:shadow-lg">
                            Xem tất cả sản phẩm
                        </a>
                </div>
                @endif
        </div>
    </div>

    @else
        <!-- Normal Shop View -->
        <div class="bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Breadcrumb -->
                <nav class="mb-6" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 transition">Trang chủ</a></li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-900 font-medium">Sản phẩm</li>
                    </ol>
                </nav>

                <!-- Category Filter Bar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-8">
                    <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
                        @php
                            $allCategories = \App\Models\Category::whereNull('parent_id')->get();
                            $currentCategoryId = request('category');
                        @endphp
                        <a href="{{ route('shop.index') }}" 
                            class="flex items-center gap-2 px-5 py-3 rounded-lg font-semibold text-sm whitespace-nowrap transition-all duration-200 {{ !$currentCategoryId ? 'bg-red-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span>Tất cả</span>
                        </a>
                        @foreach($allCategories as $cat)
                            <a href="{{ route('shop.index', ['category' => $cat->id]) }}" 
                                class="flex items-center gap-2 px-5 py-3 rounded-lg font-semibold text-sm whitespace-nowrap transition-all duration-200 {{ $currentCategoryId == $cat->id ? 'bg-red-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                @if($cat->name == 'Laptop' || str_contains(strtolower($cat->name), 'laptop'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                @elseif($cat->name == 'PC' || str_contains(strtolower($cat->name), 'pc') || str_contains(strtolower($cat->name), 'máy tính'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                                    </svg>
                                @elseif($cat->name == 'Màn hình' || str_contains(strtolower($cat->name), 'màn hình') || str_contains(strtolower($cat->name), 'monitor'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                @elseif(str_contains(strtolower($cat->name), 'linh kiện') || str_contains(strtolower($cat->name), 'component'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                    </svg>
                                @elseif(str_contains(strtolower($cat->name), 'máy in') || str_contains(strtolower($cat->name), 'printer'))
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                @endif
                                <span>{{ $cat->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Featured Products Section -->
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-4xl font-bold text-gray-900 mb-2">Sản phẩm nổi bật</h2>
                            <p class="text-gray-600">Những sản phẩm được yêu thích nhất</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @php
                            $cart = session('cart', []);
                        @endphp

                        @forelse($featuredProducts as $product)
                            @php
                                $inCart = array_key_exists($product->id, $cart);
                            @endphp

                            <div class="bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group product-card transform hover:-translate-y-1"
                                data-product-id="{{ $product->id }}">

                                @php
                                    $productUrl = '#';
                                    if ($product->category && $product->category->slug) {
                                        $productUrl = route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]);
                                    }
                                @endphp

                                <a href="{{ $productUrl }}" class="block">
                                    <div class="relative h-64 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                                        @if($product->images->first())
                                                    <img src="{{ Storage::url($product->images->first()->image_url) }}"
                                                        alt="{{ $product->name }}"
                                                class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-110">
                                                @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                <span class="text-gray-400">Chưa có ảnh</span>
                                            </div>
                                        @endif
                                        <!-- Badges -->
                                        <div class="absolute top-3 left-3 flex flex-col gap-2">
                                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">HOT</span>
                                            @if($product->stock_quantity > 0)
                                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">Còn hàng</span>
                                            @endif
                                        </div>
                                        <!-- Quick View Button -->
                                        <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button class="bg-white/90 backdrop-blur-sm hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all hover:scale-110">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </a>

                                <div class="p-5">
                                    <div class="mb-2">
                                        <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">
                                            {{ $product->category->name ?? 'Chưa phân loại' }}
                                        </span>
                                    </div>

                                    <a href="{{ $productUrl }}">
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3.5rem]">
                                                    {{ $product->name }}
                                                </h3>
                                    </a>

                                    @if($product->specifications && isset($product->specifications['RAM']))
                                        <p class="text-xs text-gray-600 mb-2">{{ $product->specifications['RAM'] }}</p>
                                    @endif

                                    <!-- Rating -->
                                    <div class="flex items-center gap-1 mb-3">
                                        <div class="flex text-yellow-400">
                                            @for($i = 0; $i < 5; $i++)
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="text-xs text-gray-600">4.8 (128)</span>
                                    </div>

                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <p class="text-2xl font-bold text-indigo-600">
                                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                                </p>
                                            </div>
                                    </div>

                                    @if($product->stock_quantity > 0)
                                        <p class="text-xs text-green-600 mb-3 font-semibold">✓ Còn hàng</p>
                                    @else
                                        <p class="text-xs text-red-600 mb-3 font-semibold">✗ Hết hàng</p>
                                    @endif

                                    <!-- Add to Cart Button -->
                                    <div x-data="{ added: {{ $inCart ? 'true' : 'false' }}, loading: false }" class="relative">
                                        <button x-show="!added" 
                                            @click="loading = true; fetch('{{ route('cart.add') }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }, body: JSON.stringify({ product_id: {{ $product->id }}, quantity: 1 }) }).then(r => r.json()).then(data => { if(data.success) { added = true; loading = false; window.dispatchEvent(new CustomEvent('cart-updated', { detail: { cartCount: data.cartCount } })); } else { loading = false; alert(data.message || 'Có lỗi xảy ra'); } }).catch(err => { loading = false; alert('Có lỗi xảy ra'); console.error(err); });"
                                            :disabled="loading"
                                            x-transition
                                            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg x-show="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path>
                                                </svg>
                                                <svg x-show="loading" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                <span x-text="loading ? 'Đang thêm...' : 'Thêm vào giỏ'"></span>
                                            </span>
                                        </button>
                                        <a x-show="added" x-transition href="{{ route('cart.index') }}"
                                            class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02] flex items-center justify-center gap-2"
                                            style="display: none;">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                            </svg>
                                            Đã thêm - Xem giỏ
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="text-gray-500">Chưa có sản phẩm nào</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="bg-white border-t border-gray-200">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    @foreach ($categoriesWithProducts as $category)
                        @if ($category->products->isNotEmpty())
                            <section class="mb-16 last:mb-0">
                                <div class="flex justify-between items-center mb-8">
                                    <div>
                                        <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h2>
                                        <p class="text-gray-600">Khám phá các sản phẩm {{ strtolower($category->name) }} tốt nhất</p>
                                    </div>
                                    <a href="{{ route('shop.index', ['category' => $category->id]) }}" class="text-indigo-600 hover:text-indigo-700 font-semibold flex items-center gap-2 transition">
                                        Xem tất cả
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                    @foreach ($category->products as $product)
                                        @php
                                            $inCart = array_key_exists($product->id, $cart);
                                        @endphp
                                        
                                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 group transform hover:-translate-y-1">
                                            @php
                                                $productUrl = '#';
                                                if ($product->category && $product->category->slug) {
                                                    $productUrl = route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]);
                                                }
                                            @endphp

                                            <a href="{{ $productUrl }}" class="block">
                                                <div class="relative h-64 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                                                    @if($product->images->first())
                                                        <img src="{{ Storage::url($product->images->first()->image_url) }}"
                                                            alt="{{ $product->name }}"
                                                            class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-110">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                            <span class="text-gray-400">Chưa có ảnh</span>
                                                        </div>
                                                    @endif
                                                    <!-- Badges -->
                                                    <div class="absolute top-3 left-3 flex flex-col gap-2">
                                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">HOT</span>
                                                        @if($product->stock_quantity > 0)
                                                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">Còn hàng</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>

                                            <div class="p-5">
                                                <div class="mb-2">
                                                    <span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">
                                                        {{ $category->name }}
                                                    </span>
                                                </div>
                                                
                                                <a href="{{ $productUrl }}">
                                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3.5rem]">
                                                        {{ $product->name }}
                                                    </h3>
                                                </a>

                                                <!-- Rating -->
                                                <div class="flex items-center gap-1 mb-3">
                                                    <div class="flex text-yellow-400">
                                                        @for($i = 0; $i < 5; $i++)
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                    <span class="text-xs text-gray-600">4.8 (128)</span>
                                                </div>

                                                <div class="flex items-center justify-between mb-4">
                                                    <p class="text-2xl font-bold text-indigo-600">
                                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                                    </p>
                                                </div>

                                                @if($product->stock_quantity > 0)
                                                    <p class="text-xs text-green-600 mb-3 font-semibold">✓ Còn hàng</p>
                                                @else
                                                    <p class="text-xs text-red-600 mb-3 font-semibold">✗ Hết hàng</p>
                                                @endif
                                                
                                                <!-- Add to Cart Button -->
                                                <div x-data="{ added: {{ $inCart ? 'true' : 'false' }}, loading: false }" class="relative">
                                                    <button x-show="!added" 
                                                        @click="loading = true; fetch('{{ route('cart.add') }}', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }, body: JSON.stringify({ product_id: {{ $product->id }}, quantity: 1 }) }).then(r => r.json()).then(data => { if(data.success) { added = true; loading = false; window.dispatchEvent(new CustomEvent('cart-updated', { detail: { cartCount: data.cartCount } })); } else { loading = false; alert(data.message || 'Có lỗi xảy ra'); } }).catch(err => { loading = false; alert('Có lỗi xảy ra'); console.error(err); });"
                                                        :disabled="loading"
                                                        x-transition
                                                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed">
                                                        <span class="flex items-center justify-center gap-2">
                                                            <svg x-show="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"></path>
                                                            </svg>
                                                            <svg x-show="loading" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                            </svg>
                                                            <span x-text="loading ? 'Đang thêm...' : 'Thêm vào giỏ'"></span>
                                                        </span>
                                                    </button>
                                                    <a x-show="added" x-transition href="{{ route('cart.index') }}"
                                                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:scale-[1.02] flex items-center justify-center gap-2"
                                                        style="display: none;">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                                        </svg>
                                                        Đã thêm - Xem giỏ
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                        </div>
                    </section>
                @endif
            @endforeach
                </div>
            </div>
        </div>
    @endif

</x-main-layout>
