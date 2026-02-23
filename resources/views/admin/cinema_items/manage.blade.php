<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Menu for: ') }} <span class="text-indigo-600">{{ $cinema->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.cinema-items.store', $cinema->id) }}" method="POST">
                @csrf

                @foreach($foodTypes as $type)
                    @if($type->foodItems->count() > 0)
                        <div class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex items-center gap-3">
                                @if($type->imagePath)
                                    <img src="{{ asset('storage/' . $type->imagePath) }}" class="w-8 h-8 rounded-full object-cover">
                                @endif
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ $type->name }}</h3>
                            </div>
                            
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($type->foodItems as $item)
                                    <label class="flex items-start space-x-3 p-4 border border-gray-100 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                        <div class="flex-shrink-0 mt-1">
                                            <input type="checkbox" name="food_items[]" value="{{ $item->id }}" 
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-5 h-5 cursor-pointer"
                                                {{ in_array($item->id, $availableItemIds) ? 'checked' : '' }}>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->name }}</p>
                                            <p class="text-sm text-indigo-600 dark:text-indigo-400">{{ number_format($item->price) }} Ks</p>
                                        </div>
                                        @if($item->imagePath)
                                            <img src="{{ asset('storage/' . $item->imagePath) }}" class="w-12 h-12 rounded object-cover ml-auto">
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="flex items-center justify-end mt-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 sticky bottom-4">
                    <x-secondary-button onclick="window.history.back()" class="me-3">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 px-8 py-3">
                        {{ __('Save Menu Availability') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>