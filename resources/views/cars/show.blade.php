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
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>
                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->model }}" class="w-full h-auto rounded-lg shadow-md mb-4">
                    <h3 class="text-lg font-bold text-gray-700">Description</h3>
                    <p class="text-gray-600 mt-2">{{ $car->description ?? 'No description provided.' }}</p>
                </div>

                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <p class="text-sm text-gray-500 uppercase font-semibold">Base Price</p>
                        <p class="text-2xl font-bold text-indigo-600">${{ number_format($car->price, 2) }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-500 uppercase font-semibold">Current Highest Bid</p>
                        <p class="text-3xl font-extrabold text-green-600">${{ number_format($highestBid, 2) }}</p>
                    </div>

                    <div class="p-4 border rounded-lg shadow-sm">
                        <h4 class="font-bold mb-2 text-gray-800">Submit a Bidding Price</h4>
                        <form action="{{ route('bids.store', $car->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="number" name="bid_amount" step="0.01"
                                   class="border-gray-300 rounded-md w-full"
                                   placeholder="Enter amount > ${{ $highestBid }}" required>
                            <x-primary-button>Bid</x-primary-button>
                        </form>
                    </div>

                    <div class="p-4 border rounded-lg shadow-sm bg-indigo-50">
                        <h4 class="font-bold mb-2 text-gray-800">Schedule Test Drive</h4>
                        <form action="{{ route('appointments.store', $car->id) }}" method="POST">
                            @csrf
                            <div class="flex flex-col gap-2">
                                <input type="datetime-local" name="appointment_date"
                                       class="border-gray-300 rounded-md w-full" required>
                                <x-secondary-button type="submit" class="justify-center">
                                    Request Appointment
                                </x-secondary-button>
                            </div>
                        </form>
                    </div>

                    <div class="text-sm text-gray-500 italic">
                        Listed by: {{ $car->user?->name ?? 'Unknown' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
