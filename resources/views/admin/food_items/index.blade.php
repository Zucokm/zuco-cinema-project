<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Food & Beverage Items') }}
            </h2>
            <a href="{{ route('admin.food-items.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                + Add Item
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
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold">Item Info</th>
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold">Category</th>
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold">Price</th>
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold text-center">Status</th>
                                <th class="px-6 py-4 text-gray-500 dark:text-gray-400 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($foodItems as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    
                                    <td class="px-6 py-4">
                                        @if($item->imagePath)
                                            <img src="{{ asset('storage/' . $item->imagePath) }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded shadow-sm border border-gray-200 dark:border-gray-700">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-[10px] text-gray-500 text-center leading-tight">No<br>Image</div>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-gray-900 dark:text-gray-100">{{ $item->name }}</p>
                                        @if($item->description)
                                            <p class="text-xs text-gray-500 mt-1 truncate max-w-xs">{{ $item->description }}</p>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            {{ $item->foodType->name }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-gray-100">
                                        {{ number_format($item->price) }} Ks
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        @if($item->isActive)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Available</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">Out of Stock</span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('admin.food-items.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">Edit</a>
                                        
                                        <form action="{{ route('admin.food-items.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                                        No food items found. <a href="{{ route('admin.food-items.create') }}" class="text-indigo-600 underline font-bold">Add One Now</a>
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