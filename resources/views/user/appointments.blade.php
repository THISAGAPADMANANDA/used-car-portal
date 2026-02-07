<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('My Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-slate-800 mb-6">My Appointments</h3>

                @php $appointments = Auth::user()->appointments()->with('car')->latest()->get(); @endphp
                @if($appointments->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-slate-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600 mb-4">No appointments scheduled.</p>
                        <a href="{{ route('cars.index') }}" class="text-indigo-600 underline">Schedule a test drive</a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($appointments as $appt)
                            <div class="border border-slate-200 rounded-lg p-4 hover:shadow-md transition">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <a href="{{ route('cars.show', $appt->car) }}" class="font-semibold text-slate-800 hover:text-indigo-600">
                                            {{ $appt->car->make }} {{ $appt->car->model }} ({{ $appt->car->registration_year }})
                                        </a>
                                        <div class="mt-2 space-y-1 text-sm text-slate-500">
                                            <p><span class="font-medium">Date:</span> {{ \Carbon\Carbon::parse($appt->appointment_date)->toFormattedDateString() }}</p>
                                            <p><span class="font-medium">Status:</span>
                                                <span class="inline-block px-2 py-1 rounded text-xs font-medium {{ $appt->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($appt->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-slate-100 text-slate-800') }}">
                                                    {{ ucfirst($appt->status) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <a href="{{ route('cars.show', $appt->car) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm">
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
