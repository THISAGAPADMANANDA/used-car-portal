<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-50">
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
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center space-x-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link href="{{ url('/dashboard') }}">
                                        Dashboard
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('profile.edit') }}">
                                        Profile
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 text-start text-sm leading-5 text-slate-700 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 transition duration-150 ease-in-out">
                                            Log Out
                                        </button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('cars.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50">Marketplace</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50">About Us</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50">Contact</a>
        </div>

        <div class="pt-4 pb-1 border-t border-slate-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1 px-4">
                    <a href="{{ route('profile.edit') }}" class="block text-slate-700">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left text-slate-700">Log Out</button>
                    </form>
                </div>
            @else
                <div class="px-4 space-y-1">
                    <a href="{{ route('login') }}" class="block text-slate-700">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block text-slate-700">Register</a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
