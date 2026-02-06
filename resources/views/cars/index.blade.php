<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Used Car Marketplace') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Filter Section --}}
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 border border-gray-100">
                <form action="{{ route('cars.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Make</label>
                        <input type="text" name="make" value="{{ request('make') }}" placeholder="e.g. Toyota" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" value="{{ request('model') }}" placeholder="e.g. Corolla" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" name="year" value="{{ request('year') }}" placeholder="2024" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    {{-- Min Price Input --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Min Price ($)</label>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    {{-- Max Price Input --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Max Price ($)</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="50000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition font-semibold shadow-sm">
                            Filter Results
                        </button>
                    </div>
                </form>
            </div>

            {{-- Car Listings Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($cars as $car)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->make }}" class="w-full h-48 object-cover">

                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">{{ $car->registration_year }} {{ $car->make }} {{ $car->model }}</h3>

                            {{-- This uses the logic from show.blade to be consistent --}}
                            <p class="text-blue-600 font-bold text-xl mt-2">
                                ${{ number_format($car->bids->max('bid_amount') ?? $car->price, 2) }}
                            </p>

                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-xs text-gray-500 italic">Seller: {{ $car->user?->name ?? 'Unknown' }}</span>
                                <a href="{{ route('cars.show', $car->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded text-sm font-medium hover:bg-black transition-colors">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-3 text-center py-20 bg-white rounded-lg border border-dashed border-gray-300">
                        <p class="text-gray-500 text-lg">No cars found matching your criteria.</p>
                        <a href="{{ route('cars.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold underline mt-2 inline-block">Clear all filters</a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $cars->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
