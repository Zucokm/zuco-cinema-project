<x-app-layout>
    <div class="bg-[#0a0a0a] min-h-screen py-12" x-data="{ tab: 'upcoming' }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Success Message --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition class="mb-8 bg-green-900/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl relative shadow-lg flex items-start gap-4" role="alert">
                    <div class="bg-green-500/20 rounded-full p-2 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="pt-1">
                        <strong class="font-bold text-lg block text-white">Booking Successful!</strong>
                        <span class="block text-sm opacity-90 mt-1">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="absolute top-4 right-4 text-green-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <h1 class="text-3xl font-extrabold text-white border-l-4 border-[#df1873] pl-4">My Tickets</h1>
                
                {{-- Tab Navigation --}}
                <div class="flex bg-[#111] p-1 rounded-lg border border-gray-800 self-start md:self-auto">
                    <button @click="tab = 'upcoming'" 
                        :class="tab === 'upcoming' ? 'bg-gray-800 text-white shadow' : 'text-gray-400 hover:text-white'"
                        class="px-4 py-2 rounded-md text-sm font-bold transition-all">
                        Upcoming
                    </button>
                    <button @click="tab = 'past'" 
                        :class="tab === 'past' ? 'bg-gray-800 text-white shadow' : 'text-gray-400 hover:text-white'"
                        class="px-4 py-2 rounded-md text-sm font-bold transition-all">
                        Past & Cancelled
                    </button>
                </div>
            </div>

            {{-- Upcoming Tab --}}
            <div x-show="tab === 'upcoming'" x-transition.opacity>
                @php
                    $upcomingBookings = $bookings->filter(function($b) {
                        $dt = \Carbon\Carbon::parse($b->showtime->date . ' ' . $b->showtime->start_time);
                        return $dt->isFuture() && $b->status !== 'cancelled';
                    });
                @endphp

                @if($upcomingBookings->isEmpty())
                <div class="bg-[#111] rounded-2xl p-10 text-center border border-gray-800">
                    <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">No Tickets Yet</h3>
                    <p class="text-gray-500 mb-6">You haven't booked any movie tickets yet.</p>
                    <a href="{{ route('home') }}" class="inline-block bg-[#df1873] hover:bg-[#c21463] text-white px-8 py-3 rounded-xl font-bold transition-colors">
                        Book Now
                    </a>
                </div>
                @else
                <div class="space-y-6">
                    @foreach($upcomingBookings as $booking)
                        <x-ticket-card :booking="$booking" />
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Past Tab --}}
            <div x-show="tab === 'past'" style="display: none;" x-transition.opacity>
                @php
                    $pastBookings = $bookings->filter(function($b) {
                        $dt = \Carbon\Carbon::parse($b->showtime->date . ' ' . $b->showtime->start_time);
                        return $dt->isPast() || $b->status === 'cancelled';
                    });
                @endphp

                @if($pastBookings->isEmpty())
                    <div class="bg-[#111] rounded-2xl p-10 text-center border border-gray-800">
                        <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">No Past Tickets</h3>
                        <p class="text-gray-500">You don't have any past or cancelled bookings.</p>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($pastBookings as $booking)
                            @if($booking->status === 'cancelled')
                            <div class="bg-[#111] rounded-2xl overflow-hidden border border-gray-800 opacity-75 hover:opacity-100 transition-all shadow-lg flex flex-col md:flex-row grayscale-[50%] hover:grayscale-0">
                                
                                {{-- Movie Poster --}}
                                <div class="w-full md:w-48 h-64 md:h-auto relative shrink-0">
                                    @if($booking->showtime->movie->imagePath)
                                        <img src="{{ asset('storage/' . $booking->showtime->movie->imagePath) }}" alt="Poster" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                            <span class="text-gray-600 text-xs">No Poster</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                        <span class="bg-red-600/80 text-white text-xs font-bold px-3 py-1 rounded -rotate-12 border border-red-500">CANCELLED</span>
                                    </div>
                                </div>

                                {{-- Ticket Details --}}
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h2 class="text-2xl font-bold text-gray-300 mb-1 line-through decoration-red-500/50">{{ $booking->showtime->movie->title }}</h2>
                                                <p class="text-gray-500 text-sm flex items-center gap-2">
                                                    {{ $booking->showtime->cinemaHall->cinema->name }} &bull; {{ $booking->showtime->cinemaHall->name }}
                                                </p>
                                            </div>
                                            <div class="text-right hidden md:block">
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-red-900/30 text-red-400 border border-red-800">
                                                    Cancelled
                                                </span>
                                                <p class="text-gray-500 text-[10px] mt-2 font-mono">REF: {{ $booking->booking_reference }}</p>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-6 mb-6">
                                            <div>
                                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Date & Time</p>
                                                <p class="text-gray-400 font-medium">
                                                    {{ \Carbon\Carbon::parse($booking->showtime->date)->format('D, d M Y') }}
                                                    <br>
                                                    <span>{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }}</span>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Seats ({{ $booking->tickets->count() }})</p>
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($booking->tickets as $ticket)
                                                        <span class="bg-gray-800 text-gray-500 text-xs px-2 py-1 rounded border border-gray-700 font-bold">{{ $ticket->seat->seat_code }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-end mt-6 pt-4 border-t border-gray-800 border-dashed">
                                        <div class="flex flex-col gap-2">
                                            <div class="md:hidden">
                                                <p class="text-gray-500 text-[10px] font-mono">REF: {{ $booking->booking_reference }}</p>
                                            </div>
                                            
                                            <a href="{{ route('booking.ticket', $booking->id) }}" target="_blank" class="text-center text-gray-400 hover:text-white text-xs font-bold border border-gray-700 bg-gray-800/50 px-3 py-1.5 rounded transition-colors">
                                                View Cancelled Ticket
                                            </a>
                                        </div>
                                        <div class="text-right ml-auto">
                                            <p class="text-xs text-gray-500 mb-1">Refund Amount</p>
                                            <p class="text-xl font-black text-gray-400">{{ number_format($booking->total_amount) }} Ks</p>
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
</x-app-layout>