<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('POS - New Booking') }}
        </h2>
    </x-slot>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.05);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #df1873;
            border-radius: 10px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 shadow-md rounded-r animate-fade-in-down" role="alert">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <p class="font-bold text-lg">Success</p>
                            <p>{{ session('success') }}</p>
                        </div>
                        @if(session('last_booking_id'))
                        <div class="flex gap-3">
                            <a href="{{ route('booking.ticket', session('last_booking_id')) }}" target="_blank" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Print Ticket
                            </a>
                            <a href="{{ route('admin.pos') }}" class="flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow transition transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                New Booking
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="mb-8 bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                <form action="{{ route('admin.pos') }}" method="GET" class="flex gap-4">
                    <div class="relative w-full md:w-1/2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies..." class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#df1873] dark:text-white transition">
                    </div>
                    <button type="submit" class="bg-[#df1873] hover:bg-[#c21463] text-white px-8 py-3 rounded-lg font-bold transition shadow-md hover:shadow-lg">Search</button>
                    @if(request('search'))
                        <a href="{{ route('admin.pos') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-bold transition shadow-md flex items-center">Clear</a>
                    @endif
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($movies as $movie)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col h-full border border-gray-100 dark:border-gray-700">
                    <div class="relative h-64 overflow-hidden group">
                        @if($movie->imagePath)
                            <img src="{{ asset('storage/' . $movie->imagePath) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-700 flex items-center justify-center text-gray-400 flex-col gap-2">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>No Image</span>
                            </div>
                        @endif
                        <div class="absolute top-0 right-0 m-2 bg-black/60 backdrop-blur-sm text-white text-xs px-2 py-1 rounded">
                            {{ $movie->duration }} mins
                        </div>
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/90 to-transparent p-4 pt-12">
                            <h3 class="text-xl font-bold text-white truncate">{{ $movie->title }}</h3>
                            <p class="text-gray-300 text-xs">{{ $movie->genre ?? 'Genre N/A' }} | {{ $movie->language }}</p>
                        </div>
                    </div>
                    
                    <div class="p-4 flex-1 flex flex-col bg-gray-50 dark:bg-gray-800/50">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-300">Showtimes</span>
                        </div>

                        <div class="flex-1 overflow-y-auto custom-scrollbar max-h-[200px] pr-1 space-y-3">
                            @forelse($movie->showtimes->groupBy('date')->sortKeys() as $date => $showtimes)
                                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 border border-gray-100 dark:border-gray-600">
                                    <p class="text-[#df1873] font-bold text-xs mb-2 uppercase tracking-wide border-b border-gray-100 dark:border-gray-600 pb-1">
                                        {{ \Carbon\Carbon::parse($date)->format('D, M d') }}
                                    </p>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach($showtimes->sortBy('start_time') as $showtime)
                                            <a href="{{ route('book.seats', $showtime->id) }}" class="group flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-600 hover:bg-[#df1873] hover:text-white rounded px-2 py-1.5 transition text-center cursor-pointer border border-transparent hover:border-pink-400">
                                                <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                                <span class="text-[10px] text-gray-500 dark:text-gray-400 group-hover:text-pink-100 truncate w-full">{{ $showtime->cinemaHall->name }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center text-gray-400 text-sm py-4">
                                    <span>No upcoming shows</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($movies->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 text-gray-500 dark:text-gray-400">
                    <svg class="w-16 h-16 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>
                    <p class="text-xl font-medium">No movies found</p>
                    <p class="text-sm mt-2">Try adjusting your search or add new showtimes.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>