<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Notifications') }}
            </h2>
            @if($unreadCount > 0)
                <form action="{{ route('notifications.read-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-blue-600 hover:text-blue-700">
                        Mark all as read
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if($notifications->isEmpty())
                    <div class="p-6 text-center">
                        <div class="text-slate-500 mb-4">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <p class="text-slate-600">No notifications yet.</p>
                    </div>
                @else
                    <div class="divide-y divide-slate-200">
                        @foreach($notifications as $notification)
                            <div class="p-4 hover:bg-slate-50 transition {{ !$notification->read ? 'bg-blue-50' : '' }}">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            @if(!$notification->read)
                                                <span class="inline-block w-2 h-2 bg-blue-600 rounded-full"></span>
                                            @endif
                                            <h3 class="font-semibold text-slate-800">
                                                @switch($notification->type)
                                                    @case('bid_placed')
                                                        New Bid
                                                        @break
                                                    @case('outbid')
                                                        You've Been Outbid
                                                        @break
                                                    @case('appointment_approved')
                                                        Appointment Approved
                                                        @break
                                                    @case('appointment_rejected')
                                                        Appointment Rejected
                                                        @break
                                                    @case('car_sold')
                                                        Car Sold
                                                        @break
                                                    @default
                                                        Notification
                                                @endswitch
                                            </h3>
                                        </div>
                                        <p class="text-slate-700 mb-2">{{ $notification->message }}</p>
                                        <p class="text-xs text-slate-500">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                    @if(!$notification->read)
                                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="ml-4">
                                            @csrf
                                            <button type="submit" class="text-xs text-blue-600 hover:text-blue-700 whitespace-nowrap">
                                                Mark as read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="p-4 border-t">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
