<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-extrabold text-slate-900 mb-2">About ABC CARS</h1>
                <p class="text-slate-600">Learn more about our mission and values</p>
            </div>
        </div>
    </x-slot>
    <div class="py-12 bg-slate-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="text-center mb-12">

                <div class="space-y-8 text-slate-700 leading-relaxed">
                    <section>
                        <h2 class="text-2xl font-bold text-slate-900 border-b-2 border-indigo-500 pb-3 mb-4">Our Mission</h2>
                        <p class="text-base">
                            To provide a seamless automotive marketplace where users can confidently post cars,
                            participate in fair bidding, and schedule test drives with ease.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-bold text-slate-900 border-b-2 border-indigo-500 pb-3 mb-4">Core Features</h2>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-3 font-bold">✓</span>
                                <span><strong>Secure User Registration & Authentication:</strong> Protect your account with industry-standard security.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-3 font-bold">✓</span>
                                <span><strong>Dynamic Car Listings with Image Support:</strong> High-quality images and detailed specifications for every vehicle.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-3 font-bold">✓</span>
                                <span><strong>Real-time Bidding Price Submission:</strong> Transparent bidding system to ensure fair market prices.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-indigo-600 mr-3 font-bold">✓</span>
                                <span><strong>Admin-moderated Appointments & Sales:</strong> Safe and verified transactions for all parties.</span>
                            </li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-bold text-slate-900 border-b-2 border-indigo-500 pb-3 mb-4">Why Choose ABC-CARS?</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                            <div class="p-4 border border-indigo-100 rounded-lg bg-indigo-50">
                                <div class="text-3xl mb-2">🛡️</div>
                                <h3 class="font-semibold text-slate-900 mb-2">Safe & Verified</h3>
                                <p class="text-sm text-slate-600">All listings are reviewed and verified by our admin team.</p>
                            </div>
                            <div class="p-4 border border-indigo-100 rounded-lg bg-indigo-50">
                                <div class="text-3xl mb-2">💰</div>
                                <h3 class="font-semibold text-slate-900 mb-2">Transparent Pricing</h3>
                                <p class="text-sm text-slate-600">Fair bidding ensures you get the best possible deal.</p>
                            </div>
                            <div class="p-4 border border-indigo-100 rounded-lg bg-indigo-50">
                                <div class="text-3xl mb-2">⏱️</div>
                                <h3 class="font-semibold text-slate-900 mb-2">Easy & Quick</h3>
                                <p class="text-sm text-slate-600">Simple process from browsing to scheduling test drives.</p>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('cars.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white text-base hover:bg-indigo-700 transition duration-200">
                        Browse Marketplace
                        <span class="ml-2">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
