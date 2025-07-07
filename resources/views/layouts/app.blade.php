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

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="min-h-screen">
        {{-- Navigasi --}}
        @include('layouts.navigation')

        {{-- Header --}}
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Konten Utama --}}
        <main class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- Flash Success --}}
                @if (session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Flash Error --}}
                @if (session('error'))
                    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Slot Konten --}}
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Stack tambahan script --}}
    @stack('scripts')
</body>
</html>
