<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Contact ABC-CARS Support</h2>
        <p class="text-sm text-gray-600">Have questions about a listing or an appointment? We're here to help.</p>
    </div>

    <div class="space-y-6">
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="font-semibold text-blue-700 mb-2">General Inquiries</h3>
            <p class="text-gray-700"><strong>Email:</strong> support@abccars.com</p>
            <p class="text-gray-700"><strong>Phone:</strong> +65 6123 4567</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <h3 class="font-semibold text-blue-700 mb-2">Visit Our Showroom</h3>
            <p class="text-gray-700 leading-relaxed">
                123 Car Marketplace Street,<br>
                Automotive Hub, Singapore 567890
            </p>
        </div>

        <div class="text-center pt-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                Operating Hours: Mon - Fri (9 AM - 6 PM)
            </span>
        </div>
    </div>

    <div class="mt-8 flex items-center justify-center">
        <a href="{{ route('home') }}" class="text-sm text-blue-600 hover:text-blue-900 underline">
            &larr; Back to Homepage
        </a>
    </div>
</x-guest-layout>
