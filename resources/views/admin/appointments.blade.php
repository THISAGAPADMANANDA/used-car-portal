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

                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Date</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Buyer</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Car Interest</th>
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
                                    {{-- If car is already sold, disable further actions --}}
                                    @if ($apt->car->status === 'sold')
                                        <span class="text-slate-400 text-xs">—</span>
                                    @else
                                        <form action="{{ route('admin.appointments.update', $apt->id) }}" method="POST" class="inline-block space-x-2">
                                            @csrf
                                            @method('PATCH')

                                            @if ($apt->status !== 'approved')
                                                <button name="status" value="approved" class="text-green-600 hover:text-green-900 font-medium text-sm transition">
                                                    Approve
                                                </button>
                                            @endif

                                            @if ($apt->status !== 'rejected')
                                                <button name="status" value="rejected" class="text-red-600 hover:text-red-900 font-medium text-sm transition">
                                                    Reject
                                                </button>
                                            @endif
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
