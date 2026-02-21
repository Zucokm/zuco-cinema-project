<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Movie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form method="POST" action="{{ route('admin.movies.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="title" :value="__('Movie Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required value="{{ old('title') }}" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="director" :value="__('Director')" />
                            <x-text-input id="director" class="block mt-1 w-full" type="text" name="director" value="{{ old('director') }}" />
                            <x-input-error :messages="$errors->get('director')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <x-input-label for="genre" :value="__('Genre')" />
                            <x-text-input id="genre" class="block mt-1 w-full" type="text" name="genre" placeholder="Action, Drama..." value="{{ old('genre') }}" />
                        </div>
                        <div>
                            <x-input-label for="language" :value="__('Language')" />
                            <x-text-input id="language" class="block mt-1 w-full" type="text" name="language" value="English" />
                        </div>
                        <div>
                            <x-input-label for="rating" :value="__('Rating (0.0 to 10.0)')" />
                            <x-text-input id="rating" class="block mt-1 w-full" type="number" step="0.1" name="rating" value="0.0" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <x-input-label for="duration" :value="__('Duration (Minutes)')" />
                            <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration" required value="{{ old('duration') }}" />
                        </div>
                        <div>
                            <x-input-label for="releaseDate" :value="__('Release Date')" />
                            <x-text-input id="releaseDate" class="block mt-1 w-full" type="date" name="releaseDate" required value="{{ old('releaseDate') }}" />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="trailerLink" :value="__('Trailer Link (YouTube URL)')" />
                        <x-text-input id="trailerLink" class="block mt-1 w-full" type="url" name="trailerLink" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('trailerLink') }}" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div>
                            <x-input-label for="image" :value="__('Movie Poster (Vertical)')" />
                            <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        </div>
                        <div>
                            <x-input-label for="bg_image" :value="__('Background Image (Horizontal)')" />
                            <input type="file" id="bg_image" name="bg_image" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t pt-6">
                        <x-secondary-button onclick="window.history.back()" class="me-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Save Movie') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>