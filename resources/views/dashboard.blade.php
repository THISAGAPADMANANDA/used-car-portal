<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @if(Auth::user()->role === 1)
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm text-slate-500">Total Users</div>
                        <div class="text-2xl font-semibold text-slate-800">{{ \App\Models\User::count() }}</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm text-slate-500">Total Listings</div>
                        <div class="text-2xl font-semibold text-slate-800">{{ \App\Models\Car::count() }}</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm text-slate-500">Total Appointments</div>
                        <div class="text-2xl font-semibold text-slate-800">{{ \App\Models\Appointment::count() }}</div>
                    </div>
                @else
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm text-slate-500">My Listings</div>
                        <div class="text-2xl font-semibold text-slate-800">{{ Auth::user()->cars->count() }}</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm text-slate-500">My Bids</div>
                        <div class="text-2xl font-semibold text-slate-800">{{ Auth::user()->bids->count() }}</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="text-sm text-slate-500">Upcoming Appointments</div>
                        <div class="text-2xl font-semibold text-slate-800">{{ Auth::user()->appointments->where('status','pending')->count() }}</div>
                    </div>
                @endif
            </div>

            @if(Auth::user()->role !== 1)
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <!-- User Menu Sidebar -->
                    <aside class="lg:col-span-1">
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
