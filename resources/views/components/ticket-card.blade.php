@props(['booking'])

@php
    $statusColor = match($booking->status) {
        'confirmed' => 'border-green-500/30 shadow-green-900/10',
        'pending' => 'border-yellow-500/30 shadow-yellow-900/10',
        default => 'border-gray-800'
    };
@endphp

<div class="bg-[#111] rounded-2xl overflow-hidden border {{ $statusColor }} hover:border-gray-600 transition-all shadow-lg flex flex-col md:flex-row group">
    
    {{-- Movie Poster --}}
    <div class="w-full md:w-56 h-72 md:h-auto relative shrink-0">
        @if($booking->showtime->movie->imagePath)
            <img src="{{ str_starts_with($booking->showtime->movie->imagePath, 'http') ? $booking->showtime->movie->imagePath : asset('storage/' . $booking->showtime->movie->imagePath) }}" alt="Poster" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                <span class="text-gray-500 text-sm font-medium">No Poster Available</span>
            </div>
        @endif
        
        {{-- Mobile Status Badge --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent md:hidden"></div>
        <div class="absolute top-4 left-4 md:hidden">
            <span class="px-3 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-wider shadow-md backdrop-blur-sm
                {{ $booking->status === 'confirmed' ? 'bg-green-500/90 text-black' : 
                  ($booking->status === 'pending' ? 'bg-yellow-500/90 text-black' : 'bg-gray-600/90 text-white') }}">
                {{ $booking->status }}
            </span>
        </div>
    </div>

    {{-- Ticket Details --}}
    <div class="p-6 flex-1 flex flex-col justify-between">
        <div>
            {{-- Header: Title, Cinema, & Status (Desktop) --}}
            <div class="flex justify-between items-start mb-6 gap-4">
                <div class="flex-1">
                    <h2 class="text-2xl font-black text-white mb-2 leading-tight">{{ $booking->showtime->movie->title }}</h2>
                    <p class="text-gray-400 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>{{ $booking->showtime->cinemaHall->cinema->name }} &bull; <span class="text-gray-300">{{ $booking->showtime->cinemaHall->name }}</span></span>
                    </p>
                </div>
                <div class="text-right hidden md:block shrink-0">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider 
                        {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 
                          ($booking->status === 'pending' ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' : 'bg-gray-800 text-gray-400') }}">
                        {{ $booking->status === 'checked-in' ? 'Used' : $booking->status }}
                    </span>
                    <p class="text-gray-500 text-[10px] mt-2 font-mono tracking-widest">REF: {{ $booking->booking_reference }}</p>
                </div>
            </div>

            {{-- Info Grid: Date, Time, Seats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6 bg-gray-900/50 p-4 rounded-xl border border-gray-800/50">
                <div>
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-1">Date & Time</p>
                    <p class="text-white font-medium text-sm">
                        {{ \Carbon\Carbon::parse($booking->showtime->date)->format('D, d M Y') }}
                        <span class="mx-2 text-gray-600">|</span>
                        <span class="text-[#df1873] font-bold">{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }}</span>
                    </p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-2">Seats ({{ $booking->tickets->count() }})</p>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($booking->tickets as $ticket)
                            <span class="bg-gray-800 text-gray-200 text-xs px-2.5 py-1 rounded border border-gray-700 font-bold shadow-sm">{{ $ticket->seat->seat_code }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Snacks & Drinks Section --}}
            @if($booking->foodOrders->isNotEmpty())
                <div class="mb-6">
                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-2 flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Snacks & Drinks
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($booking->foodOrders as $order)
                            @foreach($order->orderItems as $item)
                                <div class="bg-gray-800/50 border border-gray-700/50 rounded-md px-3 py-1.5 flex items-center gap-2">
                                    <span class="bg-gray-700 text-white text-xs font-bold px-1.5 py-0.5 rounded">{{ $item->quantity }}x</span>
                                    <span class="text-sm text-gray-300">{{ $item->foodItem->name }}</span>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Footer: Actions & Total --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mt-4 pt-5 border-t border-gray-800 border-dashed gap-4 sm:gap-0">
            
            {{-- Mobile Ref --}}
            <div class="w-full text-center mb-2 md:hidden">
                <p class="text-gray-500 text-[10px] font-mono tracking-widest">REF: {{ $booking->booking_reference }}</p>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto justify-center sm:justify-start">
                
                @php
                    $showtimeDate = \Carbon\Carbon::parse($booking->showtime->date . ' ' . $booking->showtime->start_time);
                    if ($booking->status === 'confirmed') {
                        $isCancellable = $showtimeDate->copy()->subHour()->isFuture();
                    } else {
                        $isCancellable = $booking->status !== 'cancelled' && $showtimeDate->isFuture();
                    }
                @endphp

                <a href="{{ route('booking.ticket', $booking->id) }}" target="_blank" 
                   class="inline-flex items-center justify-center gap-2 text-white text-xs font-bold border border-gray-600 bg-gray-800 hover:bg-[#df1873] hover:border-[#df1873] px-5 py-2.5 rounded-lg transition-all shadow-sm flex-1 sm:flex-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    View Ticket
                </a>

                @if($isCancellable)
                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" class="flex-1 sm:flex-none m-0" onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.');">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 text-red-400 hover:text-white text-xs font-bold border border-red-900/50 bg-red-900/10 px-5 py-2.5 rounded-lg transition-colors hover:bg-red-600 hover:border-red-600 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Cancel
                        </button>
                    </form>
                @endif
            </div>

            {{-- Total Amount --}}
            <div class="text-center sm:text-right w-full sm:w-auto">
                <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider mb-0.5">Total Amount</p>
                <p class="text-2xl font-black text-[#df1873]">{{ number_format($booking->total_amount) }} <span class="text-sm font-bold text-gray-400">Ks</span></p>
            </div>
        </div>
    </div>
</div>