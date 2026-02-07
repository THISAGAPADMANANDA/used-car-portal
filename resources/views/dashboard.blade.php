<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900">
                    @if(Auth::user()->role === 1)
                        Admin Dashboard
                    @else
                        Dashboard
                    @endif
                </h1>
                <p class="text-slate-600 mt-2">
                    @if(Auth::user()->role === 1)
                        Manage users, listings, and transactions
                    @else
                        Welcome back! Manage your listings and bids
                    @endif
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Analytics Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                @if(Auth::user()->role === 1)
                    {{-- Admin Analytics --}}
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg shadow-sm border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-blue-600 font-semibold uppercase">Total Users</p>
                                <p class="text-3xl font-extrabold text-blue-900 mt-2">{{ \App\Models\User::count() }}</p>
                            </div>
                            <div class="text-4xl text-blue-300">👥</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg shadow-sm border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-green-600 font-semibold uppercase">Active Listings</p>
                                <p class="text-3xl font-extrabold text-green-900 mt-2">{{ \App\Models\Car::where('status', 'active')->count() }}</p>
                            </div>
                            <div class="text-4xl text-green-300">🚗</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg shadow-sm border border-purple-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-purple-600 font-semibold uppercase">Pending Appointments</p>
                                <p class="text-3xl font-extrabold text-purple-900 mt-2">{{ \App\Models\Appointment::where('status', 'pending')->count() }}</p>
                            </div>
                            <div class="text-4xl text-purple-300">📅</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-lg shadow-sm border border-amber-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-amber-600 font-semibold uppercase">Total Sold Cars</p>
                                <p class="text-3xl font-extrabold text-amber-900 mt-2">{{ \App\Models\Car::where('status', 'sold')->count() }}</p>
                            </div>
                            <div class="text-4xl text-amber-300">✓</div>
                        </div>
                    </div>
                @else
                    {{-- User Analytics --}}
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg shadow-sm border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-blue-600 font-semibold uppercase">My Listings</p>
                                <p class="text-3xl font-extrabold text-blue-900 mt-2">{{ Auth::user()->cars->count() }}</p>
                            </div>
                            <div class="text-4xl text-blue-300">📝</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg shadow-sm border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-green-600 font-semibold uppercase">Active Bids</p>
                                <p class="text-3xl font-extrabold text-green-900 mt-2">{{ Auth::user()->bids->count() }}</p>
                            </div>
                            <div class="text-4xl text-green-300">💰</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg shadow-sm border border-purple-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-purple-600 font-semibold uppercase">Upcoming Appointments</p>
                                <p class="text-3xl font-extrabold text-purple-900 mt-2">{{ Auth::user()->appointments->where('status','pending')->count() }}</p>
                            </div>
                            <div class="text-4xl text-purple-300">📅</div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-lg shadow-sm border border-amber-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-amber-600 font-semibold uppercase">Cars Sold</p>
                                <p class="text-3xl font-extrabold text-amber-900 mt-2">{{ Auth::user()->cars->where('status', 'sold')->count() }}</p>
                            </div>
                            <div class="text-4xl text-amber-300">✓</div>
                        </div>
                    </div>
                @endif
            </div>

            @if(Auth::user()->role !== 1)
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    {{-- Menu remains the same --}}
                        <div class="bg-white p-6 rounded-lg shadow-sm sticky top-20">
                            <h3 class="font-semibold text-lg text-slate-800 mb-4">User Menu</h3>
                            <nav class="space-y-2">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                    Dashboard
                                </a>
                                <a href="{{ route('user.listings') }}" class="block px-4 py-2 rounded-lg text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition {{ request()->routeIs('user.listings') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                    My Listings
                                </a>
                                <a href="{{ route('user.bids') }}" class="block px-4 py-2 rounded-lg text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition {{ request()->routeIs('user.bids') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                    My Bids
                                </a>
                                <a href="{{ route('user.appointments') }}" class="block px-4 py-2 rounded-lg text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition {{ request()->routeIs('user.appointments') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                    My Appointments
                                </a>
                                <a href="{{ route('cars.create') }}" class="block px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition font-medium mt-4">
                                    Post a Car
                                </a>
                            </nav>
                        </div>
                    </aside>

                    <!-- Main Content -->
                    <div class="lg:col-span-3">
                        <div class="bg-white p-6 rounded-lg shadow-sm">
                            <h3 class="font-semibold text-lg mb-4 text-slate-800">Welcome to your Dashboard</h3>
                            <p class="text-slate-600 mb-4">Use the menu on the left to navigate to your listings, bids, and appointments.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('user.listings') }}" class="p-4 border border-slate-200 rounded-lg hover:border-indigo-600 hover:bg-indigo-50 transition">
                                    <h4 class="font-semibold text-slate-800 mb-2">My Listings</h4>
                                    <p class="text-sm text-slate-600">View and manage your car listings</p>
                                </a>
                                <a href="{{ route('user.bids') }}" class="p-4 border border-slate-200 rounded-lg hover:border-indigo-600 hover:bg-indigo-50 transition">
                                    <h4 class="font-semibold text-slate-800 mb-2">My Bids</h4>
                                    <p class="text-sm text-slate-600">Track your bids on cars</p>
                                </a>
                                <a href="{{ route('user.appointments') }}" class="p-4 border border-slate-200 rounded-lg hover:border-indigo-600 hover:bg-indigo-50 transition">
                                    <h4 class="font-semibold text-slate-800 mb-2">My Appointments</h4>
                                    <p class="text-sm text-slate-600">Manage your test drive appointments</p>
                                </a>
                                <a href="{{ route('cars.index') }}" class="p-4 border border-slate-200 rounded-lg hover:border-indigo-600 hover:bg-indigo-50 transition">
                                    <h4 class="font-semibold text-slate-800 mb-2">Browse Marketplace</h4>
                                    <p class="text-sm text-slate-600">Explore available vehicles</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
