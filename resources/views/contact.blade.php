<x-guest-layout>
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-100 my-10">
        <h2 class="text-2xl font-bold mb-2 text-center text-gray-800">Contact Us</h2>
        <p class="text-center text-gray-500 mb-6 text-sm">Have questions about a listing? We're here to help.</p>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf

            {{-- Name Field --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
                       placeholder="Your Name" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Field --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                       placeholder="you@example.com" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Message Field --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" rows="4"
                          class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('message') ? 'border-red-500' : 'border-gray-300' }}"
                          placeholder="How can we help you?" required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-blue-700 transition duration-200 shadow-sm">
                Send Message
            </button>
        </form>
    </div>
</x-guest-layout>
