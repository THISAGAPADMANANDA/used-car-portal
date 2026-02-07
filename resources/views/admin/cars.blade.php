<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Car Moderation') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-slate-200">

                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Car Details</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Seller</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                        <tr>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <div class="font-bold text-slate-900">{{ $car->make }} {{ $car->model }}</div>
                                <div class="text-slate-500 text-xs">{{ $car->registration_year }} - ${{ number_format($car->price) }}</div>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-slate-700">{{ $car->user?->name ?? 'Unknown' }}</td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $car->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($car->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="text-sm border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="active" {{ $car->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="deactivated" {{ $car->status == 'deactivated' ? 'selected' : '' }}>Deactivate</option>
                                        <option value="sold" {{ $car->status == 'sold' ? 'selected' : '' }}>Sold</option>
                                    </select>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg text-xs transition">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
