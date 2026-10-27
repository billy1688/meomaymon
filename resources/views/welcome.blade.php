<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white text-gray-900">

    <div class="min-h-screen flex flex-col justify-center items-center px-4">

        {{-- Logo / Tên hệ thống --}}
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                {{ config('app.name', 'Hệ thống nội bộ') }}
            </h1>
            <p class="mt-2 text-gray-500 text-sm">
                Hệ thống quản lý nội bộ
            </p>
        </div>

        {{-- Nút chức năng --}}
        <div class="flex flex-col sm:flex-row gap-4">
            @auth
                {{-- Đã đăng nhập --}}
                <a href="{{ route('dashboard') }}"
                   class="px-8 py-3 bg-gray-900 text-white rounded-lg font-medium hover:bg-gray-800 transition">
                    Vào Dashboard
                </a>
            @else
                {{-- Chưa đăng nhập --}}
                <a href="{{ route('login') }}"
                   class="px-8 py-3 bg-gray-900 text-white rounded-lg font-medium hover:bg-gray-800 transition">
                    Đăng nhập
                </a>

                <a href="{{ route('register') }}"
                   class="px-8 py-3 bg-white text-gray-900 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">
                    Tạo tài khoản
                </a>
            @endauth
        </div>

        {{-- Footer nhỏ --}}
        <div class="mt-16 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>

</body>
</html>
