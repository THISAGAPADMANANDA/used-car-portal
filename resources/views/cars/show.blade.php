<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
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
                    <h3 class="text-lg font-bold text-slate-700">Description</h3>
                    <p class="text-slate-600 mt-2">{{ $car->description ?? 'No description provided.' }}</p>
                </div>

                {{-- Right Column: Pricing and Actions --}}
                <div x-data="{
                    bidPlaced: false,
                    userBids: {!! json_encode(auth()->check() ? auth()->user()->bids()->where('car_id', $car->id)->exists() : false) !!},
                    userBidAmount: {{ auth()->check() ? (auth()->user()->bids()->where('car_id', $car->id)->max('bid_amount') ?? 0) : 0 }},
                    highestBidAmount: {{ $highestBid }}
                }" class="space-y-6">

                    {{-- Dynamic Price Logic --}}
                    <div class="bg-slate-50 p-6 rounded-lg border border-slate-200 shadow-sm">
                        <p class="text-sm text-slate-500 uppercase font-bold tracking-wider">
                            {{ $car->bids->count() > 0 ? 'Current Highest Bid' : 'Bid starting at' }}
                        </p>
                        <p class="text-4xl font-extrabold text-green-600">
                            ${{ number_format($highestBid, 2) }}
                        </p>
                        @if($car->bids->count() > 0)
                            <p class="text-xs text-slate-400 mt-1">Total bids: {{ $car->bids->count() }}</p>
                        @endif
                    </div>

                    @auth
                        {{-- Bidding Form --}}
                        <div class="p-4 border rounded-lg shadow-sm" :class="userBids && userBidAmount >= highestBidAmount ? 'bg-green-50 border-green-200' : 'bg-white'">
                            <h4 class="font-bold mb-2 text-slate-800" :class="{ 'text-green-600': userBids && userBidAmount >= highestBidAmount }">
                                <span x-show="userBids && userBidAmount >= highestBidAmount">✓ You have the highest bid</span>
                                <span x-show="!(userBids && userBidAmount >= highestBidAmount)">Submit a Bid</span>
                            </h4>
                            <form action="{{ route('bids.store', $car->id) }}" method="POST" class="flex gap-2">
                                @csrf
                                <div class="relative flex-1" :class="userBids && userBidAmount >= highestBidAmount ? 'opacity-50' : ''">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500">$</span>
                                    <input type="number" name="bid_amount" step="0.01"
                                           class="pl-7 border-slate-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500"
                                           placeholder="{{ $highestBid + 1 }}"
                                           x-bind:disabled="userBids && userBidAmount >= highestBidAmount" required>
                                </div>
                                <button type="submit"
                                        x-bind:disabled="userBids && userBidAmount >= highestBidAmount"
                                        x-bind:class="userBids && userBidAmount >= highestBidAmount ? 'opacity-50 cursor-not-allowed' : ''"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!(userBids && userBidAmount >= highestBidAmount)">Place Bid</span>
                                    <span x-show="userBids && userBidAmount >= highestBidAmount">Highest Bidder</span>
                                </button>
                            </form>
                            <p class="text-xs text-slate-500 mt-2">Required: Your bid must exceed ${{ number_format($highestBid, 2) }}</p>
                            <p class="text-xs text-amber-600 mt-2" x-show="userBids && userBidAmount < highestBidAmount">
                                ⓘ Someone has placed a higher bid. You can place another bid above the current highest bid.
                            </p>
                        </div>

                        {{-- Test Drive Form (Disabled until bid is placed and user has highest bid) --}}
                        <div class="p-4 border rounded-lg shadow-sm" :class="userBids && userBidAmount >= highestBidAmount ? 'bg-indigo-50 border-indigo-200' : 'bg-slate-50 border-slate-200 opacity-50'">
                            <h4 class="font-bold mb-2 text-slate-800">
                                <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded" x-show="!(userBids && userBidAmount >= highestBidAmount)" style="display: none;">Step 2</span>
                                Schedule Test Drive
                            </h4>
                            <form action="{{ route('appointments.store', $car->id) }}" method="POST">
                                @csrf
                                <div class="flex flex-col gap-2">
                                    <input type="date" name="appointment_date"
                                           class="border-slate-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500"
                                           x-bind:disabled="!(userBids && userBidAmount >= highestBidAmount)" required>
                                    <button type="submit"
                                            x-bind:disabled="!(userBids && userBidAmount >= highestBidAmount)"
                                            x-bind:class="!(userBids && userBidAmount >= highestBidAmount) ? 'opacity-50 cursor-not-allowed' : ''"
                                            class="bg-slate-600 text-white px-4 py-2 rounded-lg hover:bg-slate-700 transition disabled:opacity-50 disabled:cursor-not-allowed text-center">
                                        Request Appointment
                                    </button>
                                </div>
                            </form>
                            <p class="text-xs text-slate-500 mt-2" x-show="!(userBids && userBidAmount >= highestBidAmount)" style="display: none;">
                                ⓘ Place the highest bid first to unlock test drive scheduling
                            </p>
                        </div>
                    @else
                        <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                            <p class="text-slate-700 text-sm">
                                <a href="{{ route('login') }}" class="text-blue-600 underline">Log in</a> or
                                <a href="{{ route('register') }}" class="text-blue-600 underline">register</a>
                                to place a bid and schedule a test drive.
                            </p>
                        </div>
                    @endauth

                    <div class="text-sm text-slate-500 italic border-t pt-4">
                        Listed by: <span class="font-semibold text-slate-700">{{ $car->user?->name ?? 'Unknown' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
