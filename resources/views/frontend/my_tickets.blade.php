<x-app-layout>
    <style>
        /* Animation smooth ဖြစ်ဖို့ ေနောက်ကွယ်က logic */
        [x-cloak] { display: none !important; }
        
        .tab-content-wrapper {
            display: grid;
            grid-template-columns: 1fr;
        }
        
        .tab-content-wrapper > div {
            grid-area: 1 / 1 / 2 / 2;
        }

        .custom-scrollbar::-webkit-scrollbar { height: 4px; width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #df1873; border-radius: 10px; }
    </style>

    <div class="bg-[#0a0a0a] min-h-screen py-16 relative overflow-hidden" 
         x-data="{ 
            tab: 'upcoming',
            activeClass: 'bg-[#222] text-white shadow-md border-gray-700',
            inactiveClass: 'text-gray-500 hover:text-gray-300 border-transparent'
         }">
        
        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[30rem] h-[30rem] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-[#df1873]/20 rounded-lg shadow-[0_0_15px_rgba(223,24,115,0.2)]">
                            <svg class="w-6 h-6 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 tracking-tight drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                            My Tickets
                        </h1>
                    </div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest ml-14">Your Booking History</p>
                </div>

                {{-- Premium Tab Switcher --}}
                <div class="flex bg-[#111]/80 backdrop-blur-xl p-1.5 rounded-xl border border-gray-800 shadow-2xl self-start md:self-auto">
                    <button @click="tab = 'upcoming'"
                        :class="tab === 'upcoming' ? activeClass : inactiveClass"
                        class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-500 border whitespace-nowrap">
                        Upcoming
                    </button>
                    <button @click="tab = 'past'"
                        :class="tab === 'past' ? activeClass : inactiveClass"
                        class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-500 border whitespace-nowrap">
                        Past & Cancelled
                    </button>
                </div>
            </div>

            <div class="tab-content-wrapper relative">
                
                {{-- Upcoming Tab --}}
                <div x-show="tab === 'upcoming'"
                    x-transition:enter="transition ease-out duration-500 delay-200"
                    x-transition:enter-start="opacity-0 transform translate-y-8"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-8">
                    
                    @php
                    $upcomingBookings = $bookings->filter(function($b) {
                        $showtimeDateTime = \Carbon\Carbon::parse($b->showtime->date . ' ' . $b->showtime->start_time);
                        return $showtimeDateTime->isAfter(now()) && $b->status !== 'cancelled';
                    })->sortBy(function($b) {
                        return \Carbon\Carbon::parse($b->showtime->date . ' ' . $b->showtime->start_time);
                    });
                    @endphp

                    @if($upcomingBookings->isEmpty())
                        <div class="bg-[#111]/60 backdrop-blur-xl rounded-[2rem] p-12 text-center border border-gray-800 shadow-2xl">
                            <div class="w-20 h-20 bg-[#0a0a0a] rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner border border-gray-800">
                                <svg class="w-10 h-10 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-3 text-shadow-sm">No Upcoming Movies</h3>
                            <a href="{{ route('movies.index') }}" class="mt-4 inline-block bg-gradient-to-r from-[#df1873] to-purple-600 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(223,24,115,0.3)] hover:scale-105">Browse Movies</a>
                        </div>
                    @else
                        <div class="grid gap-8">
                            @foreach($upcomingBookings as $booking)
                                <x-ticket-card :booking="$booking" />
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Past & Cancelled Tab --}}
                <div x-show="tab === 'past'" x-cloak
                    x-transition:enter="transition ease-out duration-500 delay-200"
                    x-transition:enter-start="opacity-0 transform translate-y-8"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-8">
                    
                    @php
                    $pastBookings = $bookings->filter(function($b) {
                        $showtimeDateTime = \Carbon\Carbon::parse($b->showtime->date . ' ' . $b->showtime->start_time);
                        return $showtimeDateTime->isBefore(now()) || $b->status === 'cancelled';
                    });
                    @endphp

                    @if($pastBookings->isEmpty())
                        <div class="bg-[#111]/60 backdrop-blur-xl rounded-[2rem] p-12 text-center border border-gray-800 shadow-2xl">
                            <h3 class="text-2xl font-black text-gray-400 mb-3">History is Empty</h3>
                        </div>
                    @else
                        <div class="grid gap-8">
                            @foreach($pastBookings as $booking)
                                @if($booking->status === 'cancelled')
                                    <div class="bg-[#111]/40 backdrop-blur-md rounded-[2rem] overflow-hidden border border-gray-800 flex flex-col md:flex-row grayscale-[80%] opacity-60 hover:opacity-100 transition-all duration-500">
                                        <div class="w-full md:w-56 h-72 md:h-auto relative overflow-hidden">
                                            <img src="{{ str_starts_with($booking->showtime->movie->imagePath, 'http') ? $booking->showtime->movie->imagePath : asset('storage/' . $booking->showtime->movie->imagePath) }}" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                                <div class="bg-red-600/90 text-white text-sm font-black tracking-widest px-8 py-2 transform -rotate-12 w-[120%] text-center backdrop-blur-sm">CANCELLED</div>
                                            </div>
                                        </div>
                                        <div class="p-8 flex-1 relative overflow-hidden">
                                            <div class="absolute top-4 right-4 text-8xl font-black text-gray-800/30 -z-10 transform -rotate-12 pointer-events-none">VOID</div>
                                            <h2 class="text-3xl font-black text-gray-500 mb-2 line-through">{{ $booking->showtime->movie->title }}</h2>
                                            <p class="text-gray-500 font-bold text-sm mb-6">{{ $booking->showtime->cinemaHall->cinema->name }}</p>
                                            <div class="bg-[#0a0a0a]/50 p-5 rounded-xl border border-gray-800/50 flex justify-between">
                                                <div>
                                                    <p class="text-[10px] text-gray-600 uppercase font-black tracking-widest mb-1">Showtime</p>
                                                    <p class="text-gray-400 font-bold text-sm">{{ \Carbon\Carbon::parse($booking->showtime->date)->format('d M Y') }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-[10px] text-gray-600 uppercase font-black tracking-widest mb-1">Seats</p>
                                                    <p class="text-gray-400 font-bold text-sm">{{ $booking->tickets->count() }} Seats</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <x-ticket-card :booking="$booking" />
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>