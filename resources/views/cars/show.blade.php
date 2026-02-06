<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $car->make }} {{ $car->model }} ({{ $car->registration_year }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Left Column: Image and Description --}}
                <div>
                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->model }}" class="w-full h-auto rounded-lg shadow-md mb-4">
                    <h3 class="text-lg font-bold text-gray-700">Description</h3>
                    <p class="text-gray-600 mt-2">{{ $car->description ?? 'No description provided.' }}</p>
                </div>

                {{-- Right Column: Pricing and Actions --}}
                <div class="space-y-6">

                    {{-- Dynamic Price Logic --}}
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 shadow-sm">
                        <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">
                            {{ $car->bids->count() > 0 ? 'Current Highest Bid' : 'Bid starting at' }}
                        </p>
                        <p class="text-4xl font-extrabold text-green-600">
                            ${{ number_format($highestBid, 2) }}
                        </p>
                        @if($car->bids->count() > 0)
                            <p class="text-xs text-gray-400 mt-1">Total bids: {{ $car->bids->count() }}</p>
                        @endif
                    </div>

                    {{-- Bidding Form --}}
                    <div class="p-4 border rounded-lg shadow-sm">
                        <h4 class="font-bold mb-2 text-gray-800">Submit a Bid</h4>
                        <form action="{{ route('bids.store', $car->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            <div class="relative flex-1">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                                <input type="number" name="bid_amount" step="0.01"
                                       class="pl-7 border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="{{ $highestBid + 1 }}" required>
                            </div>
                            <x-primary-button>Place Bid</x-primary-button>
                        </form>
                    </div>

                    {{-- Test Drive Form --}}
                    <div class="p-4 border rounded-lg shadow-sm bg-indigo-50 border-indigo-100">
                        <h4 class="font-bold mb-2 text-gray-800">Schedule Test Drive</h4>
                        <form action="{{ route('appointments.store', $car->id) }}" method="POST">
                            @csrf
                            <div class="flex flex-col gap-2">
                                <input type="datetime-local" name="appointment_date"
                                       class="border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required>
                                <x-secondary-button type="submit" class="justify-center">
                                    Request Appointment
                                </x-secondary-button>
                            </div>
                        </form>
                    </div>

                    <div class="text-sm text-gray-500 italic border-t pt-4">
                        Listed by: <span class="font-semibold text-gray-700">{{ $car->user?->name ?? 'Unknown' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
