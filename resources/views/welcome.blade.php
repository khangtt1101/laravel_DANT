<x-main-layout>
    <!-- Hero Banner Section - Đơn giản, chuyên nghiệp -->
    <section class="relative bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-20 md:py-28">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-gray-800 animate-fade-in">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6 text-gray-900">
                        Cửa hàng 
                        <span class="text-indigo-600">Điện tử</span>
                        <br>
                        Chất lượng cao
            </h1>
                    <p class="text-lg md:text-xl mb-8 text-gray-600 leading-relaxed">
                        Chuyên cung cấp các sản phẩm công nghệ chính hãng với giá cả hợp lý và dịch vụ uy tín nhất.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#products" class="inline-flex items-center gap-2 bg-indigo-600 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:bg-indigo-700 transition hover:shadow-lg scroll-smooth">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Xem sản phẩm
                        </a>
                        <a href="#categories" class="inline-flex items-center gap-2 bg-white text-gray-700 font-semibold py-3 px-8 rounded-lg border-2 border-gray-200 hover:border-indigo-300 hover:text-indigo-600 transition scroll-smooth">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Danh mục
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white rounded-2xl p-8 shadow-xl">
                        <div class="text-center">
                            <div class="w-24 h-24 mx-auto mb-6 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="grid grid-cols-3 gap-4 mt-6">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-indigo-600">1000+</div>
                                    <div class="text-sm text-gray-500">Sản phẩm</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-indigo-600">5000+</div>
                                    <div class="text-sm text-gray-500">Khách hàng</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-indigo-600">4.8★</div>
                                    <div class="text-sm text-gray-500">Đánh giá</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="bg-white py-12 border-b">
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

    <!-- Brand Filter Section -->
    <section class="bg-white py-8 border-b">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">ĐỒ GIA DỤNG</h2>
                <a href="{{ route('shop.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold flex items-center gap-1">
                    Xem tất cả <span>→</span>
                </a>
            </div>
            <div class="flex flex-wrap gap-3 items-center">
                @foreach($popularBrands as $brand)
                    <button class="px-4 py-2 bg-gray-100 hover:bg-indigo-600 hover:text-white text-gray-700 rounded-lg transition-all duration-300 font-medium text-sm">
                        {{ $brand }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section - Gọn gàng hơn -->
    <section id="categories" class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Danh mục sản phẩm</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Khám phá các danh mục sản phẩm đa dạng của chúng tôi</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse($categories as $category)
                    <a href="#" class="group bg-white rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-indigo-200">
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
                        <h3 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition text-sm">{{ $category->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $category->products->count() }} sản phẩm</p>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-8">Chưa có danh mục nào</p>
                @endforelse
        </div>
    </div>
    </section>

    <!-- Featured Products Section - Layout đẹp hơn -->
    <section id="products" class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Sản phẩm nổi bật</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Những sản phẩm được nhiều khách hàng yêu thích và đánh giá cao</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                        <a href="#" class="block">
                            <div class="relative h-56 bg-gray-50 overflow-hidden">
                                @if($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" 
                                         alt="{{ $product->name }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400">Chưa có ảnh</span>
                                    </div>
                                @endif
                                
                                <div class="absolute top-3 left-3 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                    Hot
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <div class="mb-1">
                                    <span class="text-xs text-gray-500">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                                </div>
                                <h3 class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3rem]">
                                    {{ $product->name }}
                                </h3>
                                
                                @if($product->specifications && isset($product->specifications['RAM']))
                                    <p class="text-xs text-gray-600 mb-2">{{ $product->specifications['RAM'] }}</p>
                                @endif
                                
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <p class="text-lg font-bold text-indigo-600">
                                            {{ number_format($product->price, 0, ',', '.') }} đ
                                        </p>
                                    </div>
                                    <div class="flex items-center text-yellow-400">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="ml-1 text-xs text-gray-600">4.8</span>
                                    </div>
                                </div>
                                
                                @if($product->stock_quantity > 0)
                                    <p class="text-xs text-green-600 mb-2">✓ Còn hàng</p>
                                @else
                                    <p class="text-xs text-red-600 mb-2">✗ Hết hàng</p>
                                @endif
                                
                                <button class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                    Thêm vào giỏ
                                </button>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Chưa có sản phẩm nào</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
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
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                        <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $mainCategory->name }}</h3>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($mainCategory->products->take(6) as $product)
                                    <a href="#" class="group bg-white rounded-lg p-3 hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-indigo-300">
                                        <div class="relative h-32 mb-2 bg-gray-50 rounded overflow-hidden">
                                            @if($product->images->first())
                                                <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" 
                                                     alt="{{ $product->name }}"
                                                     loading="lazy"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                    <span class="text-gray-400 text-xs">Chưa có ảnh</span>
                                                </div>
                                            @endif
                                        </div>
                                        <h4 class="text-xs font-semibold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 mb-1">
                                            {{ $product->name }}
                                        </h4>
                                        <p class="text-xs font-bold text-indigo-600">
                                            {{ number_format($product->price, 0, ',', '.') }} đ
                                        </p>
                                    </a>
                                @endforeach
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-700 font-semibold text-sm">
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
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Sản phẩm bán chạy</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Những sản phẩm được khách hàng yêu thích và mua nhiều nhất</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($bestSellers->take(8) as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                        <a href="#" class="block">
                            <div class="relative h-56 bg-gray-50 overflow-hidden">
                                @if($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" 
                                         alt="{{ $product->name }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400">Chưa có ảnh</span>
                                    </div>
                                @endif
                                
                                <div class="absolute top-3 left-3 bg-orange-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                    Bán chạy
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <span class="text-xs text-gray-500">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                                <h3 class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3rem]">
                                    {{ $product->name }}
                                </h3>
                                
                                <div class="flex items-center justify-between mb-2">
                                    <p class="text-lg font-bold text-indigo-600">
                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                    </p>
                                    <div class="flex items-center text-yellow-400">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="ml-1 text-xs text-gray-600">4.9</span>
                                    </div>
                                </div>
                                
                                <button class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                    Thêm vào giỏ
                                </button>
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
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả sản phẩm bán chạy
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Hot Deals Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Deal sốc hôm nay</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Những ưu đãi đặc biệt không thể bỏ qua</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($hotDeals->take(6) as $product)
                    <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border-2 border-red-200 group relative">
                        <div class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold z-10">
                            -20%
                        </div>
                        <a href="#" class="block">
                            <div class="relative h-64 bg-gray-50 overflow-hidden">
                                @if($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" 
                                         alt="{{ $product->name }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400">Chưa có ảnh</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-5">
                                <span class="text-xs text-gray-600">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-red-600 transition">
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
                                
                                <button class="w-full bg-red-600 text-white py-2.5 rounded-lg hover:bg-red-700 transition text-sm font-medium">
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
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả deal sốc
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Used Products Section -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">HÀNG CŨ</h2>
                    <p class="text-gray-600">Sản phẩm đã qua sử dụng với giá tốt</p>
                </div>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả <span>→</span>
                </a>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($usedProducts->take(12) as $product)
                        <a href="#" class="group text-center p-4 rounded-lg hover:bg-gray-50 transition-all duration-300 border border-gray-100 hover:border-indigo-200">
                            <div class="relative h-32 mb-3 bg-gray-50 rounded overflow-hidden mx-auto">
                                @if($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" 
                                         alt="{{ $product->name }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400 text-xs">Chưa có ảnh</span>
                                    </div>
                                @endif
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600 transition line-clamp-2 mb-1">
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

    <!-- Why Choose Us Section -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Tại sao chọn chúng tôi?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Những lý do khiến khách hàng tin tưởng và lựa chọn chúng tôi</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Chất lượng đảm bảo</h3>
                    <p class="text-sm text-gray-600">100% sản phẩm chính hãng, có bảo hành</p>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Giá cả hợp lý</h3>
                    <p class="text-sm text-gray-600">Giá tốt nhất thị trường, nhiều ưu đãi</p>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Giao hàng nhanh</h3>
                    <p class="text-sm text-gray-600">Miễn phí vận chuyển cho đơn hàng lớn</p>
                </div>
                <div class="bg-white rounded-lg p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Bảo hành uy tín</h3>
                    <p class="text-sm text-gray-600">Chế độ bảo hành tốt, hỗ trợ tận tâm</p>
                </div>
            </div>
        </div>
    </section>

    <!-- New Products Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Sản phẩm mới nhất</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Cập nhật những sản phẩm công nghệ mới nhất trên thị trường</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($newProducts->take(8) as $product)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                        <a href="#" class="block">
                            <div class="relative h-56 bg-gray-50 overflow-hidden">
                                @if($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" 
                                         alt="{{ $product->name }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <span class="text-gray-400">Chưa có ảnh</span>
                                    </div>
                                @endif
                                
                                <div class="absolute top-3 left-3 bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                    Mới
                    </div>
                </div>
                
                            <div class="p-4">
                                <span class="text-xs text-gray-500">{{ $product->category->name ?? 'Chưa phân loại' }}</span>
                                <h3 class="text-base font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition min-h-[3rem]">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-lg font-bold text-indigo-600 mb-3">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </p>
                                <button class="w-full bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-indigo-600 hover:text-white transition text-sm font-medium">
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
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                    Xem tất cả sản phẩm mới
                    <span>→</span>
                </a>
                </div>
        </div>
    </section>

    <!-- Video Reviews Section - Giống CellphoneS -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">REVIEW SẢN PHẨM</h2>
                <a href="https://www.youtube.com" target="_blank" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold whitespace-nowrap text-lg">
                    Xem YouTube <span>→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($videoReviews->take(4) as $index => $product)
                    <div class="bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 group">
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
                                <iframe 
                                    class="w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&loop=1&playlist={{ $videoId }}&mute=1&controls=0&modestbranding=1&rel=0&playsinline=1"
                                    frameborder="0"
                                    allow="autoplay; encrypted-media; accelerometer; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    loading="lazy"
                                ></iframe>
                                
                                <!-- Fallback: Nếu không có YouTube, dùng ảnh với animation -->
                                @if($product->images->first())
                                    <div class="absolute inset-0 hidden fallback-video">
                                        <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" 
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover animate-pulse">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Video Info -->
                        <div class="p-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2 min-h-[2.5rem] group-hover:text-indigo-600 transition">
                                {{ $product->name }} - Review chi tiết | DATN Store
                            </h3>
                            
                            <!-- Channel Info -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 bg-red-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">S</span>
                                    </div>
                                    <span class="text-xs text-gray-600 font-medium">DATN Store</span>
                                </div>
                                <button class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-full hover:bg-red-700 transition">
                                    Đăng ký
                                </button>
                            </div>
                        </div>

                        <!-- Product Info Below -->
                        <div class="px-4 pb-4 pt-0 border-t border-gray-100">
                            <div class="flex items-center gap-3 mt-3">
                                @if($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image_url) }}" 
                                         alt="{{ $product->name }}"
                                         class="w-16 h-16 object-cover rounded border border-gray-200"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/64x64/f3f4f6/9ca3af?text=No+Image';">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded border border-gray-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
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

    <!-- Newsletter Section - Đơn giản hơn -->
    <section class="bg-indigo-600 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-2xl font-bold mb-3">Đăng ký nhận tin</h2>
                <p class="text-indigo-100 mb-6">Nhận thông tin về sản phẩm mới và các chương trình khuyến mãi đặc biệt</p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input 
                        type="email" 
                        placeholder="Nhập email của bạn..." 
                        class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-white"
                        required
                    >
                    <button 
                        type="submit" 
                        class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition whitespace-nowrap"
                    >
                        Đăng ký
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Floating Action Buttons - Nhẹ nhàng, chuyên nghiệp -->
    <div class="fixed bottom-4 right-4 md:bottom-6 md:right-6 z-50 flex flex-col gap-3">
        <!-- Scroll to Top Button -->
        <button 
            id="scrollToTop" 
            class="hidden bg-indigo-600 text-white p-3 md:p-3.5 rounded-full shadow-lg hover:bg-indigo-700 transition-all duration-300 hover:shadow-xl hover:scale-110 active:scale-95 group animate-float-delay-1"
            aria-label="Lên đầu trang"
            title="Lên đầu trang"
        >
            <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>

        <!-- Contact/Phone Button -->
        <a 
            id="contactButton"
            href="tel:19001234"
            class="bg-green-600 text-white p-3 md:p-3.5 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 hover:shadow-xl hover:scale-110 active:scale-95 group animate-float-gentle"
            aria-label="Gọi điện liên hệ"
            title="Liên hệ: 1900 1234"
        >
            <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
        </a>

        <!-- Chat/Support Button -->
        <button 
            id="chatButton"
            class="bg-indigo-500 text-white p-3 md:p-3.5 rounded-full shadow-lg hover:bg-indigo-600 transition-all duration-300 hover:shadow-xl hover:scale-110 active:scale-95 group animate-float-delay-2"
            aria-label="Hỗ trợ trực tuyến"
            title="Hỗ trợ trực tuyến"
            onclick="window.location.href='#contact'"
        >
            <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
        </button>
    </div>

    <!-- Floating Notification Banner - Nhẹ nhàng, có thể đóng -->
    <div id="appBanner" class="fixed bottom-24 left-4 md:left-6 z-40 hidden md:block animate-fade-in animate-bounce-gentle">
        <div class="bg-white rounded-lg shadow-xl p-4 max-w-xs border border-gray-200 hover:shadow-2xl transition-shadow">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900 text-sm mb-1">Tải ứng dụng</h3>
                    <p class="text-xs text-gray-600 mb-2">Nhận ưu đãi đặc biệt khi mua hàng trên app</p>
                    <a href="#" class="text-xs text-indigo-600 hover:text-indigo-700 font-medium inline-flex items-center gap-1">
                        Tìm hiểu thêm 
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                <button 
                    onclick="document.getElementById('appBanner').style.display='none'"
                    class="text-gray-400 hover:text-gray-600 transition p-1"
                    aria-label="Đóng"
                    title="Đóng"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                </div>
        </div>
    </div>

    <!-- JavaScript for Floating Buttons -->
    <script>
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
            button.addEventListener('mouseenter', function() {
                this.style.animationPlayState = 'paused';
            });
            button.addEventListener('mouseleave', function() {
                this.style.animationPlayState = 'running';
            });
        });

        // Auto-hide app banner after 10 seconds (optional)
        setTimeout(() => {
            const banner = document.getElementById('appBanner');
            if (banner) {
                banner.style.opacity = '0';
                banner.style.transition = 'opacity 0.5s';
                setTimeout(() => {
                    banner.style.display = 'none';
                }, 500);
            }
        }, 10000); // Hide after 10 seconds
    </script>
</x-main-layout>
