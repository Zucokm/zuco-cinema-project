<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Food Categories') }}
            </h2>
            <a href="{{ route('admin.food-types.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                + Add Category
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
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-900 border-b dark:border-gray-700 text-sm">
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold w-24">Image</th>
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold">Category Name</th>
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold text-center">Status</th>
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($foodTypes as $type)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition items-center">
                                    
                                    <td class="px-6 py-4">
                                        @if($type->imagePath)
                                            <img src="{{ asset('storage/' . $type->imagePath) }}" alt="{{ $type->name }}" class="w-16 h-16 object-cover rounded shadow-sm border border-gray-200 dark:border-gray-700">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-[10px] text-gray-500">No Image</div>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-gray-100">
                                        {{ $type->name }}
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        @if($type->isActive)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('admin.food-types.edit', $type->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">Edit</a>
                                        
                                        <form action="{{ route('admin.food-types.destroy', $type->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category? All related food items might be affected.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                                        No food categories found. <a href="{{ route('admin.food-types.create') }}" class="text-indigo-600 underline font-bold">Add One Now</a>
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