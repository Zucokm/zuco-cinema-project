<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Cinema Food Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Select a cinema below to manage which food and beverage items are available at that specific location.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($cinemas as $cinema)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-md transition">
                            <h3 class="font-bold text-lg text-indigo-600 dark:text-indigo-400 mb-2">{{ $cinema->name }}</h3>
                            <p class="text-sm text-gray-500 mb-4">{{ Str::limit($cinema->address, 50) }}</p>
                            
                            <a href="{{ route('admin.cinema-items.manage', $cinema->id) }}" class="inline-block w-full text-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition">
                                Manage Menu Items
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>