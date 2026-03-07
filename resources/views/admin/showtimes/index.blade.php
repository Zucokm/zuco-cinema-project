<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Showtimes Schedule') }}
            </h2>
            <a href="{{ route('admin.showtimes.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                + Add Showtime
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

            {{-- Filter Section --}}
            <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <form method="GET" action="{{ route('admin.showtimes.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="w-full md:w-1/4">
                        <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Date</label>
                        <input type="date" name="date" value="{{ request('date') }}" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                    </div>

                    <div class="w-full md:w-1/4">
                        <label for="movie_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Movie</label>
                        <select name="movie_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="">All Movies</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}" {{ request('movie_id') == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-1/4">
                        <label for="cinema_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Cinema</label>
                        <select name="cinema_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="">All Cinemas</option>
                            @foreach($cinemas as $cinema)
                                <option value="{{ $cinema->id }}" {{ request('cinema_id') == $cinema->id ? 'selected' : '' }}>{{ $cinema->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-semibold text-sm transition">Filter</button>
                        <a href="{{ route('admin.showtimes.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md font-semibold text-sm transition">Reset</a>
                    </div>
                </form>
            </div>

            {{-- ဒီနေရာမှာ $showtimes ကိုမှ groupBy သုံးပြီး date အလိုက် ခွဲလိုက်တာပါ --}}
            @forelse ($showtimes->groupBy('date') as $date => $dailyShows)
            <div class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="px-6 py-4 bg-indigo-50 dark:bg-gray-900 border-b border-indigo-100 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-indigo-700 dark:text-indigo-400 flex items-center gap-2">
                        📅 {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                        <span class="text-xs bg-indigo-200 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-300 px-2 py-1 rounded-full ml-2">
                            {{ $dailyShows->count() }} Shows
                        </span>
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 text-sm">
                                <th class="px-6 py-3 text-gray-500 dark:text-gray-400 font-semibold w-1/3">Movie</th>
                                <th class="px-6 py-3 text-gray-500 dark:text-gray-400 font-semibold">Location (Hall)</th>
                                <th class="px-6 py-3 text-gray-500 dark:text-gray-400 font-semibold text-center">Time</th>
                                <th class="px-6 py-3 text-gray-500 dark:text-gray-400 font-semibold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            {{-- အပေါ်က ခွဲထားတဲ့ dailyShows ကို ပြန်ပတ်တာပါ --}}
                            @foreach ($dailyShows as $show)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($show->movie->imagePath)
                                        <img src="{{ str_starts_with($show->movie->imagePath, 'http') ? $show->movie->imagePath : asset('storage/' . $show->movie->imagePath) }}" alt="Poster" class="w-10 h-14 object-cover rounded shadow-sm">
                                        @else
                                        <div class="w-10 h-14 bg-gray-200 rounded flex items-center justify-center text-[10px] text-gray-500">No Image</div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-gray-900 dark:text-gray-100">{{ $show->movie->title }}</p>
                                            <p class="text-xs text-gray-500">{{ $show->movie->duration }} mins</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $show->cinemaHall->cinema->name }}</p>
                                    <p class="text-sm text-indigo-600 dark:text-indigo-400">{{ $show->cinemaHall->name }}</p>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 px-3 py-1.5 rounded-md">
                                        <span class="font-bold text-green-600 dark:text-green-400">{{ \Carbon\Carbon::parse($show->start_time)->format('h:i A') }}</span>
                                        <span class="text-gray-400">-</span>
                                        <span class="font-bold text-red-500 dark:text-red-400">{{ \Carbon\Carbon::parse($show->end_time)->format('h:i A') }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-right space-x-3">
                                    <a href="{{ route('admin.showtimes.edit', $show->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">Edit</a>

                                    <form action="{{ route('admin.showtimes.destroy', $show->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this showtime?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-bold">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @empty
            <div class="bg-white dark:bg-gray-800 p-10 text-center rounded-lg shadow-sm text-gray-500 italic">
                No showtimes have been scheduled yet. <a href="{{ route('admin.showtimes.create') }}" class="text-indigo-600 underline font-bold">Schedule a Movie</a>
            </div>
            @endforelse
            
            {{-- Pagination Links အတွက် --}}
            <div class="mt-6">
                {{ $showtimes->links() }}
            </div>

        </div>
    </div>
</x-app-layout>