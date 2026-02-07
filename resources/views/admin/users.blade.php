<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('User Management') }}
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
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Name</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Email</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Role</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-slate-900">{{ $user->name }}</td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm text-slate-700">{{ $user->email }}</td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                <span class="px-3 py-1 font-semibold leading-tight rounded-full text-xs {{ $user->role == 1 ? 'bg-green-100 text-green-800' : 'bg-slate-100 text-slate-800' }}">
                                    {{ $user->role == 1 ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm">
                                @if($user->role !== 1)
                                    <form action="{{ route('admin.users.promote', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900 font-medium">Promote</button>
                                    </form>
                                @else
                                    <span class="text-slate-400 text-xs">—</span>
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
