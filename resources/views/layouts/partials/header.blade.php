<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-bold text-indigo-600">
                    PolyTech E-Store
                </a>
            </div>

            <nav class="hidden md:flex md:space-x-8">
                <a href="/" class="font-medium text-gray-500 hover:text-gray-900">Trang chủ</a>
                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Giới thiệu</a>
                <a href="{{ route('shop.index') }}" class="font-medium text-gray-500 hover:text-gray-900">Sản phẩm</a>
                <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Liên hệ</a>
            </nav>

            <div class="hidden md:flex items-center space-x-4" x-data="{ cartCount: {{ $cartCount ?? 0 }} }"
                @cart-updated.window="cartCount = $event.detail.cartCount">
                <a href="{{ route('cart.index') }}" class="relative text-gray-500 hover:text-gray-900">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span x-show="cartCount > 0"
                        class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"
                        style="display: none;"> {{-- Thêm style để tránh FOUC --}}
                        <span x-text="cartCount"></span>
                    </span>
                </a>
                @auth
                    <div x-data="{ dropdownOpen: false }" class="relative">

                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none transition duration-150 ease-in-out">
                            <span>{{ Auth::user()->full_name }}</span>
                            <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"
                            style="display: none;"></div>

                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-20 w-48 mt-2 py-1 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                            style="display: none;">

                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Trang Quản Trị
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Tài khoản của tôi
                                </a>
                                {{-- (Bạn có thể thêm link "Đơn hàng của tôi" ở đây sau) --}}
                            @endif

                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Hồ sơ cá nhân
                            </a>

                            <div class="border-t border-gray-100"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                                    Đăng xuất
                                </a>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Đăng
                        nhập</a>
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