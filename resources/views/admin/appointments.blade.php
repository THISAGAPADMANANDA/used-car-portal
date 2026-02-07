<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Transactions & Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-slate-200">

                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($appointments->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-slate-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600">No transactions or appointments found.</p>
                    </div>
                @else
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Date</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Buyer</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Car Interest</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Bid Amount</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $apt)
                            <tr>
                                <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-slate-700">
                                    {{ $apt->appointment_date }}</td>
                                <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-slate-700">{{ $apt->user->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-slate-900 font-medium">
                                    {{ $apt->car->make }} {{ $apt->car->model }}
                                </td>
                                <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-slate-700 font-semibold">
                                    @if($apt->bid)
                                        ${{ number_format($apt->bid->bid_amount, 2) }}
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                    {{-- Check if the car is sold to indicate a finalized transaction --}}
                                    @if ($apt->car->status === 'sold' && $apt->status === 'approved')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                            Transaction Finalized
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $apt->status === 'approved' ? 'bg-green-100 text-green-800' : ($apt->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($apt->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                    {{-- Always allow approve/reject unless transaction is finalized --}}
                                    @if ($apt->car->status === 'sold' && $apt->status === 'approved')
                                        <span class="text-slate-400 text-xs">Finalized</span>
                                    @else
                                        <div class="space-x-2">
                                            <form action="{{ route('admin.appointments.update', $apt->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button name="status" value="approved" class="text-green-600 hover:text-green-900 font-medium text-sm transition">
                                                    Approve
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.appointments.update', $apt->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button name="status" value="rejected" class="text-red-600 hover:text-red-900 font-medium text-sm transition">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
