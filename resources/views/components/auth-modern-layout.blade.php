<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Xác thực')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .bg-animated {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark .glass-card {
            background: rgba(31, 41, 55, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Fix spacing issue */
        footer {
            margin-top: 0 !important;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col justify-between bg-animated">

        @include('layouts.partials.header')

        <main class="flex-grow flex items-center justify-center p-6 relative overflow-hidden">
            <!-- Decorative circles -->
            <div
                class="absolute top-20 left-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl animate-float-gentle">
            </div>
            <div
                class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500 opacity-20 rounded-full blur-3xl animate-float-delay-2">
            </div>

            <div class="w-full max-w-md relative z-10">
                {{ $slot }}
            </div>
        </main>

        @include('layouts.partials.footer')
    </div>
</body>

</html>