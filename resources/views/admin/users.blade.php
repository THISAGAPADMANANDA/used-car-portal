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

                @if($users->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-slate-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600">No users found.</p>
                    </div>
                @else
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Name</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Email</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Role</th>
                            <th class="px-5 py-3 border-b-2 border-slate-300 bg-slate-50 text-left text-xs font-semibold text-slate-700 uppercase tracking-wider">Status</th>
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
                                <span class="px-3 py-1 font-semibold leading-tight rounded-full text-xs {{ $user->is_banned ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $user->is_banned ? 'Banned' : 'Active' }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-slate-200 bg-white text-sm space-y-2">
                                @if($user->role !== 1)
                                    <div>
                                        <form action="{{ route('admin.users.promote', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900 font-medium">Promote</button>
                                        </form>
                                    </div>
                                @endif
                                @if($user->is_banned)
                                    <div>
                                        <form action="{{ route('admin.users.unban', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-900 font-medium">Unban</button>
                                        </form>
                                    </div>
                                @else
                                    <div>
                                        <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Are you sure you want to ban this user?')">Ban</button>
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
