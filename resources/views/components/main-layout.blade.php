<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Cửa hàng điện tử</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-white">
    @php
        // Lấy chỉ các ID sản phẩm từ session cart
        $cartItemIds = array_keys(session('cart', []));
    @endphp
    {{-- Khởi tạo (init) Alpine store với dữ liệu từ PHP --}}
    <div x-data x-init="$store.cart.init({{ json_encode($cartItemIds) }})"></div>
    <div x-data="{ mobileMenuOpen: false }" class="min-h-screen bg-gray-100">

        @include('layouts.partials.header')

        <main>
            {{ $slot }}
        </main>

        @include('layouts.partials.footer')


    </div>
</body>

</html>