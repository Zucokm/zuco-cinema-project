<x-app-layout>
    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>

    <div class="relative h-[40vh] w-full overflow-hidden">
        @if($cinema->photoPath)
            <img src="{{ asset('storage/' . $cinema->photoPath) }}" class="w-full h-full object-cover opacity-40">
        @else
            <div class="w-full h-full bg-gray-800 opacity-40"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/60 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full p-8 md:p-12">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-2">{{ $cinema->name }}</h1>
                <p class="text-gray-300 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $cinema->address }}, {{ $cinema->township }}, {{ $cinema->city }}
                </p>
                <p class="text-[#df1873] font-bold mt-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path></svg>
                    {{ $cinema->phone }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-[#0a0a0a] min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-white mb-8 border-l-4 border-[#df1873] pl-4">Now Showing</h2>

            @if($movies->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg">No movies currently scheduled for this cinema.</p>
                </div>
            @else
                <div class="space-y-12">
                    @foreach($movies as $movie)
                        <div class="bg-[#111] rounded-2xl p-6 border border-gray-800 flex flex-col md:flex-row gap-8 shadow-lg hover:border-gray-700 transition-colors">
                            <div class="w-full md:w-48 shrink-0">
                                @if($movie->imagePath)
                                    <img src="{{ asset('storage/' . $movie->imagePath) }}" class="rounded-lg w-full shadow-lg object-cover aspect-[2/3]">
                                @else
                                    <div class="w-full aspect-[2/3] bg-gray-800 rounded-lg flex items-center justify-center text-gray-600">No Image</div>
                                @endif
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <h3 class="text-2xl font-bold text-white mb-2 truncate">{{ $movie->title }}</h3>
                                <div class="flex flex-wrap gap-4 text-sm text-gray-400 mb-6">
                                    <span class="bg-gray-800 px-2 py-1 rounded">{{ $movie->duration }} mins</span>
                                    <span class="bg-gray-800 px-2 py-1 rounded">{{ $movie->genre }}</span>
                                    <span class="bg-gray-800 px-2 py-1 rounded">{{ $movie->language }}</span>
                                </div>

                                @php
                                    $showtimesByDate = $movie->showtimes->groupBy('date')->sortKeys();
                                @endphp

                                @if($showtimesByDate->isNotEmpty())
                                <div x-data="{ selectedDate: '{{ $showtimesByDate->keys()->first() }}' }" class="mt-6">
                                    
                                    <div class="flex overflow-x-auto gap-3 pb-3 mb-4 border-b border-gray-800/50 no-scrollbar">
                                        @foreach($showtimesByDate->keys() as $date)
                                            <button 
                                                @click="selectedDate = '{{ $date }}'"
                                                :class="selectedDate === '{{ $date }}' ? 'bg-[#df1873] text-white border-[#df1873]' : 'bg-gray-800 text-gray-400 border-gray-700 hover:bg-gray-700 hover:text-white'"
                                                class="flex flex-col items-center justify-center min-w-[70px] py-2 px-3 rounded-lg border transition-all text-xs sm:text-sm shrink-0">
                                                <span class="font-bold uppercase">{{ \Carbon\Carbon::parse($date)->format('M d') }}</span>
                                                <span class="text-[10px] opacity-80">{{ \Carbon\Carbon::parse($date)->format('D') }}</span>
                                            </button>
                                        @endforeach
                                    </div>

                                    <div class="min-h-[80px]">
                                        @foreach($showtimesByDate as $date => $showtimes)
                                            <div x-show="selectedDate === '{{ $date }}'" 
                                                 style="display: none;"
                                                 x-transition:enter="transition ease-out duration-200"
                                                 x-transition:enter-start="opacity-0 transform scale-95"
                                                 x-transition:enter-end="opacity-100 transform scale-100"
                                                 class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                                                
                                                @foreach($showtimes->sortBy('start_time') as $showtime)
                                                    @php
                                                        // တွက်ချက်မှုများ
                                                        $bookedSeats = $showtime->bookings->sum('tickets_count');
                                                        $totalSeats = $showtime->cinemaHall->totalSeats;
                                                        $isSoldOut = $bookedSeats >= $totalSeats;
                                                    @endphp

                                                    @if($isSoldOut)
                                                    <div class="group flex flex-col items-center justify-center px-2 py-3 bg-gray-900/50 border border-gray-800 rounded-xl cursor-not-allowed opacity-60">
                                                        <span class="text-sm sm:text-base font-bold text-gray-500 line-through">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                                        <span class="text-[10px] text-red-500 font-bold mt-1 uppercase tracking-wider">Sold Out</span>
                                                    </div>
                                                    @else
                                                    <a href="{{ route('book.seats', $showtime->id) }}" 
                                                       class="group flex flex-col items-center justify-center px-2 py-3 bg-gray-800/50 hover:bg-[#df1873] text-white rounded-xl transition-all border border-gray-700 hover:border-[#df1873] shadow-sm">
                                                        <span class="text-sm sm:text-base font-bold">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                                        <span class="text-[10px] text-gray-500 group-hover:text-white/90 mt-1 truncate w-full text-center">{{ $showtime->cinemaHall->name }}</span>
                                                    </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                    <div class="mt-6 p-4 bg-gray-800/30 rounded-lg text-center border border-gray-800 border-dashed">
                                        <p class="text-gray-500 text-sm">No showtimes available.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>