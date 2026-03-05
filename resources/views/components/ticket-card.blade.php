@props(['booking'])

@php
    $statusColor = match($booking->status) {
        'confirmed' => 'border-green-500/30 shadow-green-900/10',
        'pending' => 'border-yellow-500/30 shadow-yellow-900/10',
        default => 'border-gray-800'
    };
@endphp

<div class="bg-[#111] rounded-2xl overflow-hidden border {{ $statusColor }} hover:border-opacity-100 transition-all shadow-lg flex flex-col md:flex-row group">
    
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
        <div class="absolute top-3 left-3 md:hidden">
            <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider shadow-sm
                {{ $booking->status === 'confirmed' ? 'bg-green-500 text-black' : 
                  ($booking->status === 'pending' ? 'bg-yellow-500 text-black' : 'bg-gray-500 text-white') }}">
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
                        {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 
                          ($booking->status === 'pending' ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' : 'bg-gray-800 text-gray-400') }}">
                        {{ $booking->status === 'checked-in' ? 'Used' : $booking->status }}
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
                    
                    // Controller Logic အတိုင်း Button ပြမယ့် Condition ကို ပြင်ဆင်ခြင်း
                    if ($booking->status === 'confirmed') {
                        $isCancellable = $showtimeDate->copy()->subHour()->isFuture();
                    } else {
                        $isCancellable = $booking->status !== 'cancelled' && $showtimeDate->isFuture();
                    }
                @endphp

                <a href="{{ route('booking.ticket', $booking->id) }}" target="_blank" class="text-center text-white hover:text-white text-xs font-bold border border-gray-600 bg-gray-800 hover:bg-[#df1873] hover:border-[#df1873] px-4 py-2 rounded-lg transition-all shadow-sm">
                    View Ticket
                </a>

                @if($isCancellable)
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.');">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-white text-xs font-bold border border-red-900/50 bg-red-900/10 px-4 py-2 rounded-lg transition-colors hover:bg-red-600 hover:border-red-600 w-full">
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
