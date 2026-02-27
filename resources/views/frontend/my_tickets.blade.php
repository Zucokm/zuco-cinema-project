<x-app-layout>
    <div class="bg-[#0a0a0a] min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <h1 class="text-3xl font-extrabold text-white mb-8 border-l-4 border-[#df1873] pl-4">My Tickets</h1>

            @if($bookings->isEmpty())
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
                    @foreach($bookings as $booking)
                        <div class="bg-[#111] rounded-2xl overflow-hidden border border-gray-800 hover:border-gray-700 transition-all shadow-lg flex flex-col md:flex-row">
                            
                            {{-- Movie Poster --}}
                            <div class="w-full md:w-48 h-64 md:h-auto relative shrink-0">
                                @if($booking->showtime->movie->imagePath)
                                    <img src="{{ asset('storage/' . $booking->showtime->movie->imagePath) }}" alt="Poster" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                        <span class="text-gray-600 text-xs">No Poster</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent md:hidden"></div>
                                <div class="absolute bottom-4 left-4 md:hidden">
                                    <span class="bg-[#df1873] text-white text-xs font-bold px-2 py-1 rounded">
                                        {{ $booking->status }}
                                    </span>
                                </div>
                            </div>

                            {{-- Ticket Details --}}
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h2 class="text-2xl font-bold text-white mb-1">{{ $booking->showtime->movie->title }}</h2>
                                            <p class="text-gray-400 text-sm flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $booking->showtime->cinemaHall->cinema->name }} &bull; {{ $booking->showtime->cinemaHall->name }}
                                            </p>
                                        </div>
                                        <div class="text-right hidden md:block">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider 
                                                {{ $booking->status === 'confirmed' ? 'bg-green-900/30 text-green-400 border border-green-800' : ($booking->status === 'cancelled' ? 'bg-red-900/30 text-red-400 border border-red-800' : 'bg-yellow-900/30 text-yellow-400 border border-yellow-800') }}">
                                                {{ $booking->status }}
                                            </span>
                                            <p class="text-gray-500 text-[10px] mt-2 font-mono">REF: {{ $booking->booking_reference }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-bold mb-1">Date & Time</p>
                                            <p class="text-white font-medium">
                                                {{ \Carbon\Carbon::parse($booking->showtime->date)->format('D, d M Y') }}
                                                <br>
                                                <span class="text-[#df1873]">{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }}</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-bold mb-1">Seats ({{ $booking->tickets->count() }})</p>
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($booking->tickets as $ticket)
                                                    <span class="bg-gray-800 text-gray-300 text-xs px-2 py-1 rounded border border-gray-700 font-bold">{{ $ticket->seat->seat_code }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    @if($booking->foodOrders->isNotEmpty())
                                        <div class="border-t border-gray-800 pt-4 mt-4">
                                            <p class="text-xs text-gray-500 uppercase font-bold mb-2">Snacks & Drinks</p>
                                            <ul class="text-sm text-gray-300 space-y-1">
                                                @foreach($booking->foodOrders as $order)
                                                    @foreach($order->orderItems as $item)
                                                        <li class="flex justify-between w-full md:w-1/2">
                                                            <span>{{ $item->quantity }}x {{ $item->foodItem->name }}</span>
                                                        </li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex justify-between items-end mt-6 pt-4 border-t border-gray-800 border-dashed">
                                    <div class="flex flex-col gap-2">
                                        <div class="md:hidden">
                                            <p class="text-gray-500 text-[10px] font-mono">REF: {{ $booking->booking_reference }}</p>
                                        </div>

                                        @php
                                            $showtimeDate = \Carbon\Carbon::parse($booking->showtime->date . ' ' . $booking->showtime->start_time);
                                            $isCancellable = $booking->status !== 'cancelled' && $showtimeDate->isFuture();
                                        @endphp

                                        <a href="{{ route('booking.ticket', $booking->id) }}" target="_blank" class="text-center text-white hover:text-[#df1873] text-xs font-bold border border-gray-600 bg-gray-800 px-3 py-1.5 rounded transition-colors hover:border-[#df1873]">
                                            View Ticket
                                        </a>

                                        @if($isCancellable)
                                            <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.');">
                                                @csrf
                                                <button type="submit" class="text-red-500 hover:text-red-400 text-xs font-bold border border-red-900 bg-red-900/10 px-3 py-1.5 rounded transition-colors hover:bg-red-900/20">
                                                    Cancel Booking
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="text-right ml-auto">
                                        <p class="text-xs text-gray-500 mb-1">Total Amount</p>
                                        <p class="text-xl font-black text-[#df1873]">{{ number_format($booking->total_amount) }} Ks</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>