<x-guest-layout>
    <div class="text-center">
        <h1 class="text-3xl font-bold text-blue-700 mb-6">About ABC-CARS</h1>
    </div>

    <div class="space-y-4 text-gray-700 leading-relaxed">
        <p>
            Welcome to <strong>ABC-CARS</strong>, your trusted digital portal for high-quality used vehicles.
            Our platform is designed to bridge the gap between sellers and buyers through a transparent and secure bidding system.
        </p>

        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-blue-100 pb-1">Our Mission</h2>
        <p>
            To provide a seamless automotive marketplace where users can confidently post cars,
            participate in fair bidding, and schedule test drives with ease.
        </p>

        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-blue-100 pb-1">Core Features</h2>
        <ul class="list-disc list-inside space-y-2 text-sm">
            <li>Secure User Registration & Authentication</li>
            <li>Dynamic Car Listings with Image Support</li>
            <li>Real-time Bidding Price Submission</li>
            <li>Admin-moderated Appointments & Sales</li>
        </ul>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Browse Marketplace
        </a>
    </div>
</x-guest-layout>
