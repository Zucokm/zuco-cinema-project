<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Movie: ') }} {{ $movie->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form method="POST" action="{{ route('admin.movies.update', $movie->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH') <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="title" :value="__('Movie Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required value="{{ old('title', $movie->title) }}" />
                        </div>
                        <div>
                            <x-input-label for="director" :value="__('Director')" />
                            <x-text-input id="director" class="block mt-1 w-full" type="text" name="director" value="{{ old('director', $movie->director) }}" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <x-input-label for="genre" :value="__('Genre')" />
                            <x-text-input id="genre" class="block mt-1 w-full" type="text" name="genre" value="{{ old('genre', $movie->genre) }}" />
                        </div>
                        <div>
                            <x-input-label for="language" :value="__('Language')" />
                            <x-text-input id="language" class="block mt-1 w-full" type="text" name="language" value="{{ old('language', $movie->language) }}" />
                        </div>
                        <div>
                            <x-input-label for="rating" :value="__('Rating')" />
                            <x-text-input id="rating" class="block mt-1 w-full" type="number" step="0.1" name="rating" value="{{ old('rating', $movie->rating) }}" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <x-input-label for="duration" :value="__('Duration (Minutes)')" />
                            <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration" value="{{ old('duration', $movie->duration) }}" required />
                        </div>
                        <div>
                            <x-input-label for="releaseDate" :value="__('Release Date')" />
                            <x-text-input id="releaseDate" class="block mt-1 w-full" type="date" name="releaseDate" value="{{ old('releaseDate', $movie->releaseDate) }}" required />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $movie->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        @if($movie->imagePath)
                            <div>
                                <p class="text-sm text-gray-500 mb-2">Current Poster:</p>
                                <img src="{{ asset('storage/'.$movie->imagePath) }}" class="w-24 h-32 object-cover rounded">
                            </div>
                        @endif
                        @if($movie->bgImagePath)
                            <div>
                                <p class="text-sm text-gray-500 mb-2">Current BG:</p>
                                <img src="{{ asset('storage/'.$movie->bgImagePath) }}" class="w-48 h-24 object-cover rounded">
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <x-input-label for="image" :value="__('Replace Poster (Optional)')" />
                            <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500" />
                        </div>
                        <div>
                            <x-input-label for="bg_image" :value="__('Replace Background (Optional)')" />
                            <input type="file" name="bg_image" class="mt-1 block w-full text-sm text-gray-500" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t pt-6">
                        <x-secondary-button onclick="window.history.back()" class="me-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Update Movie') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>