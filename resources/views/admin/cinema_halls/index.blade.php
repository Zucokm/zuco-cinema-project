<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cinema Halls by Location') }}
            </h2>
            <a href="{{ route('admin.cinema-halls.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                + Add New Hall
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($cinemas as $cinema)
                <div class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                🎬 {{ $cinema->name }}
                            </h3>
                            <span class="text-sm text-gray-500">{{ $cinema->township }}, {{ $cinema->city }}</span>
                        </div>
                        <div class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                            Total Halls: {{ $cinema->halls->count() }}
                        </div>
                    </div>

                    <div class="overflow-x-auto p-0">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-300 text-sm w-24">Photo</th>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-300 text-sm">Hall Name</th>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-300 text-sm">Floor</th>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-300 text-sm">Total Seats</th>
                                    <th class="px-6 py-3 text-gray-700 dark:text-gray-300 text-sm text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($cinema->halls as $hall)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                        <td class="px-6 py-3">
                                            @if($hall->photoPath)
                                                <img src="{{ asset('storage/' . $hall->photoPath) }}" alt="Hall" class="w-16 h-10 object-cover rounded shadow-sm">
                                            @else
                                                <div class="w-16 h-10 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center text-[10px] text-gray-500">No Photo</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3 font-medium text-gray-900 dark:text-gray-100">{{ $hall->name }}</td>
                                        <td class="px-6 py-3 text-sm text-gray-600 dark:text-gray-400">{{ $hall->floor ?? '-' }}</td>
                                        <td class="px-6 py-3 text-sm text-gray-600 dark:text-gray-400 font-bold">{{ $hall->totalSeats }}</td>
                                        <td class="px-6 py-3 text-right space-x-3">
                                            <a href="{{ route('admin.cinema-halls.edit', $hall->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">Edit</a>
                                            
                                            <form action="{{ route('admin.cinema-halls.destroy', $hall->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this hall?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-bold">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-6 text-center text-gray-500 text-sm bg-gray-50 dark:bg-gray-800/50">
                                            No halls have been added to this cinema yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 p-10 text-center rounded-lg shadow-sm text-gray-500 italic">
                    No cinemas or halls have been created yet. <a href="{{ route('admin.cinema-halls.create') }}" class="text-indigo-600 underline font-bold">Add Hall</a>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>