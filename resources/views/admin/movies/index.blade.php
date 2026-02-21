<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('All Movies') }}
            </h2>
            <a href="{{ route('admin.movies.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                + Add New Movie
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="px-4 py-3 text-gray-700 dark:text-gray-300">Poster</th>
                                <th class="px-4 py-3 text-gray-700 dark:text-gray-300">Title</th>
                                <th class="px-4 py-3 text-gray-700 dark:text-gray-300">Genre</th>
                                <th class="px-4 py-3 text-gray-700 dark:text-gray-300">Duration</th>
                                <th class="px-4 py-3 text-gray-700 dark:text-gray-300">Release Date</th>
                                <th class="px-4 py-3 text-gray-700 dark:text-gray-300 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:divide-gray-700">
                            @forelse ($movies as $movie)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <td class="px-4 py-3">
                                        @if($movie->imagePath)
                                            <img src="{{ asset('storage/' . $movie->imagePath) }}" alt="Poster" class="w-12 h-16 object-cover rounded shadow-sm">
                                        @else
                                            <div class="w-12 h-16 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center text-[10px] text-gray-500">No Image</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-gray-100">
                                        {{ $movie->title }}
                                        <div class="text-xs text-gray-500 italic">{{ $movie->director }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $movie->genre }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $movie->duration }} mins</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $movie->releaseDate }}</td>
                                    <td class="px-4 py-3 text-right space-x-2">
                                        <a href="{{ route('admin.movies.edit', $movie->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">Edit</a>
                                        
                                        <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-bold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-10 text-center text-gray-500">
                                        No movies found. <a href="{{ route('admin.movies.create') }}" class="text-indigo-600 underline">Add one now?</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>