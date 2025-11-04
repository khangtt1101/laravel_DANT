<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-bold text-indigo-600">
                    DATN E-Store
                </a>
            </div>

            <nav class="hidden md:flex md:space-x-8">
                <a href="/" class="font-medium text-gray-500 hover:text-gray-900">Trang chủ</a>
                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Giới thiệu</a>
                <a href="{{ route('shop.index') }}" class="font-medium text-gray-500 hover:text-gray-900">Sản phẩm</a>
                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Liên hệ</a>
            </nav>

            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('cart.index') }}" class="relative text-gray-500 hover:text-gray-900">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if(isset($cartCount) && $cartCount > 0)
                        <span
                            class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Tài
                        khoản</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Đăng
                        nhập</a>
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm font-medium text-indigo-600 hover:text-indigo-500">Đăng ký</a>
                @endauth
            </div>

            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="text-gray-500 hover:text-gray-900 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                        <path :class="{'inline-flex': mobileMenuOpen, 'hidden': !mobileMenuOpen }"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden" x-transition>
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Trang
                chủ</a>
            <a href="{{ route('shop.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Sản phẩm</a>
            <a href="{{ route('shop.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Danh mục</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Liên
                hệ</a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="px-2 space-y-1">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Tài
                        khoản</a>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Đăng
                        nhập</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-50">Đăng ký</a>
                @endauth
            </div>
        </div>
    </div>
</header>
<nav class="bg-white text-black shadow-lg">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-12 space-x-6 justify-center flex-wrap">

            @if(isset($allCategories))
                @foreach($allCategories as $category)
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-300 transition duration-150">
                        {{ $category->name }}
                    </a>
                @endforeach
            @else
                <p class="text-sm">Không thể tải danh mục...</p>
            @endif

        </div>
    </div>
</nav>