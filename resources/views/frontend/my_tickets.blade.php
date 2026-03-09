<x-app-layout>
    <div class="bg-[#0a0a0a] min-h-screen py-16 relative overflow-hidden" x-data="{ tab: 'upcoming' }">
        
        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[30rem] h-[30rem] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- Success Message --}}
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="mb-10 bg-green-500/10 border border-green-500/30 backdrop-blur-md text-green-400 px-6 py-4 rounded-2xl relative shadow-[0_10px_30px_rgba(34,197,94,0.1)] flex items-start gap-4" role="alert">
                <div class="bg-green-500/20 rounded-xl p-2.5 shrink-0 text-green-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="pt-0.5">
                    <strong class="font-black text-lg tracking-wide block text-white">Action Successful!</strong>
                    <span class="block text-sm font-medium opacity-80 mt-1">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="absolute top-5 right-5 text-green-500/50 hover:text-green-400 transition-colors bg-green-500/10 hover:bg-green-500/20 p-1.5 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-2 bg-[#df1873]/20 rounded-lg">
                            <svg class="w-6 h-6 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 tracking-tight drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                            My Tickets
                        </h1>
                    </div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest ml-14">Your Booking History</p>
                </div>

                {{-- Premium Tab Navigation --}}
                <div class="flex bg-[#111]/80 backdrop-blur-xl p-1.5 rounded-xl border border-gray-800 shadow-[0_10px_30px_rgba(0,0,0,0.5)] self-start md:self-auto relative">
                    <button @click="tab = 'upcoming'"
                        :class="tab === 'upcoming' ? 'bg-[#222] text-white shadow-md border-gray-700' : 'text-gray-500 hover:text-gray-300 border-transparent'"
                        class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-300 border">
                        Upcoming
                    </button>
                    <button @click="tab = 'past'"
                        :class="tab === 'past' ? 'bg-[#222] text-white shadow-md border-gray-700' : 'text-gray-500 hover:text-gray-300 border-transparent'"
                        class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-300 border">
                        Past & Cancelled
                    </button>
                </div>
            </div>

            {{-- Upcoming Tab Content --}}
            <div x-show="tab === 'upcoming'" 
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4">
                
                @php
                $upcomingBookings = $bookings->filter(function($b) {
                    $timeToCheck = $b->showtime->end_time ? $b->showtime->end_time : $b->showtime->start_time;
                    $dt = \Carbon\Carbon::parse($b->showtime->date . ' ' . $timeToCheck, 'Asia/Yangon');
                    return $dt->isFuture() && $b->status !== 'cancelled';
                })->sortBy(function($b) {
                    return \Carbon\Carbon::parse($b->showtime->date . ' ' . $b->showtime->start_time);
                });
                @endphp

                @if($upcomingBookings->isEmpty())
                <div class="bg-[#111]/60 backdrop-blur-xl rounded-[2rem] p-12 text-center border border-gray-800/60 shadow-2xl">
                    <div class="relative w-24 h-24 mx-auto mb-8">
                        <div class="absolute inset-0 bg-[#df1873] blur-2xl opacity-20 rounded-full"></div>
                        <div class="relative w-full h-full bg-[#0a0a0a] border border-gray-800 rounded-full flex items-center justify-center shadow-inner">
                            <svg class="w-10 h-10 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-3">No Upcoming Movies</h3>
                    <p class="text-gray-500 font-medium mb-8 max-w-sm mx-auto leading-relaxed">Looks like you don't have any movie tickets booked right now. Ready for a cinematic experience?</p>
                    <a href="{{ route('movies.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#df1873] to-purple-600 hover:from-[#c21463] hover:to-purple-700 text-white px-8 py-3.5 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(223,24,115,0.3)] hover:shadow-[0_0_30px_rgba(223,24,115,0.5)] transform hover:-translate-y-1">
                        Browse Movies
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                @else
                <div class="grid gap-8">
                    @foreach($upcomingBookings as $booking)
                        <x-ticket-card :booking="$booking" />
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Past & Cancelled Tab Content --}}
            <div x-show="tab === 'past'" style="display: none;"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4">
                
                @php
                $pastBookings = $bookings->filter(function($b) {
                    $timeToCheck = $b->showtime->end_time ? $b->showtime->end_time : $b->showtime->start_time;
                    $dt = \Carbon\Carbon::parse($b->showtime->date . ' ' . $timeToCheck, 'Asia/Yangon');
                    return $dt->isPast() || $b->status === 'cancelled';
                });
                @endphp

                @if($pastBookings->isEmpty())
                <div class="bg-[#111]/60 backdrop-blur-xl rounded-[2rem] p-12 text-center border border-gray-800/60 shadow-2xl">
                    <div class="w-24 h-24 bg-[#0a0a0a] border border-gray-800 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                        <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-400 mb-3">History is Empty</h3>
                    <p class="text-gray-600 font-medium">You don't have any past or cancelled bookings yet.</p>
                </div>
                @else
                <div class="grid gap-8">
                    @foreach($pastBookings as $booking)
                        @if($booking->status === 'cancelled')
                        <div class="bg-[#111]/40 backdrop-blur-md rounded-[2rem] overflow-hidden border border-gray-800 opacity-60 hover:opacity-100 transition-all duration-500 shadow-xl flex flex-col md:flex-row group grayscale-[80%] hover:grayscale-0">

                            {{-- Movie Poster Section --}}
                            <div class="w-full md:w-56 h-72 md:h-auto relative shrink-0 overflow-hidden">
                                @if($booking->showtime->movie->imagePath)
                                    <img src="{{ str_starts_with($booking->showtime->movie->imagePath, 'http') ? $booking->showtime->movie->imagePath : asset('storage/' . $booking->showtime->movie->imagePath) }}" 
                                         alt="Poster" 
                                         class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-[#0a0a0a] border-r border-gray-800 flex items-center justify-center">
                                        <span class="text-gray-600 text-xs font-bold uppercase tracking-widest">No Poster</span>
                                    </div>
                                @endif
                                
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                    <div class="bg-red-600/90 text-white text-sm font-black tracking-widest px-8 py-2 border-y-2 border-red-400 shadow-[0_0_20px_rgba(220,38,38,0.5)] transform -rotate-12 w-[120%] text-center backdrop-blur-sm">
                                        CANCELLED
                                    </div>
                                </div>
                            </div>

                            {{-- Ticket Details Section --}}
                            <div class="p-8 flex-1 flex flex-col justify-between relative">
                                <div class="absolute top-4 right-4 text-9xl font-black text-gray-800/30 -z-10 select-none pointer-events-none transform -rotate-12">VOID</div>
                                
                                <div>
                                    <div class="flex justify-between items-start mb-6 gap-4">
                                        <div>
                                            <h2 class="text-3xl font-black text-gray-500 mb-1.5 line-through decoration-red-500/50 decoration-2">{{ $booking->showtime->movie->title }}</h2>
                                            <p class="text-gray-500 font-bold text-sm flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $booking->showtime->cinemaHall->cinema->name }} &bull; {{ $booking->showtime->cinemaHall->name }}
                                            </p>
                                        </div>
                                        <div class="text-right hidden md:block shrink-0">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-red-500/10 text-red-500 border border-red-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                Cancelled
                                            </span>
                                            <p class="text-gray-500 text-[10px] mt-2 font-mono tracking-wider font-bold">REF: {{ $booking->booking_reference }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-8 mb-6 bg-[#0a0a0a]/50 p-5 rounded-xl border border-gray-800/50">
                                        <div>
                                            <p class="text-[10px] text-gray-600 uppercase font-black tracking-widest mb-2">Showtime</p>
                                            <p class="text-gray-400 font-bold text-sm">
                                                {{ \Carbon\Carbon::parse($booking->showtime->date)->format('D, d M Y') }}
                                                <br>
                                                <span class="text-white">{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }}</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-600 uppercase font-black tracking-widest mb-2 flex items-center gap-1">
                                                Seats <span class="bg-gray-800 text-gray-400 px-1.5 py-0.5 rounded text-[8px]">{{ $booking->tickets->count() }}</span>
                                            </p>
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach($booking->tickets as $ticket)
                                                    <span class="bg-gray-900 text-gray-500 text-xs px-2 py-1.5 rounded-md border border-gray-800 font-bold">{{ $ticket->seat->seat_code }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row justify-between items-center sm:items-end mt-2 pt-6 border-t border-gray-800/60 border-dashed gap-4">
                                    <div class="w-full sm:w-auto">
                                        <div class="md:hidden text-center sm:text-left mb-3">
                                            <p class="text-gray-500 text-[10px] font-mono font-bold tracking-widest">REF: {{ $booking->booking_reference }}</p>
                                        </div>
                                        <a href="{{ route('booking.ticket', $booking->id) }}" target="_blank" class="block w-full sm:w-auto text-center text-gray-500 hover:text-white text-xs font-bold border border-gray-700 hover:border-gray-500 bg-[#0a0a0a] px-5 py-2.5 rounded-xl transition-all uppercase tracking-wider">
                                            View Receipt
                                        </a>
                                    </div>
                                    <div class="text-center sm:text-right w-full sm:w-auto">
                                        <p class="text-[10px] text-gray-600 font-black uppercase tracking-widest mb-1">Refund Amount</p>
                                        <div class="text-2xl font-black text-gray-400">
                                            {{ number_format($booking->total_amount) }} <span class="text-sm font-bold text-gray-600 uppercase">Ks</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            {{-- အကယ်၍ Past Tab ထဲက Cancelled မဟုတ်ဘဲ အရင်က ကြည့်ခဲ့ဖူးတဲ့ လက်မှတ်တွေဆိုရင် မူလ Card အတိုင်းပြမယ် --}}
                            <x-ticket-card :booking="$booking" />
                        @endif
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>