<header class="bg-white shadow-md sticky top-0 z-50">
    <!-- Top Bar -->
    <div class="bg-indigo-600 text-white py-2 text-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <span>📞 Hotline: 1900 1234</span>
                    <span class="hidden sm:inline">|</span>
                    <span class="hidden sm:inline">🚚 Miễn phí vận chuyển đơn hàng trên 500k</span>
                </div>
                <div class="hidden md:flex items-center gap-4">
                    <a href="#" class="hover:text-indigo-200 transition">Hỗ trợ</a>
                    <span>|</span>
                    <a href="#" class="hover:text-indigo-200 transition">Theo dõi đơn hàng</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 gap-4">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center">
                    <span class="text-2xl font-bold text-indigo-600">
                        DATN Store
                    </span>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 max-w-2xl mx-4 hidden md:block">
                <form action="#" method="GET" class="relative">
                    <input 
                        type="text" 
                        name="search"
                        placeholder="Tìm kiếm sản phẩm..." 
                        class="w-full px-4 py-2.5 pl-10 pr-24 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                    >
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <button type="submit" class="absolute right-1.5 top-1/2 transform -translate-y-1/2 bg-indigo-600 text-white px-5 py-1.5 rounded-md hover:bg-indigo-700 transition text-sm">
                        Tìm kiếm
                    </button>
                </form>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-3">
                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-indigo-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">{{ $cartCount }}</span>
                    @else
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">0</span>
                    @endif
                </a>

                <!-- User Account -->
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition flex items-center gap-1.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="hidden lg:inline text-sm font-medium">{{ Auth::user()->name }}</span>
                    </a>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 transition text-sm">Đăng nhập</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 transition text-sm font-medium">Đăng ký</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700 hover:text-indigo-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    <path :class="{'inline-flex': mobileMenuOpen, 'hidden': !mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="bg-indigo-600 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-12">
                <!-- Categories Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 px-5 py-2.5 bg-indigo-700 hover:bg-indigo-800 transition font-medium text-sm rounded-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span>Danh mục</span>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 top-full w-56 bg-white text-gray-900 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 rounded-lg mt-1">
                        <div class="py-2">
                            @php
                                $headerCategories = \App\Models\Category::whereNull('parent_id')->with('children')->get();
                            @endphp
                            @forelse($headerCategories as $category)
                                <a href="#" class="block px-4 py-2.5 hover:bg-indigo-50 hover:text-indigo-600 transition text-sm flex items-center justify-between">
                                    <span>{{ $category->name }}</span>
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @empty
                                <p class="px-4 py-2 text-gray-500 text-sm">Chưa có danh mục</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Main Navigation Links -->
                <div class="hidden lg:flex items-center gap-6">
                    <a href="/" class="hover:text-indigo-200 transition text-sm font-medium">Trang chủ</a>
                    <a href="{{ route('shop.index') }}" class="hover:text-indigo-200 transition text-sm font-medium">Sản phẩm</a>
                    <a href="#" class="hover:text-indigo-200 transition text-sm font-medium">Khuyến mãi</a>
                    <a href="#" class="hover:text-indigo-200 transition text-sm font-medium">Liên hệ</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden bg-white border-t shadow-lg" x-transition>
        <div class="px-4 py-4 space-y-3">
            <!-- Mobile Search -->
                <form action="#" method="GET" class="mb-4">
                <input 
                    type="text" 
                    placeholder="Tìm kiếm..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
            </form>
            
            <a href="/" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Trang chủ</a>
            <a href="{{ route('shop.index') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Sản phẩm</a>
            <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Danh mục</a>
            <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Khuyến mãi</a>
            <a href="#" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Liên hệ</a>
            
            <div class="pt-4 border-t border-gray-200">
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Tài khoản</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">Đăng ký</a>
                @endauth
            </div>
        </div>
    </div>
</header>
