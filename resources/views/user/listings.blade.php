<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('My Listings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-semibold text-lg text-slate-800">My Listings</h3>
                    <a href="{{ route('cars.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Post a Car
                    </a>
                </div>

                @if(Auth::user()->cars->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-slate-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600 mb-4">You have no listings yet.</p>
                        <a href="{{ route('cars.create') }}" class="text-indigo-600 underline">Post your first car</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(Auth::user()->cars as $car)
                            <div class="border border-slate-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                                <div class="aspect-video bg-slate-200 overflow-hidden">
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->model }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <h4 class="font-semibold text-slate-800 mb-1">{{ $car->make }} {{ $car->model }}</h4>
                                    <p class="text-sm text-slate-500 mb-3">{{ $car->registration_year }} • ${{ number_format($car->price, 2) }}</p>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $car->status === 'active' ? 'bg-green-100 text-green-800' : ($car->status === 'deactivated' ? 'bg-slate-100 text-slate-800' : 'bg-blue-100 text-blue-800') }}">
                                            {{ ucfirst($car->status) }}
                                        </span>
                                        <span class="text-xs text-slate-500">{{ $car->bids->count() }} bid{{ $car->bids->count() !== 1 ? 's' : '' }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('cars.show', $car) }}" class="flex-1 text-center text-sm text-blue-600 hover:bg-blue-50 py-2 rounded transition">
                                            View
                                        </a>
                                        @if($car->status === 'active')
                                            <form action="{{ route('cars.deactivate', $car) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="w-full text-center text-sm text-red-600 hover:bg-red-50 py-2 rounded transition">
                                                    Deactivate
                                                </button>
                                            </form>
                                        @elseif($car->status === 'deactivated')
                                            <form action="{{ route('cars.reactivate', $car) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="w-full text-center text-sm text-green-600 hover:bg-green-50 py-2 rounded transition">
                                                    Reactivate
                                                </button>
                                            </form>
                                        @endif
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
