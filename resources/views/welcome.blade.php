<x-main-layout>
    @php
        $globalRating = 5.0;
        $globalReviewCount = 0;
        if (isset($featuredProducts) && $featuredProducts->count()) {
            $averageRating = $featuredProducts->avg(function ($product) {
                return $product->reviews_avg_rating;
            });
            if ($averageRating) {
                $globalRating = round($averageRating, 1);
            }
            $globalReviewCount = $featuredProducts->sum('reviews_count');
        }
    @endphp
    <!-- Hero Banner Slider - Carousel với ảnh đẹp -->
    <section class="relative overflow-hidden">
        <div class="hero-slider relative h-[500px] md:h-[650px]">
            <!-- Slide 1 - Technology Products -->
            <div class="slide absolute inset-0 flex items-center transition-all duration-700 ease-in-out opacity-100">
                <!-- Background Image với Overlay -->
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                    style="background-image: url('https://images.unsplash.com/photo-1498049794561-7780e7231661?w=1920&q=80');">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-blue-800/70 to-transparent">
                    </div>
                </div>

                <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="text-white animate-fade-in">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 drop-shadow-lg">
                                Cửa hàng
                                <span class="text-yellow-300">Điện tử</span>
                                <br>
                                Chất lượng cao
            </h1>
                            <p class="text-lg md:text-xl mb-8 text-white/90 leading-relaxed drop-shadow-md">
                                Chuyên cung cấp các sản phẩm công nghệ chính hãng với giá cả hợp lý và dịch vụ uy tín
                                nhất.
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <a href="#products"
                                    class="inline-flex items-center gap-2 bg-indigo-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-indigo-700 transition hover:shadow-xl hover:scale-105 scroll-smooth">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Xem sản phẩm
                                </a>
                                <a href="#categories"
                                    class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white font-semibold py-3 px-8 rounded-lg border-2 border-white/30 hover:bg-white/30 hover:border-white transition scroll-smooth">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                    Danh mục
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl border border-white/20">
                                <div class="text-center">
                                    <div
                                        class="w-24 h-24 mx-auto mb-6 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-2 border-white/30">
                                        <svg class="w-12 h-12 text-yellow-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 mt-6">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-white">1000+</div>
                                            <div class="text-sm text-white/80">Sản phẩm</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-white">5000+</div>
                                            <div class="text-sm text-white/80">Khách hàng</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-yellow-300">{{ number_format($globalRating, 1) }}★</div>
                                            <div class="text-sm text-white/80">
                                                @if($globalReviewCount > 0)
                                                    {{ $globalReviewCount }}+ đánh giá
                                                @else
                                                    Đang được yêu thích
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 - Sale/Discount -->
            <div class="slide absolute inset-0 flex items-center transition-all duration-700 ease-in-out opacity-0">
                <!-- Background Image với Overlay -->
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                    style="background-image: url('https://images.unsplash.com/photo-1607082349566-187342175e2f?w=1920&q=80');">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-900/85 via-orange-800/75 to-red-700/65">
                    </div>
                </div>

                <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="text-white">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 drop-shadow-lg">
                                Giảm giá
                                <span class="text-yellow-300">Sốc</span>
                                <br>
                                Lên đến <span class="text-yellow-300">50%</span>
                            </h1>
                            <p class="text-lg md:text-xl mb-8 text-white/90 leading-relaxed drop-shadow-md">
                                Khuyến mãi đặc biệt trong tháng này. Mua ngay để nhận ưu đãi tốt nhất!
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <a href="#hot-deals"
                                    class="inline-flex items-center gap-2 bg-red-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-red-700 transition hover:shadow-xl hover:scale-105 scroll-smooth">
                                    Xem Deal sốc
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl border border-white/20">
                                <div class="text-center">
                                    <div class="text-7xl mb-4">🎉</div>
                                    <div class="text-4xl font-bold text-yellow-300 mb-2 drop-shadow-lg">-50%</div>
                                    <div class="text-sm text-white/90">Cho tất cả sản phẩm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 - New Products -->
            <div class="slide absolute inset-0 flex items-center transition-all duration-700 ease-in-out opacity-0">
                <!-- Background Image với Overlay -->
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                    style="background-image: url('https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=1920&q=80');">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-900/80 via-emerald-800/70 to-green-700/60">
                    </div>
                </div>

                <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div class="text-white">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 drop-shadow-lg">
                                Sản phẩm
                                <span class="text-yellow-300">Mới</span>
                                <br>
                                Đã về hàng
                            </h1>
                            <p class="text-lg md:text-xl mb-8 text-white/90 leading-relaxed drop-shadow-md">
                                Cập nhật những sản phẩm công nghệ mới nhất, hot nhất trên thị trường.
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <a href="#new-products"
                                    class="inline-flex items-center gap-2 bg-green-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-green-700 transition hover:shadow-xl hover:scale-105 scroll-smooth">
                                    Xem sản phẩm mới
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl border border-white/20">
                                <div class="text-center">
                                    <div class="text-7xl mb-4">🆕</div>
                                    <div class="text-2xl font-bold text-yellow-300 mb-2 drop-shadow-lg">Hàng mới</div>
                                    <div class="text-sm text-white/90">Mỗi ngày</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Controls -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
            <button
                class="slider-dot w-3 h-3 rounded-full bg-white shadow-lg transition-all duration-300 hover:scale-125"
                data-slide="0"></button>
            <button
                class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 shadow-lg transition-all duration-300 hover:scale-125"
                data-slide="1"></button>
            <button
                class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 shadow-lg transition-all duration-300 hover:scale-125"
                data-slide="2"></button>
        </div>
        <!-- Prev/Next Buttons -->
        <button
            class="slider-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white backdrop-blur-sm text-gray-800 p-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-110 z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button
            class="slider-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white backdrop-blur-sm text-gray-800 p-3 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-110 z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </section>

    <!-- Promotional Banner Section -->
    <section class="bg-gradient-to-r from-red-600 to-orange-600 text-white py-4">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                    <span class="font-bold text-lg">KHUYẾN MÃI ĐẶC BIỆT</span>
                </div>
                <span class="hidden md:inline">|</span>
                <span class="text-sm md:text-base">Giảm giá lên đến 50% cho tất cả sản phẩm</span>
                <a href="#hot-deals"
                    class="ml-auto bg-white text-red-600 font-semibold px-4 py-1 rounded hover:bg-gray-100 transition text-sm">
                    Mua ngay →
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="bg-white py-8 border-b">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">{{ $featuredProducts->count() }}+</div>
                    <div class="text-sm text-gray-600">Sản phẩm nổi bật</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">{{ $categories->count() }}+</div>
                    <div class="text-sm text-gray-600">Danh mục</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">24/7</div>
                    <div class="text-sm text-gray-600">Hỗ trợ khách hàng</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-indigo-600 mb-2">100%</div>
                    <div class="text-sm text-gray-600">Chính hãng</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Filter Section - Slider chạy ngang -->
    <section class="bg-white py-6 border-b">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">ĐỒ GIA DỤNG</h2>
                <a href="{{ route('shop.index') }}"
                    class="text-indigo-600 hover:text-indigo-700 font-semibold flex items-center gap-1">
                    Xem tất cả <span>→</span>
                </a>
            </div>
            <!-- Brand Slider Container -->
            <div class="relative overflow-hidden">
                <div class="brand-slider-container flex items-center gap-3 whitespace-nowrap">
                    <!-- First set of brands -->
                    <div class="brand-slider-content flex items-center gap-3">
                        @foreach($popularBrands as $brand)
                            <button
                                class="px-6 py-2.5 bg-gray-100 hover:bg-indigo-600 hover:text-white text-gray-700 rounded-lg transition-all duration-300 font-medium text-sm whitespace-nowrap flex-shrink-0 shadow-sm hover:shadow-md">
                                {{ $brand }}
                            </button>
                        @endforeach
                    </div>
                    <!-- Duplicate for seamless loop -->
                    <div class="brand-slider-content flex items-center gap-3" aria-hidden="true">
                        @foreach($popularBrands as $brand)
                            <button
                                class="px-6 py-2.5 bg-gray-100 hover:bg-indigo-600 hover:text-white text-gray-700 rounded-lg transition-all duration-300 font-medium text-sm whitespace-nowrap flex-shrink-0 shadow-sm hover:shadow-md">
                                {{ $brand }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <!-- Gradient overlays for smooth fade effect -->
                <div
                    class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-white to-transparent pointer-events-none z-10">
                </div>
                <div
                    class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-white to-transparent pointer-events-none z-10">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section - Gọn gàng hơn -->
    <section id="categories" class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Danh mục sản phẩm</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Khám phá các danh mục sản phẩm đa dạng của chúng tôi</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse($categories as $category)
                    <a href="{{ route('shop.index', ['category' => $category->id]) }}"
                        class="group bg-white rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-indigo-200">
                        <div class="text-4xl mb-3 group-hover:scale-110 transition-transform duration-300">
                            @if($category->name === 'Điện thoại')
                                📱
                            @elseif($category->name === 'Laptop')
                                💻
                            @elseif($category->name === 'Tablet')
                                📱
                            @elseif($category->name === 'Tai nghe')
                                🎧
                            @elseif($category->name === 'Phụ kiện')
                                🔌
                            @else
                                📦
                            @endif
                        </div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition text-sm">
                            {{ $category->name }}
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $category->products->count() }} sản phẩm</p>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-8">Chưa có danh mục nào</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Products Section - Layout đẹp hơn -->
    <section id="products" class="bg-white py-12 fade-in-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Sản phẩm nổi bật</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Những sản phẩm được nhiều khách hàng yêu thích và đánh giá
                    cao</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group product-card fade-in-on-scroll"
                        data-product-id="{{ $product->id }}">

                        {{-- 2. Thẻ <a> CHỈ bọc hình ảnh --}}
                            <a href="{{ $product->category && $product->category->slug ? route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]) : '#' }}"
                                class="block">
                                <div class="relative h-56 bg-gray-50 overflow-hidden product-image-container">
                                    @if($product->images->first())
                                        <img src="{{ Storage::url($product->images->first()->image_url) }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover product-image-zoom">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <span class="text-gray-400">Chưa có ảnh</span>
                                        </div>
                                    @endif

                                    {{-- Các badge của bạn (Hot, Đang xem, Quick View, Wishlist) --}}
                                    <div
                                        class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold z-10">
                                        Hot
                                    </div>
                                    <div
                                        class="absolute top-3 left-16 bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold z-10 social-proof-badge"
                                        data-product-id="{{ $product->id }}">
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span class="viewers-count">-</span> đang xem
                                        </span>
                                    </div>
                                    <div
                                        class="absolute top-3 right-3 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                        <button onclick="event.preventDefault(); openQuickView({{ $product->id }});"
                                            class="bg-white/95 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all hover:scale-110">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">

                                                </path>

                                            </svg>

                                        </button>
                                        <button onclick="event.preventDefault(); toggleWishlist({{ $product->id }});"
                                            class="wishlist-btn bg-white/95 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all hover:scale-110">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">

                                                </path>

                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </a>

                            {{-- 3. Phần nội dung (p-4) KHÔNG nằm trong thẻ <a> --}}
                                <div class="p-4">
                                    <div class="mb-1">
                                        <span
                                            class="text-xs text-gray-500">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                                    </div>

                                    {{-- 4. Thẻ <a> CHỈ bọc tiêu đề --}}
                                        <a
                                            href="{{ $product->category && $product->category->slug ? route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]) : '#' }}">
                                            <h3
                                                class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3rem]">
                                                {{ $product->name }}
                                            </h3>
                                        </a>

                                        @if($product->specifications && isset($product->specifications['RAM']))
                                            <p class="text-xs text-gray-600 mb-2">{{ $product->specifications['RAM'] }}</p>
                                        @endif

                                        {{-- 5. Div cho Giá và Rating (Nút + đã bị xóa khỏi đây) --}}
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <p class="text-lg font-bold text-indigo-600">
                                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                                </p>
                                            </div>
                                            @php
                                                $ratingValue = $product->reviews_avg_rating ? round($product->reviews_avg_rating, 1) : null;
                                                $ratingCount = $product->reviews_count ?? 0;
                                            @endphp
                                            <div class="flex items-center gap-1">
                                                <div class="flex">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $ratingValue !== null && $ratingValue >= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L3.98 8.72c-.783-.57-.38-1.81.588-1.81H8.03a1 1 0 00.95-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="text-xs text-gray-600">
                                                    @if($ratingCount > 0)
                                                        {{ number_format($ratingValue, 1) }}/5 · {{ $ratingCount }}
                                                    @else
                                                        Chưa có
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        @if($product->stock_quantity > 0)
                                            <p class="text-xs text-green-600 mb-2">✓ Còn hàng</p>
                                        @else
                                            <p class="text-xs text-red-600 mb-2">✗ Hết hàng</p>
                                        @endif

                                        {{-- 6. NÚT ALPINE.JS THÔNG MINH (NẰM Ở CUỐI) --}}
                                        <div class="relative h-9"> {{-- Cung cấp chiều cao cố định cho 2 nút --}}
                                            <button type="button" {{-- Chỉ hiển thị khi CHƯA có trong $store --}}
                                                x-show="!$store.cart.isInCart({{ $product->id }})" {{-- Gọi hàm global --}}
                                                @click="$store.cart.addToCart({{ $product->id }})" x-transition
                                                class="absolute inset-0 w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium add-to-cart-btn">
                                                Thêm vào giỏ
                                            </button>

                                            <a href="{{ route('cart.index') }}" {{-- Chỉ hiển thị khi ĐÃ CÓ trong $store
                                                --}} x-show="$store.cart.isInCart({{ $product->id }})" x-transition
                                                style="display: none;" {{-- Tránh FOUC --}}
                                                class="absolute inset-0 w-full flex items-center justify-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition text-sm font-medium">
                                                ✓ Đã thêm (Xem giỏ)
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

            <div class="text-center mt-8">
                <a href="{{ route('shop.index') }}"
                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả sản phẩm
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Category Showcase Section - 3 Cột lớn -->
    @if($mainCategories->count() >= 3)
        <section class="bg-white py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($mainCategories as $mainCategory)
                        <div
                            class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $mainCategory->name }}</h3>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach($mainCategory->products->take(6) as $product)
                                        @php
                                            $productUrl = '#';
                                            if ($product->category && $product->category->slug) {
                                                $productUrl = route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]);
                                            } elseif ($product->category) {
                                                $productUrl = route('products.show', ['category' => $product->category->id, 'product' => $product->slug ?? $product->id]);
                                            }
                                        @endphp
                                        <a href="{{ $productUrl }}"
                                            class="group bg-white rounded-lg p-3 hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-indigo-300">
                                            <div class="relative h-32 mb-2 bg-gray-50 rounded overflow-hidden">
                                                @if($product->images->first())
                                                    <img data-src="{{ Storage::url($product->images->first()->image_url) }}"
                                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                        alt="{{ $product->name }}" 
                                                        class="lazyload w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                        <span class="text-gray-400 text-xs">Chưa có ảnh</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <h4
                                                class="text-xs font-semibold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 mb-1">
                                                {{ $product->name }}
                                            </h4>
                                            <p class="text-xs font-bold text-indigo-600">
                                                {{ number_format($product->price, 0, ',', '.') }} đ
                                            </p>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="{{ route('shop.index') }}"
                                        class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-700 font-semibold text-sm">
                                        Xem tất cả <span>→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Best Sellers Section -->
    <section class="bg-gray-50 py-12 fade-in-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Sản phẩm bán chạy</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Những sản phẩm được khách hàng yêu thích và mua nhiều nhất
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($bestSellers->take(8) as $product)
                    
                    

                    <div
                        class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">

                        {{-- 1. Chuẩn bị link an toàn --}}
                        @php
                            $productUrl = '#'; // Link dự phòng
                            if ($product->category && $product->category->slug) {
                                $productUrl = route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]);
                            }
                        @endphp

                        {{-- 2. Thẻ <a> bọc toàn bộ card (GIỮ NGUYÊN NHƯ CODE GỐC CỦA BẠN) --}}
                            <a href="{{ $productUrl }}" class="block">
                                <div class="relative h-56 bg-gray-50 overflow-hidden">
                                    @if($product->images->first())
                                        <img src="{{ Storage::url($product->images->first()->image_url) }}" {{-- <-- Sửa: Dùng
                                            Storage::url() --}} alt="{{ $product->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <span class="text-gray-400">Chưa có ảnh</span>
                                        </div>
                                    @endif

                                    <div
                                        class="absolute top-3 left-3 bg-orange-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                        Bán chạy
                                    </div>
                                </div>

                                <div class="p-4">
                                    <span
                                        class="text-xs text-gray-500">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                                    <h3
                                        class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3rem]">
                                        {{ $product->name }}
                                    </h3>

                                    <div class="flex items-center justify-between mb-2">
                                        <p class="text-lg font-bold text-indigo-600">
                                            {{ number_format($product->price, 0, ',', '.') }} đ
                                        </p>
                                        <div class="flex items-center text-yellow-400">
                                            <svg class="w-4 h-4" ...>...</svg>
                                            <span class="ml-1 text-xs text-gray-600">4.9</span>
                                        </div>
                                    </div>

                                    {{-- 3. NÚT BẤM "THÔNG MINH" SỬ DỤNG $store --}}
                                    <div class="relative h-9"> {{-- Cung cấp chiều cao cố định cho 2 nút --}}

                                        <button type="button" {{-- Chỉ hiển thị khi CHƯA có trong $store --}}
                                            x-show="!$store.cart.isInCart({{ $product->id }})" {{-- SỬA LỖI QUAN TRỌNG: -
                                            event.preventDefault(): Ngăn thẻ <a> cha (link) chạy.
                                            - event.stopPropagation(): Ngăn sự kiện click "nổi bọt" lên thẻ <a>.
                                                --}}
                                                @click="event.preventDefault(); event.stopPropagation();
                                                $store.cart.addToCart({{ $product->id }})"
                                                x-transition
                                                class="absolute inset-0 w-full bg-indigo-600 text-white py-2 rounded-lg
                                                hover:bg-indigo-700 transition text-sm font-medium">
                                                Thêm vào giỏ
                                        </button>

                                        <a href="{{ route('cart.index') }}" {{-- Chỉ hiển thị khi ĐÃ CÓ trong $store --}}
                                            x-show="$store.cart.isInCart({{ $product->id }})" x-transition
                                            style="display: none;"
                                            class="absolute inset-0 w-full flex items-center justify-center bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition text-sm font-medium">
                                            ✓ Đã thêm (Xem giỏ)
                                        </a>
                                    </div>
                                </div>
                            </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Chưa có sản phẩm bán chạy</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('shop.index') }}"
                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả sản phẩm bán chạy
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Flash Sale Section - Nổi bật với timer riêng -->
    <section id="flash-sale-section" class="bg-gradient-to-br from-red-600 via-pink-600 to-orange-600 py-16 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%221%22%3E%3Cpath d=%22M36 34v-4h-4v-4h-4v4h-4v4h4v4h4v-4h4zm0-30V0h-4v4h-4v4h4v4h4V8h4V4h4V0h-4z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <!-- Floating Icons Container - Chỉ trong khu vực Flash Sale -->
        <div id="floating-icons-container" class="absolute inset-0 pointer-events-none z-0"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                    <svg class="w-5 h-5 text-yellow-300 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-white font-bold text-sm">FLASH SALE</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 drop-shadow-lg">Siêu khuyến mãi</h2>
                <p class="text-white/90 text-lg mb-6">Giảm giá cực sốc - Chỉ còn hôm nay!</p>

                <!-- Flash Sale Countdown -->
                <div class="flex items-center justify-center gap-3 mb-8">
                    <div
                        class="bg-white/20 backdrop-blur-md rounded-xl px-6 py-4 text-center min-w-[80px] border border-white/30">
                        <div class="text-3xl font-bold text-white" id="flash-hours">00</div>
                        <div class="text-xs text-white/80 mt-1">Giờ</div>
                    </div>
                    <span class="text-white text-2xl font-bold">:</span>
                    <div
                        class="bg-white/20 backdrop-blur-md rounded-xl px-6 py-4 text-center min-w-[80px] border border-white/30">
                        <div class="text-3xl font-bold text-white" id="flash-minutes">00</div>
                        <div class="text-xs text-white/80 mt-1">Phút</div>
                    </div>
                    <span class="text-white text-2xl font-bold">:</span>
                    <div
                        class="bg-white/20 backdrop-blur-md rounded-xl px-6 py-4 text-center min-w-[80px] border border-white/30">
                        <div class="text-3xl font-bold text-white" id="flash-seconds">00</div>
                        <div class="text-xs text-white/80 mt-1">Giây</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($hotDeals->take(6) as $index => $product)
                    <div
                        class="bg-white rounded-xl shadow-2xl overflow-hidden hover:scale-105 transition-transform duration-300 group">
                        <a href="{{ $product->category && $product->category->slug ? route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]) : '#' }}"
                            class="block">
                            <div class="relative h-40 bg-gray-50 overflow-hidden">
                                @if($product->images->first())
                                    <img
                                        data-src="{{ Storage::url($product->images->first()->image_url) }}"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        alt="{{ $product->name }}" 
                                        class="lazyload w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400 text-xs">No image</span>
                                    </div>
                                @endif
                                <div
                                    class="absolute top-2 right-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    -{{ rand(20, 50) }}%
                                </div>
                            </div>
                            <div class="p-3">
                                <h4 class="text-xs font-semibold text-gray-900 line-clamp-2 mb-2 min-h-[2.5rem]">
                                    {{ $product->name }}
                                </h4>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-bold text-red-600">
                                        {{ number_format($product->price * 0.7, 0, ',', '.') }}đ
                                    </p>
                                    <p class="text-xs text-gray-400 line-through">
                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="#hot-deals"
                    class="inline-flex items-center gap-2 bg-white text-red-600 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition hover:scale-105">
                    Xem tất cả deal sốc
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Hot Deals Section - Với Countdown Timer -->
    <section id="hot-deals" class="bg-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Deal sốc hôm nay</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-4">Những ưu đãi đặc biệt không thể bỏ qua</p>
                <!-- Countdown Timer -->
                <div class="flex items-center justify-center gap-4 mb-6">
                    <span class="text-sm text-gray-600 font-medium">Kết thúc sau:</span>
                    <div id="countdown" class="flex gap-2">
                        <div class="bg-red-600 text-white px-4 py-2 rounded-lg min-w-[60px] text-center">
                            <div class="text-2xl font-bold" id="hours">00</div>
                            <div class="text-xs">Giờ</div>
                        </div>
                        <div class="bg-red-600 text-white px-4 py-2 rounded-lg min-w-[60px] text-center">
                            <div class="text-2xl font-bold" id="minutes">00</div>
                            <div class="text-xs">Phút</div>
                        </div>
                        <div class="bg-red-600 text-white px-4 py-2 rounded-lg min-w-[60px] text-center">
                            <div class="text-2xl font-bold" id="seconds">00</div>
                            <div class="text-xs">Giây</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($hotDeals->take(6) as $product)
                    <div
                        class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border-2 border-red-200 group relative">
                        <div
                            class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold z-10">
                            -20%
                        </div>
                        <a href="{{ $product->category && $product->category->slug ? route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]) : '#' }}"
                            class="block">
                            <div class="relative h-64 bg-gray-50 overflow-hidden">
                                @if($product->images->first())
                                    <img
                                        data-src="{{ Storage::url($product->images->first()->image_url) }}"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        alt="{{ $product->name }}" 
                                        class="lazyload w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400">Chưa có ảnh</span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-5">
                                <span
                                    class="text-xs text-gray-600">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                                <h3
                                    class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-red-600 transition">
                                    {{ $product->name }}
                                </h3>

                                <div class="flex items-center gap-3 mb-3">
                                    <p class="text-xl font-bold text-red-600">
                                        {{ number_format($product->price * 0.8, 0, ',', '.') }} đ
                                    </p>
                                    <p class="text-sm text-gray-400 line-through">
                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                    </p>
                                </div>

                                <button onclick="event.preventDefault(); addToCart({{ $product->id }});"
                                    class="w-full bg-red-600 text-white py-2.5 rounded-lg hover:bg-red-700 transition text-sm font-medium">
                    Mua ngay
                                </button>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Chưa có deal sốc</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('shop.index') }}"
                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả deal sốc
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Used Products Section -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">HÀNG CŨ</h2>
                    <p class="text-gray-600">Sản phẩm đã qua sử dụng với giá tốt</p>
                </div>
                <a href="{{ route('shop.index') }}"
                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả <span>→</span>
                </a>
    </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($usedProducts->take(12) as $product)
                        @php
                            $productUrl = '#';
                            if ($product->category && $product->category->slug) {
                                $productUrl = route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]);
                            } elseif ($product->category) {
                                $productUrl = route('products.show', ['category' => $product->category->id, 'product' => $product->slug ?? $product->id]);
                            }
                        @endphp
                        <a href="{{ $productUrl }}"
                            class="group text-center p-4 rounded-lg hover:bg-gray-50 transition-all duration-300 border border-gray-100 hover:border-indigo-200">
                            <div class="relative h-32 mb-3 bg-gray-50 rounded overflow-hidden mx-auto">
                                @if($product->images->first())
                                    <img 
                                        data-src="{{ Storage::url($product->images->first()->image_url) }}"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        alt="{{ $product->name }}" 
                                        class="lazyload w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="lazyload w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400 text-xs">Chưa có ảnh</span>
                                    </div>
                                @endif
                            </div>
                            <h4
                                class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 mb-1">
                                {{ $product->name }}
                            </h4>
                            <p class="text-xs text-gray-600 mb-2">{{ $product->category->name ?? '' }}</p>
                            <p class="text-sm font-bold text-indigo-600">
                                {{ number_format($product->price, 0, ',', '.') }} đ
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Badges Section -->
    <section class="bg-white py-12 border-y">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Được tin tưởng bởi</h3>
            </div>
            <div
                class="flex flex-wrap items-center justify-center gap-8 md:gap-12 opacity-60 hover:opacity-100 transition-opacity">
                <!-- Partner Logos -->
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <span class="text-indigo-600 font-bold text-lg">S</span>
                    </div>
                    <span class="text-gray-700 font-semibold">Samsung</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-lg">A</span>
                    </div>
                    <span class="text-gray-700 font-semibold">Apple</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <span class="text-green-600 font-bold text-lg">X</span>
                    </div>
                    <span class="text-gray-700 font-semibold">Xiaomi</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <span class="text-purple-600 font-bold text-lg">P</span>
                    </div>
                    <span class="text-gray-700 font-semibold">Philips</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <span class="text-orange-600 font-bold text-lg">S</span>
                    </div>
                    <span class="text-gray-700 font-semibold">Sony</span>
                </div>
            </div>

            <!-- Trust Certificates -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-6">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Chứng nhận uy tín</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01A1 1 0 0011 9H9zm0 4a1 1 0 100 2h.01A1 1 0 0011 13H9zm-2-4a1 1 0 11-2 0 1 1 0 012 0zm-1 5a1 1 0 100-2h.01A1 1 0 1011 14H7z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Xuất hóa đơn VAT</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span>Đánh giá {{ number_format($globalRating, 1) }}/5</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Recently Viewed Products Section -->
    <section class="bg-gray-50 py-16 fade-in-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Sản phẩm đã xem</h2>
                    <p class="text-gray-600">Tiếp tục mua sắm những sản phẩm bạn quan tâm</p>
                </div>
                <a href="{{ route('shop.index') }}"
                    class="hidden md:inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả <span>→</span>
                </a>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <div id="recentlyViewed" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <!-- Will be populated by JavaScript from localStorage -->
                    <div class="col-span-full text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        <p class="text-sm">Chưa có sản phẩm nào đã xem</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Tại sao chọn chúng tôi?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Những lý do khiến khách hàng tin tưởng và lựa chọn chúng tôi
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Chất lượng đảm bảo</h3>
                    <p class="text-sm text-gray-600">100% sản phẩm chính hãng, có bảo hành</p>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Giá cả hợp lý</h3>
                    <p class="text-sm text-gray-600">Giá tốt nhất thị trường, nhiều ưu đãi</p>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Giao hàng nhanh</h3>
                    <p class="text-sm text-gray-600">Miễn phí vận chuyển cho đơn hàng lớn</p>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Bảo hành uy tín</h3>
                    <p class="text-sm text-gray-600">Chế độ bảo hành tốt, hỗ trợ tận tâm</p>
                </div>
            </div>
        </div>
    </section>

    <!-- New Products Section -->
    <section id="new-products" class="bg-white py-12 fade-in-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Sản phẩm mới nhất</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Cập nhật những sản phẩm công nghệ mới nhất trên thị trường
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($newProducts->take(8) as $product)
                    <div
                        class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                        <a href="{{ $product->category && $product->category->slug ? route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]) : '#' }}"
                            class="block">
                            <div class="relative h-56 bg-gray-50 overflow-hidden">
                                @if($product->images->first())
                                    <img 
                                        data-src="{{ Storage::url($product->images->first()->image_url) }}"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        alt="{{ $product->name }}" 
                                        class="lazyload w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400">Chưa có ảnh</span>
                                    </div>
                                @endif

                                <div
                                    class="absolute top-3 left-3 bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                    Mới
                                </div>
                            </div>

                            <div class="p-4">
                                <span
                                    class="text-xs text-gray-500">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                                <h3
                                    class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3rem]">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-lg font-bold text-indigo-600 mb-3">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </p>
                                <button
                                    onclick="event.preventDefault(); {{ $product->category && $product->category->slug ? 'window.location.href=\'' . route('products.show', ['category' => $product->category->slug, 'product' => $product->slug]) . '\'' : '#' }}"
                                    class="w-full bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition text-sm font-medium">
                                    Xem chi tiết
                                </button>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Chưa có sản phẩm mới</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('shop.index') }}"
                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả sản phẩm mới
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section - Đánh giá khách hàng -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Khách hàng nói gì về chúng tôi?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Những phản hồi chân thật từ khách hàng đã sử dụng dịch vụ</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center text-yellow-400 mr-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4 italic">"Sản phẩm chất lượng cao, giao hàng nhanh, nhân viên tư vấn
                        nhiệt tình. Rất hài lòng với dịch vụ!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-indigo-600 font-bold">NV</span>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Nguyễn Văn</div>
                            <div class="text-sm text-gray-500">Khách hàng thân thiết</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center text-yellow-400 mr-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4 italic">"Giá cả hợp lý, sản phẩm chính hãng, bảo hành tốt. Đã mua nhiều
                        lần và rất tin tưởng!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-green-600 font-bold">TH</span>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Trần Thị Hoa</div>
                            <div class="text-sm text-gray-500">Khách hàng VIP</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center text-yellow-400 mr-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4 italic">"Đóng gói cẩn thận, giao hàng đúng hẹn. Sẽ tiếp tục ủng hộ shop
                        trong tương lai!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-purple-600 font-bold">LM</span>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Lê Minh</div>
                            <div class="text-sm text-gray-500">Khách hàng mới</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog/Tin tức Section -->
    <section class="bg-white py-12 fade-in-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Tin tức & Công nghệ</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Cập nhật những tin tức mới nhất về công nghệ và sản phẩm</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Blog Post 1 -->
                <article
                    class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                    <a href="#" class="block">
                        <div class="relative h-48 bg-gradient-to-br from-indigo-400 to-purple-500 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div
                                class="absolute top-3 left-3 bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Tin tức
                            </div>
                    </div>
                    <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>{{ date('d/m/Y') }}</span>
                    </div>
                            <h3
                                class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition line-clamp-2">
                                Top 10 sản phẩm công nghệ hot nhất năm 2024
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                                Khám phá những sản phẩm công nghệ đang được săn đón nhất trong năm 2024, từ smartphone
                                đến laptop và các thiết bị thông minh.
                            </p>
                            <div class="flex items-center gap-2 text-indigo-600 text-sm font-medium">
                                <span>Đọc thêm</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                </div>
                        </div>
                    </a>
                </article>

                <!-- Blog Post 2 -->
                <article
                    class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                    <a href="#" class="block">
                        <div class="relative h-48 bg-gradient-to-br from-green-400 to-blue-500 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01A1 1 0 0011 9H9zm0 4a1 1 0 100 2h.01A1 1 0 0011 13H9zm-2-4a1 1 0 11-2 0 1 1 0 012 0zm-1 5a1 1 0 100-2h.01A1 1 0 1011 14H7z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div
                                class="absolute top-3 left-3 bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Hướng dẫn
                            </div>
                    </div>
                    <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>{{ date('d/m/Y', strtotime('-1 day')) }}</span>
                    </div>
                            <h3
                                class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition line-clamp-2">
                                Cách chọn mua điện thoại phù hợp với nhu cầu
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                                Hướng dẫn chi tiết giúp bạn chọn được chiếc smartphone phù hợp nhất với nhu cầu và ngân
                                sách của mình.
                            </p>
                            <div class="flex items-center gap-2 text-indigo-600 text-sm font-medium">
                                <span>Đọc thêm</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                </div>
                        </div>
                    </a>
                </article>

                <!-- Blog Post 3 -->
                <article
                    class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                    <a href="#" class="block">
                        <div class="relative h-48 bg-gradient-to-br from-orange-400 to-red-500 overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                </div>
                            <div
                                class="absolute top-3 left-3 bg-orange-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Đánh giá
        </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>{{ date('d/m/Y', strtotime('-2 days')) }}</span>
                            </div>
                            <h3
                                class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition line-clamp-2">
                                Review chi tiết: Laptop mới nhất 2024 có gì đặc biệt?
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                                Đánh giá toàn diện về các dòng laptop mới nhất năm 2024, so sánh hiệu năng, giá cả và
                                tính năng nổi bật.
                            </p>
                            <div class="flex items-center gap-2 text-indigo-600 text-sm font-medium">
                                <span>Đọc thêm</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </article>
    </div>

            <div class="text-center mt-8">
                <a href="#" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả tin tức
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Video Reviews Section - Giống CellphoneS -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">REVIEW SẢN PHẨM</h2>
                <a href="https://www.youtube.com" target="_blank"
                    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold whitespace-nowrap text-lg">
                    Xem YouTube <span>→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($videoReviews->take(4) as $index => $product)
                    <div
                        class="bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 group">
                        <!-- Video Short Container - Tự động phát -->
                        <div class="relative bg-gray-100 overflow-hidden">
                            <!-- Video Player - YouTube Shorts hoặc HTML5 Video tự động phát -->
                            <div class="relative w-full h-64 overflow-hidden bg-black rounded-t-lg">
                                @php
                                    // Tạo video ID dựa trên index (có thể thay bằng video ID thật sau)
                                    $videoIds = ['dQw4w9WgXcQ', 'kJQP7kiw5Fk'];
                                    $videoId = $videoIds[$index % count($videoIds)];
                                @endphp

                                <!-- YouTube Shorts Embed - Tự động phát, lặp lại, tắt tiếng -->
                                <iframe class="w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&loop=1&playlist={{ $videoId }}&mute=1&controls=0&modestbranding=1&rel=0&playsinline=1"
                                    frameborder="0"
                                    allow="autoplay; encrypted-media; accelerometer; gyroscope; picture-in-picture"
                                    allowfullscreen loading="lazy"></iframe>

                                <!-- Fallback: Nếu không có YouTube, dùng ảnh với animation -->
                                @if($product->images->first())
                                    <div class="absolute inset-0 hidden fallback-video">
                                        <img data-src="{{ Storage::url($product->images->first()->image_url) }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover animate-pulse">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Video Info -->
                        <div class="p-4">
                            <h3
                                class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2 min-h-[2.5rem] group-hover:text-indigo-600 transition">
                                {{ $product->name }} - Review chi tiết | PolyTech Store
                            </h3>

                            <!-- Channel Info -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-red-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">S</span>
                                    </div>
                                    <span class="text-xs text-gray-600 font-medium">PolyTech Store</span>
                                </div>
                                <button
                                    class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-full hover:bg-red-700 transition">
                                    Đăng ký
                                </button>
                            </div>
                        </div>

                        <!-- Product Info Below -->
                        <div class="px-4 pb-4 pt-0 border-t border-gray-100">
                            <div class="flex items-center gap-3 mt-3">
                                @if($product->images->first())
                                    <img data-src="{{ Storage::url($product->images->first()->image_url) }}"
                                        alt="{{ $product->name }}" class="lazyload w-16 h-16 object-cover rounded border border-gray-200"
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==">
                                @else
                                    <div
                                        class="w-16 h-16 bg-gray-200 rounded border border-gray-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 line-clamp-1">{{ $product->name }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        @if($product->price > 10000000)
                                            <p class="text-base font-bold text-red-600">
                                                {{ number_format($product->price * 0.95, 0, ',', '.') }} đ
                                            </p>
                                            <p class="text-xs text-gray-400 line-through">
                                                {{ number_format($product->price, 0, ',', '.') }} đ
                                            </p>
                                        @else
                                            <p class="text-base font-bold text-indigo-600">
                                                {{ number_format($product->price, 0, ',', '.') }} đ
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact & Map Section -->
    <section id="contact" class="bg-white py-12 fade-in-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Liên hệ với chúng tôi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Chúng tôi luôn sẵn sàng hỗ trợ và giải đáp mọi thắc mắc của
                    bạn</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Contact Form -->
                <div class="bg-gray-50 rounded-xl p-8 shadow-lg">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Gửi tin nhắn</h3>
                    <form id="contactForm" class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Họ tên *</label>
                                <input type="text" name="name" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                    placeholder="Nhập họ tên">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại *</label>
                                <input type="tel" name="phone" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                    placeholder="0900 123 456">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                placeholder="email@example.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Chủ đề *</label>
                            <select name="subject" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                <option value="">Chọn chủ đề</option>
                                <option value="product">Hỏi về sản phẩm</option>
                                <option value="order">Hỏi về đơn hàng</option>
                                <option value="warranty">Bảo hành</option>
                                <option value="support">Hỗ trợ kỹ thuật</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nội dung *</label>
                            <textarea name="message" rows="5" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none"
                                placeholder="Nhập nội dung tin nhắn..."></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-indigo-700 transition shadow-lg hover:shadow-xl">
                            Gửi tin nhắn
                        </button>
                    </form>
                </div>

                <!-- Contact Info & Map -->
                <div class="space-y-6">
                    <!-- Contact Info -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-8 shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Thông tin liên hệ</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Địa chỉ</h4>
                                    <p class="text-gray-600 text-sm">123 Đường ABC, Quận Sơn Trà, Đà Nẵng</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Điện thoại</h4>
                                    <a href="tel:19001234" class="text-indigo-600 hover:text-indigo-700 text-sm">1900
                                        1234</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                    <a href="mailto:support@PolyTech.com"
                                        class="text-indigo-600 hover:text-indigo-700 text-sm">support@PolyTech.com</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Giờ làm việc</h4>
                                    <p class="text-gray-600 text-sm">Thứ 2 - Chủ nhật: 8:00 - 22:00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="bg-gray-100 rounded-xl overflow-hidden shadow-lg h-64">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.962836084121!2d108.247157!3d16.054408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219c9f6b1b6e1%3A0x2c4e5d3e8f5f3a2b!2zU8OibiBUcsOgLCBEYSBOxINuZywgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1234567890"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="w-full h-full"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-gray-50 py-12 fade-in-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Câu hỏi thường gặp</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Tìm câu trả lời cho những thắc mắc phổ biến nhất</p>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="space-y-4" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition"
                            onclick="toggleFAQ(this)">
                            <span class="font-semibold text-gray-900">Làm thế nào để đặt hàng?</span>
                            <svg class="w-5 h-5 text-gray-500 faq-icon" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-content">
                            <p class="text-gray-600">Bạn có thể đặt hàng trực tuyến trên website, qua hotline 1900 1234,
                                hoặc đến trực tiếp cửa hàng. Sau khi đặt hàng, chúng tôi sẽ xác nhận và giao hàng trong
                                vòng 24-48 giờ.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition"
                            onclick="toggleFAQ(this)">
                            <span class="font-semibold text-gray-900">Chính sách đổi trả như thế nào?</span>
                            <svg class="w-5 h-5 text-gray-500 faq-icon" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-content">
                            <p class="text-gray-600">Chúng tôi hỗ trợ đổi trả trong vòng 7 ngày kể từ ngày nhận hàng.
                                Sản phẩm phải còn nguyên vẹn, chưa sử dụng và có đầy đủ hóa đơn, phụ kiện đi kèm.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition"
                            onclick="toggleFAQ(this)">
                            <span class="font-semibold text-gray-900">Phương thức thanh toán nào được chấp nhận?</span>
                            <svg class="w-5 h-5 text-gray-500 faq-icon" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-content">
                            <p class="text-gray-600">Chúng tôi chấp nhận thanh toán bằng tiền mặt, chuyển khoản ngân
                                hàng, thẻ tín dụng/ghi nợ, và các ví điện tử phổ biến như Momo, ZaloPay, VNPay.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition"
                            onclick="toggleFAQ(this)">
                            <span class="font-semibold text-gray-900">Thời gian giao hàng là bao lâu?</span>
                            <svg class="w-5 h-5 text-gray-500 faq-icon" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-content">
                            <p class="text-gray-600">Đối với khu vực nội thành: 1-2 ngày. Khu vực ngoại thành: 2-3 ngày.
                                Các tỉnh thành khác: 3-5 ngày làm việc. Miễn phí vận chuyển cho đơn hàng trên 300.000đ.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition"
                            onclick="toggleFAQ(this)">
                            <span class="font-semibold text-gray-900">Sản phẩm có bảo hành không?</span>
                            <svg class="w-5 h-5 text-gray-500 faq-icon" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-content">
                            <p class="text-gray-600">Tất cả sản phẩm đều có bảo hành chính hãng từ nhà sản xuất. Thời
                                gian bảo hành tùy thuộc vào từng sản phẩm, thường từ 12-24 tháng. Chúng tôi hỗ trợ xử lý
                                bảo hành tại cửa hàng.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button
                            class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition"
                            onclick="toggleFAQ(this)">
                            <span class="font-semibold text-gray-900">Có thể mua trả góp không?</span>
                            <svg class="w-5 h-5 text-gray-500 faq-icon" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="faq-content">
                            <p class="text-gray-600">Có, chúng tôi hỗ trợ mua trả góp qua các ngân hàng đối tác với lãi
                                suất 0% trong 6-12 tháng. Áp dụng cho đơn hàng từ 5.000.000đ trở lên.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section - Đơn giản hơn -->
    <section class="bg-indigo-600 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl font-bold mb-3">Đăng ký nhận tin</h2>
                <p class="text-indigo-100 mb-6">Nhận thông tin về sản phẩm mới và các chương trình khuyến mãi đặc biệt
                </p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="Nhập email của bạn..."
                        class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-white"
                        required>
                    <button type="submit"
                        class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition whitespace-nowrap">
                        Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Floating Action Buttons - Nhẹ nhàng, chuyên nghiệp -->
    <div class="fixed bottom-4 right-4 md:bottom-6 md:right-6 z-40 flex flex-col gap-3">
        <!-- Scroll to Top Button -->
        <button id="scrollToTop"
            class="hidden bg-indigo-600 text-white p-3 md:p-3.5 rounded-full shadow-lg hover:bg-indigo-700 transition-all duration-300 hover:shadow-xl hover:scale-110 active:scale-95 group animate-float-delay-1"
            aria-label="Lên đầu trang" title="Lên đầu trang">
            <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
                </path>
            </svg>
        </button>

        <!-- Contact/Phone Button -->
        <a id="contactButton" href="tel:19001234"
            class="bg-green-600 text-white p-3 md:p-3.5 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 hover:shadow-xl hover:scale-110 active:scale-95 group animate-float-gentle"
            aria-label="Gọi điện liên hệ" title="Liên hệ: 1900 1234">
            <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                </path>
            </svg>
        </a>

        <!-- Chat/Support Button -->
        <button id="chatButton"
            class="bg-indigo-500 text-white p-3 md:p-3.5 rounded-full shadow-lg hover:bg-indigo-600 transition-all duration-300 hover:shadow-xl hover:scale-110 active:scale-95 group animate-float-delay-2"
            aria-label="Hỗ trợ trực tuyến" title="Hỗ trợ trực tuyến" onclick="window.location.href='#contact'">
            <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                </path>
            </svg>
        </button>
    </div>

    <!-- Floating Notification Banner - Nhẹ nhàng, có thể đóng -->
    <div id="appBanner"
        class="fixed bottom-24 left-4 md:left-6 z-40 hidden md:block animate-fade-in animate-bounce-gentle">
        <div
            class="bg-white rounded-lg shadow-xl p-4 max-w-xs border border-gray-200 hover:shadow-2xl transition-shadow">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900 text-sm mb-1">Tải ứng dụng</h3>
                    <p class="text-xs text-gray-600 mb-2">Nhận ưu đãi đặc biệt khi mua hàng trên app</p>
                    <a href="#"
                        class="text-xs text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-1">
                        Tìm hiểu thêm
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
                <button onclick="document.getElementById('appBanner').style.display='none'"
                    class="text-gray-400 hover:text-gray-600 transition p-1" aria-label="Đóng" title="Đóng">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div id="quickViewModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto relative">
            <button onclick="closeQuickView()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div id="quickViewContent" class="p-6">
                <!-- Content will be loaded here -->
                <div class="text-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto"></div>
                    <p class="mt-4 text-gray-600">Đang tải...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Hero Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('opacity-100'));
            slides.forEach(slide => slide.classList.add('opacity-0'));
            dots.forEach(dot => {
                dot.classList.remove('active', 'bg-white');
                dot.classList.add('bg-white/50');
            });

            if (slides[index]) {
                slides[index].classList.remove('opacity-0');
                slides[index].classList.add('opacity-100');
            }
            if (dots[index]) {
                dots[index].classList.remove('bg-white/50');
                dots[index].classList.add('active', 'bg-white');
            }
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        // Slider controls
        document.querySelectorAll('.slider-dot').forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        document.querySelector('.slider-next')?.addEventListener('click', nextSlide);
        document.querySelector('.slider-prev')?.addEventListener('click', prevSlide);

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        // Countdown Timer cho "Deal sốc hôm nay"
        (function() {
            function updateCountdown() {
                // Tính thời gian kết thúc: cuối ngày hôm nay (23:59:59)
                const now = new Date();
                const endOfDay = new Date();
                endOfDay.setHours(23, 59, 59, 999); // Set về cuối ngày hôm nay
                
                const nowTime = now.getTime();
                const endTime = endOfDay.getTime();
                const distance = endTime - nowTime;

                const hoursEl = document.getElementById('hours');
                const minutesEl = document.getElementById('minutes');
                const secondsEl = document.getElementById('seconds');
                const countdownEl = document.getElementById('countdown');

                if (!hoursEl || !minutesEl || !secondsEl || !countdownEl) {
                    return; // Nếu không tìm thấy elements thì return
                }

                if (distance < 0) {
                    // Đã hết thời gian
                    clearInterval(countdownInterval);
                    countdownEl.innerHTML = '<div class="text-red-600 font-bold text-center">Đã kết thúc</div>';
                    return;
                }

                // Tính giờ, phút, giây còn lại
                const hours = Math.floor(distance / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Cập nhật UI
                hoursEl.textContent = String(hours).padStart(2, '0');
                minutesEl.textContent = String(minutes).padStart(2, '0');
                secondsEl.textContent = String(seconds).padStart(2, '0');
            }

            // Chỉ chạy countdown nếu có element
            const countdownEl = document.getElementById('countdown');
            if (countdownEl) {
                const countdownInterval = setInterval(updateCountdown, 1000);
                updateCountdown(); // Chạy ngay lập tức

                // Cleanup khi trang đóng
                window.addEventListener('beforeunload', () => {
                    clearInterval(countdownInterval);
                });
            }
        })();

        // Add to Cart - Global function để nút "Mua ngay" có thể gọi
        function addToCart(productId) {
            const btn = event.target;
            const originalText = btn.textContent;
            btn.textContent = 'Đang thêm...';
            btn.disabled = true;

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
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật số lượng giỏ hàng trong header
                    window.dispatchEvent(new CustomEvent('cart-updated', {
                        detail: { cartCount: data.cartCount }
                    }));
                    
                    btn.textContent = '✓ Đã thêm';
                    btn.classList.remove('bg-red-600', 'hover:bg-red-700');
                    btn.classList.add('bg-green-600', 'hover:bg-green-700');
                    
                    setTimeout(() => {
                        btn.textContent = originalText;
                        btn.classList.remove('bg-green-600', 'hover:bg-green-700');
                        btn.classList.add('bg-red-600', 'hover:bg-red-700');
                        btn.disabled = false;
                    }, 2000);
                } else {
                    alert(data.message || 'Có lỗi xảy ra khi thêm vào giỏ hàng');
                    btn.textContent = originalText;
                    btn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi kết nối. Vui lòng thử lại!');
                btn.textContent = originalText;
                btn.disabled = false;
            });
        }
        // }

        // Quick View
        function openQuickView(productId) {
            const modal = document.getElementById('quickViewModal');
            const content = document.getElementById('quickViewContent');
            modal.classList.remove('hidden');

            // Fetch product details
            fetch(`/api/products/${productId}`)
                .then(response => response.json())
                .then(data => {
                    // You can customize this based on your API response
                    content.innerHTML = `
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <img src="${data.image || '/placeholder.jpg'}" alt="${data.name}" class="w-full rounded-lg">
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold mb-4">${data.name}</h2>
                                <p class="text-3xl font-bold text-indigo-600 mb-4">${new Intl.NumberFormat('vi-VN').format(data.price)} đ</p>
                                <p class="text-gray-600 mb-4">${data.description || ''}</p>
                                <button onclick="addToCart(${productId})" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-medium">
                                    Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    `;
                })
                .catch(error => {
                    console.error('Error:', error);
                    content.innerHTML = '<p class="text-red-600">Không thể tải thông tin sản phẩm</p>';
                });
        }

        function closeQuickView() {
            document.getElementById('quickViewModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('quickViewModal')?.addEventListener('click', function (e) {
            if (e.target === this) {
                closeQuickView();
            }
        });

        // Scroll to Top Button
        const scrollToTopBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('hidden');
                scrollToTopBtn.classList.add('flex');
            } else {
                scrollToTopBtn.classList.add('hidden');
                scrollToTopBtn.classList.remove('flex');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Pause animation on hover for better UX
        const floatingButtons = document.querySelectorAll('#scrollToTop, #contactButton, #chatButton');
        floatingButtons.forEach(button => {
            button.addEventListener('mouseenter', function () {
                this.style.animationPlayState = 'paused';
            });
            button.addEventListener('mouseleave', function () {
                this.style.animationPlayState = 'running';
            });
        });

        // Auto-hide app banner after 10 seconds
        setTimeout(() => {
            const banner = document.getElementById('appBanner');
            if (banner) {
                banner.style.opacity = '0';
                banner.style.transition = 'opacity 0.5s';
                setTimeout(() => {
                    banner.style.display = 'none';
                }, 500);
            }
        }, 10000);

        // Flash Sale Countdown Timer cho "Siêu khuyến mãi"
        (function() {
            function updateFlashSaleCountdown() {
                // Tính thời gian kết thúc: cuối ngày hôm nay (23:59:59)
                const now = new Date();
                const endOfDay = new Date();
                endOfDay.setHours(23, 59, 59, 999); // Set về cuối ngày hôm nay
                
                const nowTime = now.getTime();
                const endTime = endOfDay.getTime();
                const distance = endTime - nowTime;

                const flashHoursEl = document.getElementById('flash-hours');
                const flashMinutesEl = document.getElementById('flash-minutes');
                const flashSecondsEl = document.getElementById('flash-seconds');

                if (!flashHoursEl || !flashMinutesEl || !flashSecondsEl) {
                    return; // Nếu không tìm thấy elements thì return
                }

                if (distance < 0) {
                    // Đã hết thời gian
                    clearInterval(flashSaleInterval);
                    flashHoursEl.textContent = '00';
                    flashMinutesEl.textContent = '00';
                    flashSecondsEl.textContent = '00';
                    return;
                }

                // Tính giờ, phút, giây còn lại
                const hours = Math.floor(distance / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Cập nhật UI
                flashHoursEl.textContent = String(hours).padStart(2, '0');
                flashMinutesEl.textContent = String(minutes).padStart(2, '0');
                flashSecondsEl.textContent = String(seconds).padStart(2, '0');
            }

            // Chỉ chạy countdown nếu có elements
            const flashHoursEl = document.getElementById('flash-hours');
            if (flashHoursEl) {
                const flashSaleInterval = setInterval(updateFlashSaleCountdown, 1000);
                updateFlashSaleCountdown(); // Chạy ngay lập tức

                // Cleanup khi trang đóng
                window.addEventListener('beforeunload', () => {
                    clearInterval(flashSaleInterval);
                });
            }
        })();

        // Floating Icons Animation - Hiệu ứng tuyết rơi cho Flash Sale
        (function() {
            // Đợi DOM load xong
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initFloatingIcons);
            } else {
                initFloatingIcons();
            }

            function initFloatingIcons() {
                const flashSaleSection = document.getElementById('flash-sale-section');
                const container = document.getElementById('floating-icons-container');

                if (!flashSaleSection || !container) {
                    console.warn('Flash Sale section or container not found');
                    return;
                }

                // Danh sách các icon đẹp để rơi
                const icons = ['🎉', '💰', '🎁', '⭐', '🔥', '💎', '🎊', '🏆', '✨', '💫', '🎈', '🎯'];

                // Tốc độ, kích thước và pattern drift
                const speeds = ['slow', 'medium', 'fast'];
                const sizes = ['small', 'small', 'medium-size', 'medium-size', 'medium-size', 'large', 'large'];
                const patterns = ['pattern-1', 'pattern-2', 'pattern-3'];

                function createFloatingIcon() {
                    // Chỉ tạo icon nếu section Flash Sale đang visible
                    const rect = flashSaleSection.getBoundingClientRect();
                    const isVisible = rect.top < window.innerHeight && rect.bottom > 0;

                    if (!isVisible) return;

                    const icon = document.createElement('div');
                    icon.className = 'floating-icon';

                    // Chọn icon ngẫu nhiên
                    const randomIcon = icons[Math.floor(Math.random() * icons.length)];
                    icon.textContent = randomIcon;

                    // Vị trí ngẫu nhiên theo chiều ngang (trong phạm vi section)
                    const leftPosition = Math.random() * 100; // 0-100%
                    icon.style.left = leftPosition + '%';

                    // Delay ngẫu nhiên để không rơi cùng lúc
                    const delay = Math.random() * 2; // 0-2 giây
                    icon.style.animationDelay = delay + 's';

                    // Tốc độ rơi ngẫu nhiên
                    const speed = speeds[Math.floor(Math.random() * speeds.length)];
                    icon.classList.add(speed);

                    // Kích thước ngẫu nhiên
                    const size = sizes[Math.floor(Math.random() * sizes.length)];
                    icon.classList.add(size);

                    // Pattern drift ngẫu nhiên
                    const pattern = patterns[Math.floor(Math.random() * patterns.length)];
                    icon.classList.add(pattern);

                    // Thêm vào container
                    container.appendChild(icon);

                    // Xóa icon sau khi animation kết thúc
                    const duration = speed === 'slow' ? 8000 : speed === 'medium' ? 6000 : 4000;
                    setTimeout(() => {
                        if (icon.parentNode) {
                            icon.remove();
                        }
                    }, duration + delay * 1000);
                }

                // Tạo icon mới mỗi 0.6 giây (tăng tần suất để nhiều icon hơn)
                let iconInterval = setInterval(createFloatingIcon, 600);

                // Tạo nhiều icon ngay khi load (tăng từ 3 lên 8)
                for (let i = 0; i < 8; i++) {
                    setTimeout(() => createFloatingIcon(), i * 150);
                }

                // Dừng khi scroll ra khỏi section để tiết kiệm performance
                let isInView = true;
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        isInView = entry.isIntersecting;
                        if (isInView) {
                            if (!iconInterval) {
                                iconInterval = setInterval(createFloatingIcon, 800);
                            }
                        } else {
                            if (iconInterval) {
                                clearInterval(iconInterval);
                                iconInterval = null;
                            }
                        }
                    });
                }, { threshold: 0.1 });

                observer.observe(flashSaleSection);

                // Cleanup khi trang đóng
                window.addEventListener('beforeunload', () => {
                    if (iconInterval) clearInterval(iconInterval);
                    observer.disconnect();
                });
            } // Đóng function initFloatingIcons
        })();

        // Wishlist Toggle
        function toggleWishlist(productId) {
            const btn = event.target.closest('.wishlist-btn') || event.target;
            let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');

            if (wishlist.includes(productId)) {
                wishlist = wishlist.filter(id => id !== productId);
                btn.classList.remove('active');
                btn.querySelector('svg').setAttribute('fill', 'none');
            } else {
                wishlist.push(productId);
                btn.classList.add('active');
                btn.querySelector('svg').setAttribute('fill', 'currentColor');
            }

            localStorage.setItem('wishlist', JSON.stringify(wishlist));

            // Visual feedback
            btn.style.transform = 'scale(1.2)';
            setTimeout(() => {
                btn.style.transform = '';
            }, 200);
        }

        // Load wishlist state on page load
        document.addEventListener('DOMContentLoaded', () => {
            const wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            document.querySelectorAll('.wishlist-btn').forEach(btn => {
                const productId = parseInt(btn.closest('.product-card')?.dataset.productId);
                if (productId && wishlist.includes(productId)) {
                    btn.classList.add('active');
                    const svg = btn.querySelector('svg');
                    if (svg) svg.setAttribute('fill', 'currentColor');
                }
            });
        });

        // Track Product Views & Recently Viewed
        function trackProductView(productId, productName, productImage, productPrice, productUrl) {
            let viewed = JSON.parse(localStorage.getItem('recentlyViewed') || '[]');

            // Remove if already exists
            viewed = viewed.filter(item => item.id !== productId);

            // Add to beginning
            viewed.unshift({
                id: productId,
                name: productName,
                image: productImage,
                price: productPrice,
                url: productUrl,
                viewedAt: new Date().toISOString()
            });

            // Keep only last 6
            viewed = viewed.slice(0, 6);

            localStorage.setItem('recentlyViewed', JSON.stringify(viewed));
            loadRecentlyViewed();
        }

        // Load Recently Viewed Products
        function loadRecentlyViewed() {
            const container = document.getElementById('recentlyViewed');
            if (!container) return;

            const viewed = JSON.parse(localStorage.getItem('recentlyViewed') || '[]');

            if (viewed.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <p class="text-sm">Chưa có sản phẩm nào đã xem</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = viewed.map(item => `
                <a href="${item.url}" class="group text-center p-4 rounded-lg hover:bg-gray-50 transition-all duration-300 border border-gray-100 hover:border-indigo-200">
                    <div class="relative h-32 mb-3 bg-gray-50 rounded overflow-hidden mx-auto">
                        <img src="${item.image}" alt="${item.name}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             onerror="this.src='{{ asset('images/no-placeholder.jpg') }}'">
                    </div>
                    <h4 class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 mb-1">
                        ${item.name}
                    </h4>
                    <p class="text-sm font-bold text-indigo-600">
                        ${new Intl.NumberFormat('vi-VN').format(item.price)} đ
                    </p>
                </a>
            `).join('');
        }

        // Load recently viewed on page load
        document.addEventListener('DOMContentLoaded', () => {
            loadRecentlyViewed();
        });

        // Lazy Loading Animation on Scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all fade-in-on-scroll elements
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.fade-in-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });

        // Track product views when clicking product cards
        document.querySelectorAll('.product-card').forEach(card => {
            const link = card.querySelector('a[href]');
            if (link) {
                link.addEventListener('click', function (e) {
                    const productId = card.dataset.productId;
                    const productName = card.querySelector('h3')?.textContent?.trim() || '';
                    const productImage = card.querySelector('img')?.src || '';
                    const productPrice = parseInt(card.querySelector('.text-lg.font-bold')?.textContent?.replace(/[^\d]/g, '') || '0');
                    const productUrl = link.href;

                    trackProductView(productId, productName, productImage, productPrice, productUrl);
                });
            }
        });

        // FAQ Toggle Function
        function toggleFAQ(button) {
            const faqItem = button.parentElement;
            const content = faqItem.querySelector('.faq-content');
            const icon = button.querySelector('.faq-icon');

            const isOpen = content.classList.contains('open');

            // Close all other FAQs
            document.querySelectorAll('.faq-content').forEach(item => {
                if (item !== content) {
                    item.classList.remove('open');
                    item.parentElement.querySelector('.faq-icon')?.classList.remove('open');
                }
            });

            // Toggle current FAQ
            if (isOpen) {
                content.classList.remove('open');
                icon.classList.remove('open');
            } else {
                content.classList.add('open');
                icon.classList.add('open');
            }
        }

        // Contact Form Handler
        document.getElementById('contactForm')?.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;

            submitBtn.textContent = 'Đang gửi...';
            submitBtn.disabled = true;

            // Simulate form submission (replace with actual API call)
            setTimeout(() => {
                submitBtn.textContent = '✓ Đã gửi thành công!';
                submitBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                submitBtn.classList.add('bg-green-600', 'hover:bg-green-700');

                // Reset form
                this.reset();

                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
                    submitBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                    submitBtn.disabled = false;
                }, 3000);
            }, 1500);
        });

        // Loading Skeleton for Products (optional - can be shown while loading)
        function showProductSkeleton(container) {
            const skeletonHTML = `
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                    <div class="relative h-56 bg-gray-50 overflow-hidden">
                        <div class="skeleton skeleton-image"></div>
                    </div>
                    <div class="p-4">
                        <div class="skeleton skeleton-title mb-2"></div>
                        <div class="skeleton skeleton-text mb-2"></div>
                        <div class="skeleton skeleton-text w-3/4"></div>
                    </div>
                </div>
            `;

            for (let i = 0; i < 4; i++) {
                container.innerHTML += skeletonHTML;
            }
        }

        // ===== TRACKING SỐ NGƯỜI ĐANG XEM SẢN PHẨM =====
        // Track khi người dùng xem sản phẩm
        function trackProductViewing(productId) {
            fetch(`/api/products/${productId}/track-view`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            }).catch(err => console.error('Error tracking view:', err));
        }

        // Lấy số người đang xem sản phẩm
        function updateViewersCount(productId, badgeElement) {
            fetch(`/api/products/${productId}/viewers`)
                .then(response => response.json())
                .then(data => {
                    const countElement = badgeElement.querySelector('.viewers-count');
                    if (countElement) {
                        countElement.textContent = data.viewers_count || 0;
                    }
                })
                .catch(err => {
                    console.error('Error fetching viewers count:', err);
                    // Fallback: hiển thị số ngẫu nhiên nếu API lỗi
                    const countElement = badgeElement.querySelector('.viewers-count');
                    if (countElement) {
                        countElement.textContent = Math.floor(Math.random() * 20) + 3;
                    }
                });
        }

        // Lấy số đang xem cho tất cả sản phẩm trên trang
        function updateAllViewersCounts() {
            const badges = document.querySelectorAll('.social-proof-badge[data-product-id]');
            const productIds = Array.from(badges).map(badge => badge.dataset.productId);

            if (productIds.length === 0) return;

            // Track viewing cho tất cả sản phẩm hiển thị
            productIds.forEach(productId => {
                trackProductViewing(productId);
            });

            // Lấy số đang xem cho tất cả sản phẩm
            fetch('/api/products/viewers', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ product_ids: productIds })
            })
                .then(response => response.json())
                .then(data => {
                    badges.forEach(badge => {
                        const productId = badge.dataset.productId;
                        const countElement = badge.querySelector('.viewers-count');
                        if (countElement && data[productId] !== undefined) {
                            countElement.textContent = data[productId];
                        }
                    });
                })
                .catch(err => {
                    console.error('Error fetching viewers counts:', err);
                    // Fallback: hiển thị số ngẫu nhiên cho từng sản phẩm
                    badges.forEach(badge => {
                        const countElement = badge.querySelector('.viewers-count');
                        if (countElement) {
                            countElement.textContent = Math.floor(Math.random() * 20) + 3;
                        }
                    });
                });
        }

        // Track khi người dùng hover vào product card
        document.addEventListener('DOMContentLoaded', function() {
            // Cập nhật số đang xem khi trang load
            updateAllViewersCounts();

            // Cập nhật lại mỗi 30 giây
            setInterval(updateAllViewersCounts, 30000);

            // Track khi hover vào product card
            document.querySelectorAll('.product-card').forEach(card => {
                const productId = card.dataset.productId;
                if (productId) {
                    let hoverTimeout;
                    card.addEventListener('mouseenter', function() {
                        hoverTimeout = setTimeout(() => {
                            trackProductViewing(productId);
                            // Cập nhật số đang xem sau khi track
                            const badge = card.querySelector('.social-proof-badge[data-product-id="' + productId + '"]');
                            if (badge) {
                                setTimeout(() => updateViewersCount(productId, badge), 500);
                            }
                        }, 1000); // Track sau 1 giây hover
                    });

                    card.addEventListener('mouseleave', function() {
                        if (hoverTimeout) {
                            clearTimeout(hoverTimeout);
                        }
                    });
                }
            });
        });
        // ===== KẾT THÚC TRACKING =====
    </script>
</x-main-layout>