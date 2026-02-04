<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABC-CARS | Premium Used Car Portal</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-900">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 tracking-tight">
                        ABC-CARS
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('cars.index') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Marketplace</a>
                    <a href="{{ route('about') }}" class="text-slate-600 hover:text-indigo-600 font-medium">About Us</a>
                    <a href="{{ route('contact') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Contact</a>

                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4 ml-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>


    <div class="relative bg-indigo-900 py-24 sm:py-32">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900 to-indigo-700 opacity-90"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-6xl">
                The Trusted Way to Buy & Sell Used Cars
            </h1>
            <p class="mt-6 text-lg leading-8 text-indigo-100 max-w-2xl mx-auto">
                Find the perfect vehicle, submit competitive bids, and book test drives directly through our secure portal.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('cars.index') }}" class="rounded-md bg-white px-6 py-3 text-lg font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                    Browse Marketplace
                </a>
                <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-white hover:text-indigo-200">
                    Join as a Seller <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>

    <div class="py-24 bg-white sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600 uppercase tracking-wide">Quality Service</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Everything you need for a smooth transaction</p>
            </div>

            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-lg font-semibold leading-7 text-slate-900">
                            <span class="text-indigo-600 text-2xl">🚗</span> Verified Listings
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-600">
                            <p class="flex-auto">Browse cars with high-quality images and full registration details. All listings are moderated by our admin team.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-lg font-semibold leading-7 text-slate-900">
                            <span class="text-indigo-600 text-2xl">💰</span> Real-Time Bidding
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-600">
                            <p class="flex-auto">Submit bidding prices on the cars you love. Our transparent system helps you get the best deal possible.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-lg font-semibold leading-7 text-slate-900">
                            <span class="text-indigo-600 text-2xl">📅</span> Easy Appointments
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-600">
                            <p class="flex-auto">Schedule test drives and inspections directly with the seller at a time that suits you both.</p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <footer class="bg-slate-50 border-t border-slate-200 py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center text-slate-500 text-sm">
            <p>&copy; {{ date('Y') }} ABC-CARS Used Car Portal. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
