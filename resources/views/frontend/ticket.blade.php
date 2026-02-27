<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket - {{ $booking->booking_reference }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap');
        body { font-family: 'Space Mono', monospace; }
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .ticket-container { box-shadow: none; border: 1px solid #000; }
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen flex flex-col items-center justify-center p-4 text-gray-800">

    <div class="ticket-container max-w-sm w-full bg-white shadow-2xl rounded-sm overflow-hidden relative">
        @if($booking->status === 'cancelled')
            <div class="absolute inset-0 z-50 flex items-center justify-center pointer-events-none">
                <span class="text-red-500/30 text-5xl font-black -rotate-45 border-4 border-red-500/30 px-4 py-2 rounded-xl uppercase tracking-widest">
                    CANCELLED
                </span>
            </div>
        @endif

        <!-- Header -->
        <div class="bg-black text-white p-6 text-center border-b-4 border-[#df1873] relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-2xl font-bold tracking-widest">ZUCO CINEMA</h1>
                <p class="text-xs text-gray-400 mt-1">ADMIT ONE</p>
            </div>
            <!-- Decorative circles -->
            <div class="absolute -left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-gray-900 rounded-full"></div>
            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 w-6 h-6 bg-gray-900 rounded-full"></div>
        </div>

        <!-- Movie Info -->
        <div class="p-6 pb-0 text-center">
            <h2 class="text-xl font-bold uppercase leading-tight mb-2">{{ $booking->showtime->movie->title }}</h2>
            <p class="text-sm text-gray-500">{{ $booking->showtime->movie->language }} | {{ $booking->showtime->movie->duration }} Mins</p>
        </div>

        <!-- Details Grid -->
        <div class="p-6 space-y-4">
            <div class="flex justify-between border-b border-dashed border-gray-300 pb-2">
                <div class="text-left">
                    <p class="text-xs text-gray-500 uppercase">Date</p>
                    <p class="font-bold">{{ \Carbon\Carbon::parse($booking->showtime->date)->format('d M Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase">Time</p>
                    <p class="font-bold text-[#df1873]">{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('h:i A') }}</p>
                </div>
            </div>

            <div class="flex justify-between border-b border-dashed border-gray-300 pb-2">
                <div class="text-left">
                    <p class="text-xs text-gray-500 uppercase">Cinema</p>
                    <p class="font-bold">{{ $booking->showtime->cinemaHall->cinema->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase">Hall</p>
                    <p class="font-bold">{{ $booking->showtime->cinemaHall->name }}</p>
                </div>
            </div>

            <div class="text-center py-2">
                <p class="text-xs text-gray-500 uppercase mb-1">Seats</p>
                <div class="flex flex-wrap justify-center gap-2">
                    @foreach($booking->tickets as $ticket)
                        <span class="bg-black text-white px-2 py-1 text-sm font-bold rounded">{{ $ticket->seat->seat_code }}</span>
                    @endforeach
                </div>
            </div>
            
            @if($booking->foodOrders->isNotEmpty())
            <div class="border-t border-dashed border-gray-300 pt-2">
                <p class="text-xs text-gray-500 uppercase mb-1">Extras</p>
                <p class="text-xs font-bold">
                    @foreach($booking->foodOrders as $order)
                        @foreach($order->orderItems as $item)
                            {{ $item->quantity }}x {{ $item->foodItem->name }}@if(!$loop->last), @endif
                        @endforeach
                    @endforeach
                </p>
            </div>
            @endif
        </div>

        <!-- Footer / Barcode -->
        <div class="bg-gray-100 p-6 text-center border-t border-gray-200 relative">
             <!-- Decorative circles -->
             <div class="absolute -left-3 top-0 transform -translate-y-1/2 w-6 h-6 bg-gray-900 rounded-full"></div>
             <div class="absolute -right-3 top-0 transform -translate-y-1/2 w-6 h-6 bg-gray-900 rounded-full"></div>

            <div class="mb-2">
                <p class="text-xs text-gray-500 mb-1">Booking Reference</p>
                <p class="text-lg font-bold tracking-widest">{{ $booking->booking_reference }}</p>
            </div>
            
            <!-- Fake Barcode -->
            <div class="h-12 bg-black w-3/4 mx-auto mt-4" style="mask-image: repeating-linear-gradient(90deg, black, black 2px, transparent 2px, transparent 4px);"></div>
            <p class="text-[10px] text-gray-400 mt-2">Scan this at the entrance</p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-8 flex gap-4 no-print">
        <button onclick="window.print()" class="bg-[#df1873] hover:bg-[#c21463] text-white px-6 py-3 rounded-full font-bold shadow-lg transition transform hover:-translate-y-1 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Download / Print
        </button>
        <a href="{{ route('my-tickets') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-full font-bold shadow-lg transition transform hover:-translate-y-1">
            Back
        </a>
    </div>

</body>
</html>