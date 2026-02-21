<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Cinema Hall') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.cinema-halls.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="cinema_id" :value="__('Select Cinema')" />
                        <select name="cinema_id" id="cinema_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Choose a Cinema --</option>
                            @foreach($cinemas as $cinema)
                                <option value="{{ $cinema->id }}">{{ $cinema->name }} ({{ $cinema->township }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-input-label for="name" :value="__('Hall Name (e.g. Hall 1)')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                        </div>
                        <div>
                            <x-input-label for="totalSeats" :value="__('Total Seats')" />
                            <x-text-input id="totalSeats" class="block mt-1 w-full" type="number" name="totalSeats" required />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="floor" :value="__('Floor (e.g. 2nd Floor)')" />
                        <x-text-input id="floor" class="block mt-1 w-full" type="text" name="floor" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Hall Photo (Optional)')" />
                        <input type="file" name="photo" class="mt-1 block w-full text-sm text-gray-500" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>{{ __('Save Cinema Hall') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>