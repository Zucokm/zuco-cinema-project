<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Food Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.food-items.update', $foodItem->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <x-input-label for="food_type_id" :value="__('Select Category')" />
                            <select name="food_type_id" id="food_type_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Choose Category --</option>
                                @foreach($foodTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('food_type_id', $foodItem->food_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('food_type_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Item Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $foodItem->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <x-input-label for="price" :value="__('Price (in Ks)')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" min="0" name="price" :value="old('price', $foodItem->price)" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="imagePath" :value="__('Replace Image (Leave empty to keep current)')" />
                            <input type="file" name="imagePath" id="imagePath" accept="image/*" class="block mt-1 w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-gray-300 dark:border-gray-700 rounded-md">
                            <x-input-error :messages="$errors->get('imagePath')" class="mt-2" />
                            
                            @if($foodItem->imagePath)
                                <div class="mt-3">
                                    <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                                    <img src="{{ asset('storage/' . $foodItem->imagePath) }}" alt="{{ $foodItem->name }}" class="w-20 h-20 object-cover rounded border border-gray-200 shadow-sm">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="description" :value="__('Description (Optional)')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" rows="3">{{ old('description', $foodItem->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mb-6 block">
                        <label for="isActive" class="inline-flex items-center cursor-pointer">
                            <input id="isActive" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500" name="isActive" value="1" {{ old('isActive', $foodItem->isActive) ? 'checked' : '' }}>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('In Stock (Available for order)') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t dark:border-gray-700 pt-4">
                        <x-secondary-button onclick="window.history.back()" class="me-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Update Food Item') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>