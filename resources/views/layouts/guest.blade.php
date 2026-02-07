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
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        @include('layouts.navigation')

        <main class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full sm:max-w-md mx-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </main>

        <footer class="bg-white border-t py-6 mt-8">
            <div class="max-w-7xl mx-auto px-4 text-center text-slate-500 text-sm">
                &copy; {{ date('Y') }} ABC-CARS Used Car Portal.
                <div class="mt-2 space-x-4">
                    <a href="{{ route('about') }}" class="hover:underline">About Us</a>
                    <span>|</span>
                    <a href="{{ route('contact') }}" class="hover:underline">Contact Support</a>
                </div>
            </div>
        </footer>
    </body>
</html>
