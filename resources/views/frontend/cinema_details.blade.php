<x-app-layout>
    <style>
        /* Reveal Animation */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div class="relative w-full h-[50vh] min-h-[450px] flex items-end pb-12 overflow-hidden bg-[#0a0a0a]">
        <div class="absolute inset-0 z-0">
            @if($cinema->photoPath)
            <img src="{{ asset('storage/' . $cinema->photoPath) }}" class="w-full h-full object-cover opacity-50 scale-105 transition-transform duration-[10s] hover:scale-110 blur-[2px]">
            @else
            <img src="https://images.unsplash.com/photo-1595769816263-9b910be24d5f?q=80&w=2079&auto=format&fit=crop" class="w-full h-full object-cover opacity-30 scale-105 blur-[2px]">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/70 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0a0a0a]/50 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="inline-block bg-[#111]/60 backdrop-blur-xl p-8 md:p-10 rounded-3xl border border-white/10 shadow-2xl reveal-on-scroll transform translate-y-8">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-4 tracking-tight drop-shadow-lg">{{ $cinema->name }}</h1>

                <div class="flex flex-col sm:flex-row gap-4 sm:gap-8 text-sm md:text-base font-medium text-gray-300">
                    <p class="flex items-center gap-2.5">
                        <span class="p-2 bg-white/5 rounded-full border border-white/10">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                        {{ $cinema->address }}, {{ $cinema->township }}
                    </p>
                    <p class="flex items-center gap-2.5 text-[#df1873]">
                        <span class="p-2 bg-[#df1873]/10 rounded-full border border-[#df1873]/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path>
                            </svg>
                        </span>
                        {{ $cinema->phone }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#0a0a0a] min-h-screen py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-4 mb-12 reveal-on-scroll">
                <span class="w-2 h-10 bg-[#df1873] rounded-full"></span>
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Now Showing Here</h2>
            </div>

            @if($movies->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 bg-[#111] rounded-3xl border border-gray-800 border-dashed reveal-on-scroll">
                <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No Movies Scheduled</h3>
                <p class="text-gray-500">There are currently no showtimes available for this cinema.</p>
            </div>
            @else
            <div class="space-y-10">
                @foreach($movies as $movie)
                <div class="reveal-on-scroll group bg-[#111]/40 border border-gray-800/60 hover:border-gray-700 hover:bg-[#111]/80 rounded-3xl p-5 md:p-8 flex flex-col md:flex-row gap-8 shadow-lg transition-all duration-500">

                    <div class="w-full md:w-56 shrink-0 relative rounded-2xl overflow-hidden aspect-[2/3] shadow-2xl">
                        @if($movie->imagePath)
                        <img src="{{ str_starts_with($movie->imagePath, 'http') ? $movie->imagePath : asset('storage/' . $movie->imagePath) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        @else
                        <div class="w-full h-full bg-gray-900 flex items-center justify-center text-gray-600 font-bold uppercase text-xs tracking-wider">No Image</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-transparent to-transparent opacity-0 group-hover:opacity-80 transition-opacity duration-300"></div>
                    </div>

                    <div class="flex-1 flex flex-col justify-between min-w-0">
                        <div>
                            <a href="{{ route('movie.details', $movie->id) }}" class="inline-block hover:text-[#df1873] transition-colors mb-3">
                                <h3 class="text-3xl font-bold text-white tracking-tight truncate">{{ $movie->title }}</h3>
                            </a>

                            <div class="flex flex-wrap gap-3 mb-8">
                                <span class="bg-white/5 text-gray-300 px-4 py-1.5 rounded-full text-xs font-bold border border-white/10 backdrop-blur-md flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $movie->duration }} mins
                                </span>
                                <span class="bg-white/5 text-gray-300 px-4 py-1.5 rounded-full text-xs font-bold border border-white/10 backdrop-blur-md">
                                    {{ $movie->genre }}
                                </span>
                                <span class="bg-white/5 text-gray-300 px-4 py-1.5 rounded-full text-xs font-bold border border-white/10 backdrop-blur-md uppercase">
                                    {{ $movie->language }}
                                </span>
                            </div>
                        </div>

                        @php
                        $showtimesByDate = $movie->showtimes->groupBy('date')->sortKeys();
                        @endphp

                        @if($showtimesByDate->isNotEmpty())
                        <div x-data="{ selectedDate: '{{ $showtimesByDate->keys()->first() }}' }">

                            <div class="flex overflow-x-auto gap-3 pb-4 mb-6 border-b border-gray-800/50 no-scrollbar relative">
                                @foreach($showtimesByDate->keys() as $date)
                                <button
                                    @click="selectedDate = '{{ $date }}'"
                                    :class="selectedDate === '{{ $date }}' ? 'bg-[#df1873] text-white shadow-lg shadow-[#df1873]/20' : 'bg-[#1a1a1a] text-gray-400 hover:bg-gray-800 hover:text-white border border-gray-800'"
                                    class="flex flex-col items-center justify-center min-w-[75px] py-2.5 px-4 rounded-xl transition-all shrink-0 relative overflow-hidden">
                                    <span class="text-[11px] font-extrabold uppercase tracking-wider mb-0.5">{{ \Carbon\Carbon::parse($date)->format('M d') }}</span>
                                    <span class="text-xs opacity-70 font-medium">{{ \Carbon\Carbon::parse($date)->format('D') }}</span>
                                </button>
                                @endforeach
                            </div>

                            <div class="min-h-[90px]">
                                @foreach($showtimesByDate as $date => $showtimes)
                                <div x-show="selectedDate === '{{ $date }}'"
                                    style="display: none;"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">

                                    @foreach($showtimes->sortBy('start_time') as $showtime)
                                    @php
                                    $bookedSeats = $showtime->bookings->sum('tickets_count');
                                    $totalSeats = $showtime->cinemaHall->totalSeats;
                                    $isSoldOut = $bookedSeats >= $totalSeats;

                                    // အချိန်ကျော်သွားသလား စစ်ဆေးခြင်း (Timezone ကို Asia/Yangon နဲ့ သေချာစစ်ပါတယ်)
                                    $isPassed = \Carbon\Carbon::parse($showtime->date . ' ' . $showtime->start_time, 'Asia/Yangon')->isPast();
                                    @endphp

                                    @if($isPassed)
                                    <div class="flex flex-col items-center justify-center py-3 px-2 bg-[#1a1a1a]/30 border border-gray-800/50 rounded-xl cursor-not-allowed opacity-40 relative overflow-hidden">
                                        <span class="text-sm font-black text-gray-600">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                        <span class="text-[10px] text-gray-500 font-bold mt-1 uppercase tracking-wider">Ended</span>
                                    </div>
                                    @elseif($isSoldOut)
                                    <div class="flex flex-col items-center justify-center py-3 px-2 bg-[#1a1a1a]/50 border border-gray-800 rounded-xl cursor-not-allowed opacity-50 relative overflow-hidden">
                                        <span class="text-sm font-black text-gray-500 line-through">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                        <span class="text-[10px] text-red-500 font-bold mt-1 uppercase tracking-wider">Sold Out</span>
                                    </div>
                                    @else
                                    <a href="{{ route('book.seats', $showtime->id) }}"
                                        class="relative flex flex-col items-center justify-center py-3 px-2 bg-[#1a1a1a] hover:bg-[#df1873] text-white rounded-xl transition-all duration-300 border border-gray-800 hover:border-[#df1873] hover:shadow-lg hover:shadow-[#df1873]/20 group/btn">
                                        <span class="text-sm font-black group-hover/btn:scale-110 transition-transform">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                        <span class="text-[10px] text-gray-500 group-hover/btn:text-white/80 mt-1 truncate w-full text-center font-medium">{{ $showtime->cinemaHall->name }}</span>
                                    </a>
                                    @endif
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <div class="mt-6 p-6 bg-[#1a1a1a]/50 rounded-2xl text-center border border-gray-800 border-dashed">
                            <p class="text-gray-500 font-medium">No showtimes available for this movie.</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll Reveal Animation Initialization
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
</x-app-layout>