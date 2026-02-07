<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 mb-2">Contact Us</h1>
                <p class="text-slate-600">Have questions? We're here to help</p>
            </div>
        </div>
    </x-slot>
    <div class="py-12 bg-slate-50">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="text-center mb-8">

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Name Field --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Your Name</label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('name') ? 'border-red-500' : 'border-slate-300' }}"
                               placeholder="John Doe"
                               required>
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('email') ? 'border-red-500' : 'border-slate-300' }}"
                               placeholder="you@example.com"
                               required>
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subject Field --}}
                    <div>
                        <label for="subject" class="block text-sm font-semibold text-slate-700 mb-2">Subject</label>
                        <input type="text"
                               id="subject"
                               name="subject"
                               value="{{ old('subject') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('subject') ? 'border-red-500' : 'border-slate-300' }}"
                               placeholder="Subject of your inquiry"
                               required>
                        @error('subject')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Message Field --}}
                    <div>
                        <label for="message" class="block text-sm font-semibold text-slate-700 mb-2">Message</label>
                        <textarea id="message"
                                  name="message"
                                  rows="5"
                                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent {{ $errors->has('message') ? 'border-red-500' : 'border-slate-300' }}"
                                  placeholder="Tell us what you'd like to know..."
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Send Message
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-slate-200">
                    <p class="text-center text-slate-600 text-sm">
                        You can also reach us at <strong>support@abc-cars.com</strong> or call <strong>1-800-ABC-CARS</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
