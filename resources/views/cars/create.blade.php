<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Post a New Car for Sale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                        <div class="font-medium text-red-800">
                            {{ __('Whoops! There were some problems with your input.') }}
                        </div>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="make" :value="__('Car Make (e.g. Toyota, Honda)')" />
                        <x-text-input id="make" class="block mt-2 w-full" type="text" name="make" :value="old('make')" required autofocus />
                        <x-input-error :messages="$errors->get('make')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="model" :value="__('Model (e.g. Camry, Civic)')" />
                        <x-text-input id="model" class="block mt-2 w-full" type="text" name="model" :value="old('model')" required />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="registration_year" :value="__('Registration Year')" />
                            <x-text-input id="registration_year" class="block mt-2 w-full" type="number" name="registration_year" :value="old('registration_year')" required />
                            <x-input-error :messages="$errors->get('registration_year')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price ($)')" />
                            <x-text-input id="price" class="block mt-2 w-full" type="number" step="0.01" name="price" :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description"
                                  name="description"
                                  rows="5"
                                  class="block mt-2 w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                                  placeholder="Describe the car's condition, service history, features, etc.">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Car Image')" />
                        <input id="image" class="block mt-2 w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" type="file" name="image" accept="image/*" required />
                        <p class="text-xs text-slate-500 mt-1">Accepted formats: JPEG, PNG (Max 2MB)</p>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end pt-6 border-t border-slate-200">
                        <x-primary-button>
                            {{ __('List Car for Sale') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
