<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('My Bids') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-slate-800 mb-6">My Bids</h3>

                @php $bids = Auth::user()->bids()->with('car')->latest()->get(); @endphp
                @if($bids->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-slate-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600 mb-4">No bids placed yet.</p>
                        <a href="{{ route('cars.index') }}" class="text-indigo-600 underline">Browse marketplace</a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($bids as $bid)
                            @php
                                $highestBid = $bid->car->bids->max('bid_amount');
                                $isHighestBid = $bid->bid_amount == $highestBid;
                            @endphp
                            <div class="border border-slate-200 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <a href="{{ route('cars.show', $bid->car) }}" class="font-semibold text-slate-800 hover:text-indigo-600">
                                            {{ $bid->car->make }} {{ $bid->car->model }} ({{ $bid->car->registration_year }})
                                        </a>
                                        <div class="mt-1 text-sm text-slate-500">
                                            <p>Your bid: <span class="font-semibold text-slate-700">${{ number_format($bid->bid_amount, 2) }}</span></p>
                                            <p>Placed: {{ $bid->created_at->diffForHumans() }}</p>
                                            @if($isHighestBid)
                                                <p class="text-green-600 font-semibold">✓ You have the highest bid</p>
                                            @else
                                                <p class="text-amber-600 font-semibold">Outbid - Current highest: ${{ number_format($highestBid, 2) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <a href="{{ route('cars.show', $bid->car) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm">
                                            View Car
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
