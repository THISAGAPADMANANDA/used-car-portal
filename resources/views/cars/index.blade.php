<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Used Car Marketplace') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <form action="{{ route('cars.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Make</label>
                        <input type="text" name="make" value="{{ request('make') }}" placeholder="e.g. Toyota" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" value="{{ request('model') }}" placeholder="e.g. Corolla" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" name="year" value="{{ request('year') }}" placeholder="2024" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Price Max ($)</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="50000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Filter Results
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($cars as $car)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->make }}" class="w-full h-48 object-cover">

                        <div class="p-6">
                            <h3 class="text-lg font-bold">{{ $car->registration_year }} {{ $car->make }} {{ $car->model }}</h3>
                            <p class="text-blue-600 font-semibold text-xl mt-2">${{ number_format($car->price, 2) }}</p>

                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500 italic">Seller: {{ $car->user->name }}</span>
                                <a href="{{ route('cars.show', $car->id) }}" class="bg-gray-800 text-white px-3 py-1 rounded text-sm hover:bg-black">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">No cars found matching your criteria.</p>
                        <a href="{{ route('cars.index') }}" class="text-blue-600 underline">Clear all filters</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $cars->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
