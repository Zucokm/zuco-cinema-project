<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('POS - New Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md rounded-r" role="alert">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <p class="font-bold text-lg">Success</p>
                            <p>{{ session('success') }}</p>
                        </div>
                        @if(session('last_booking_id'))
                        <div class="flex gap-3">
                            <a href="{{ route('booking.ticket', session('last_booking_id')) }}" target="_blank" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Print Ticket
                            </a>
                            <a href="{{ route('admin.pos') }}" class="flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                New Booking
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="mb-8">
                <form action="{{ route('admin.pos') }}" method="GET" class="flex gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies..." class="w-full md:w-1/3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#df1873] dark:text-white shadow-sm">
                    <button type="submit" class="bg-[#df1873] hover:bg-[#c21463] text-white px-6 py-2 rounded-lg font-bold transition shadow-md">Search</button>
                    @if(request('search'))
                        <a href="{{ route('admin.pos') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-bold transition shadow-md flex items-center">Clear</a>
                    @endif
                </form>
            </div>

            <div class="grid grid-cols-1 gap-8">
                @foreach($movies as $movie)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col md:flex-row">
                    <div class="w-full md:w-48 shrink-0">
                        @if($movie->imagePath)
                            <img src="{{ asset('storage/' . $movie->imagePath) }}" class="w-full h-64 md:h-full object-cover">
                        @else
                            <div class="w-full h-64 md:h-full bg-gray-700 flex items-center justify-center text-gray-400">No Image</div>
                        @endif
                    </div>
                    
                    <div class="p-6 flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $movie->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $movie->duration }} mins | {{ $movie->language }}</p>
                        
                        <div class="space-y-4">
                            @foreach($movie->showtimes->groupBy('date') as $date => $showtimes)
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0">
                                    <p class="text-[#df1873] font-bold mb-2">{{ \Carbon\Carbon::parse($date)->format('D, d M Y') }}</p>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($showtimes as $showtime)
                                            <a href="{{ route('book.seats', $showtime->id) }}" class="flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-700 hover:bg-[#df1873] hover:text-white border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 transition group min-w-[100px]">
                                                <span class="text-lg font-bold">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 group-hover:text-white/80">{{ $showtime->cinemaHall->name }}</span>
                                                <span class="text-[10px] text-gray-400 dark:text-gray-500 group-hover:text-white/70">{{ $showtime->cinemaHall->cinema->name }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach

                @if($movies->isEmpty())
                    <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                        No showtimes available. Please add showtimes first.
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>