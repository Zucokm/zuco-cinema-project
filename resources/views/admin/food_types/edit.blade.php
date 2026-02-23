<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Food Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.food-types.update', $foodType->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Category Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $foodType->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    @if($foodType->imagePath)
                    <div class="mb-4">
                        <x-input-label :value="__('Current Image')" class="mb-2" />
                        <img src="{{ asset('storage/' . $foodType->imagePath) }}" alt="{{ $foodType->name }}" class="w-32 h-32 object-cover rounded-lg border border-gray-200 shadow-sm">
                    </div>
                    @endif

                    <div class="mb-6">
                        <x-input-label for="imagePath" :value="__('Replace Image (Leave empty to keep current)')" />
                        <input type="file" name="imagePath" id="imagePath" accept="image/*" class="block mt-1 w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-gray-300 dark:border-gray-700 rounded-md">
                        <x-input-error :messages="$errors->get('imagePath')" class="mt-2" />
                    </div>

                    <div class="mb-6 block">
                        <label for="isActive" class="inline-flex items-center cursor-pointer">
                            <input id="isActive" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500" name="isActive" value="1" {{ old('isActive', $foodType->isActive) ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Active (Visible to customers)') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t dark:border-gray-700 pt-4">
                        <x-secondary-button onclick="window.history.back()" class="me-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Update Category') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>