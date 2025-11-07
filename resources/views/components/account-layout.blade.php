<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tài khoản của tôi - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Roboto:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    
    {{-- 
        Chúng ta sẽ dùng layout cha là MainLayout 
        để tự động có Header và Footer của trang chủ
    --}}
    <x-main-layout>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <aside class="md:col-span-1">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <nav class="space-y-2">
                            @php
                                $links = [
                                    'dashboard' => [
                                        'name' => 'Tổng quan',
                                        'route' => route('dashboard'),
                                        'active' => request()->routeIs('dashboard'),
                                    ],
                                    'profile' => [
                                        'name' => 'Thông tin cá nhân',
                                        'route' => route('profile.edit'),
                                        'active' => request()->routeIs('profile.edit'),
                                    ],
                                    'orders' => [
                                        'name' => 'Lịch sử đơn hàng',
                                        'route' => route('account.orders'),
                                        'active' => request()->routeIs('account.orders'),
                                    ],
                                    'support' => [
                                        'name' => 'Góp ý & Hỗ trợ',
                                        'route' => route('account.support'),
                                        'active' => request()->routeIs('account.support'),
                                    ],
                                ];
                            @endphp

                            @foreach ($links as $link)
                                <a href="{{ $link['route'] }}" 
                                   class="flex items-center px-4 py-3 rounded-md text-sm font-medium transition-colors
                                          {{ $link['active']
                                             ? 'bg-indigo-100 text-indigo-700'
                                             : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    {{ $link['name'] }}
                                </a>
                            @endforeach

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"
                                   class="flex items-center w-full px-4 py-3 rounded-md text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                    Đăng xuất
                                </a>
                            </form>
                        </nav>
                    </div>
                </aside>

                <main class="md:col-span-3">
                    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
                        {{ $slot }}
                    </div>
                </main>

            </div>
        </div>
    </x-main-layout>
</body>
</html>