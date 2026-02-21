<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('All Seat Types') }}
            </h2>
            <a href="{{ route('admin.seat-types.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                + Add New Type
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <th class="px-6 py-3 text-gray-700 dark:text-gray-300 font-semibold text-sm">Type Name</th>
                                <th class="px-6 py-3 text-gray-700 dark:text-gray-300 font-semibold text-sm">Price (MMK)</th>
                                <th class="px-6 py-3 text-gray-700 dark:text-gray-300 font-semibold text-sm">Description</th>
                                <th class="px-6 py-3 text-gray-700 dark:text-gray-300 font-semibold text-sm text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($seatTypes as $type)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $type->name }}</td>
                                    <td class="px-6 py-4 font-bold text-indigo-600 dark:text-indigo-400">
                                        {{ number_format($type->price) }} Ks
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $type->description ?? '-' }}</td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('admin.seat-types.edit', $type->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">Edit</a>
                                        
                                        <form action="{{ route('admin.seat-types.destroy', $type->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this seat type?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-bold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic bg-gray-50 dark:bg-gray-800/50">
                                        No seat types have been created yet. <a href="{{ route('admin.seat-types.create') }}" class="text-indigo-600 underline font-bold">Add Seat Type</a>
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