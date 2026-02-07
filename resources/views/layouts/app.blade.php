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
    <body class="font-sans antialiased bg-slate-50">
        <div class="flex h-screen overflow-hidden">

            @if(request()->routeIs('dashboard*') || request()->routeIs('admin.*') || request()->routeIs('profile.*') || request()->routeIs('cars.create'))
            <aside class="w-64 bg-gray-900 text-white hidden md:flex flex-col flex-shrink-0">
                <div class="p-6 text-xl font-bold border-b border-gray-800 text-blue-400">
                    ABC-CARS Panel
                </div>
                <nav class="flex-1 mt-4 overflow-y-auto">
                    <div class="px-4 py-2 text-xs uppercase text-slate-400 font-semibold tracking-wider">User Menu</div>
                    <a href="{{ route('cars.create') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('cars.create') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                        Post a Car for Sale
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('profile.edit') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                        My Profile
                    </a>

                    @if(Auth::user()->role == 1)
                        <div class="px-4 py-2 mt-6 text-xs uppercase text-slate-400 font-semibold tracking-wider">Admin Menu</div>
                        <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.users') ? 'bg-gray-800 border-l-4 border-red-500' : '' }}">
                            Manage Users
                        </a>
                        <a href="{{ route('admin.cars') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.cars') ? 'bg-gray-800 border-l-4 border-red-500' : '' }}">
                            Moderate Cars
                        </a>
                        <a href="{{ route('admin.appointments') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.appointments') ? 'bg-gray-800 border-l-4 border-red-500' : '' }}">
                            Finalize Transactions
                        </a>
                        <a href="{{ route('admin.inquiries') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.inquiries') ? 'bg-gray-800 border-l-4 border-red-500' : '' }}">
                            Manage Inquiries
                        </a>
                    @endif
                </nav>
            </aside>
            @endif

            <div class="flex-1 flex flex-col overflow-y-auto">
                @include('layouts.navigation')

                <div class="max-w-7xl mx-auto w-full mt-4 px-4 sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                @isset($header)
                    <header class="bg-white shadow-sm border-b">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>

                <footer class="bg-white border-t border-slate-200 py-8 mt-12">
                    <div class="max-w-7xl mx-auto px-4 text-center text-slate-600 text-sm">
                        <p>&copy; {{ date('Y') }} ABC-CARS Used Car Portal. All rights reserved.</p>
                        <div class="mt-3 space-x-6">
                            <a href="{{ route('about') }}" class="hover:text-indigo-600 transition">About Us</a>
                            <span class="text-slate-300">|</span>
                            <a href="{{ route('contact') }}" class="hover:text-indigo-600 transition">Contact Support</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
