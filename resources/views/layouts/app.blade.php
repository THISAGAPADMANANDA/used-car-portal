<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ABC-CARS') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm mb-4" role="alert">
                        <p class="font-bold">Success</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm mb-4" role="alert">
                        <p class="font-bold">Error</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
            </div>

            <main>
                {{ $slot }}
            </main>
        </div>

        <footer class="bg-white border-t mt-12 py-6">
            <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} ABC-CARS Used Car Portal. All rights reserved.
                <div class="mt-2">
                    <a href="{{ route('about') }}" class="hover:underline">About Us</a> |
                    <a href="{{ route('contact') }}" class="hover:underline">Contact Support</a>
                </div>
            </div>
        </footer>
    </body>
</html>
