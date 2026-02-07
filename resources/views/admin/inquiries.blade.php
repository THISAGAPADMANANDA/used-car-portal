<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Customer Inquiries</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($inquiries->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-slate-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5-6l3 3-3 3"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600">No customer inquiries yet.</p>
                    </div>
                @else
                <table class="min-w-full divide-y divide-slate-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-slate-50 text-left text-xs font-medium text-slate-500 uppercase">Date</th>
                            <th class="px-6 py-3 bg-slate-50 text-left text-xs font-medium text-slate-500 uppercase">User</th>
                            <th class="px-6 py-3 bg-slate-50 text-left text-xs font-medium text-slate-500 uppercase">Subject</th>
                            <th class="px-6 py-3 bg-slate-50 text-left text-xs font-medium text-slate-500 uppercase">Message</th>
                            <th class="px-6 py-3 bg-slate-50 text-left text-xs font-medium text-slate-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach($inquiries as $inquiry)
                        <tr>
                            <td class="px-6 py-4 text-sm">{{ $inquiry->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">{{ $inquiry->name }}</div>
                                <div class="text-sm text-slate-500">{{ $inquiry->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $inquiry->subject }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ Str::limit($inquiry->message, 50) }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.inquiries.delete', $inquiry->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
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
