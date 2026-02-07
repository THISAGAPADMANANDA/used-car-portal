<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Cars I\'ve Sold') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-slate-800 mb-6">Cars I've Sold</h3>

                @php
                    // Get cars the user sold (cars they posted that are marked as sold)
                    $soldCars = Auth::user()->cars()
                        ->where('status', 'sold')
                        ->latest()
                        ->get();
                @endphp

                @if($soldCars->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-slate-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600 mb-4">You haven't sold any cars yet.</p>
                        <a href="{{ route('user.listings') }}" class="text-indigo-600 underline">View your listings</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($soldCars as $car)
                            <div class="border border-slate-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                                <div class="aspect-video bg-slate-200 overflow-hidden">
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->model }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <h4 class="font-semibold text-slate-800 mb-1">{{ $car->make }} {{ $car->model }}</h4>
                                    <p class="text-sm text-slate-500 mb-3">{{ $car->registration_year }} • ${{ number_format($car->price, 2) }}</p>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Sold
                                        </span>
                                        <span class="text-xs text-slate-500">{{ $car->bids->count() }} bid{{ $car->bids->count() !== 1 ? 's' : '' }}</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('cars.show', $car) }}" class="block text-center text-sm text-blue-600 hover:bg-blue-50 py-2 rounded transition">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
