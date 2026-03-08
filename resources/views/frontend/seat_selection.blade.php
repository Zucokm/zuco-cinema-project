<x-app-layout>
    <style>
        .perspective-3d {
            transform: perspective(1000px) rotateX(-15deg) scale(0.9);
            box-shadow: 0 25px 50px -12px rgba(255, 255, 255, 0.15);
        }
        .screen-glow {
            background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 100%);
        }
        .seat-shadow {
            box-shadow: 0 1px 2px rgba(0,0,0,0.5), inset 0 1px 1px rgba(255,255,255,0.1);
        }
        .seat-selected {
            box-shadow: 0 0 15px #df1873, 0 0 30px rgba(223, 24, 115, 0.4);
        }
        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <nav class="bg-[#0a0a0a]/90 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-[70px]">
            <a href="{{ (Auth::check() && Auth::user()->role === 'admin') ? route('admin.pos') : route('movie.details', $showtime->movie_id) }}" class="text-gray-300 hover:text-[#df1873] flex items-center gap-2 font-semibold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span class="hidden sm:inline">Back</span>
            </a>
            <div class="text-center">
                <h1 class="text-base md:text-lg font-bold text-white tracking-wide">{{ $showtime->movie->title }}</h1>
                <p class="text-[10px] md:text-xs text-gray-400 font-medium">{{ $showtime->cinemaHall->name }} • {{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</p>
            </div>
            <div class="w-10 sm:w-16"></div>
        </div>
    </nav>

    <div x-data="seatSelection()" class="bg-[#0a0a0a] min-h-screen pb-40 pt-12 select-none overflow-hidden">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Screen Section -->
            <div class="mb-20 relative flex justify-center">
                <div class="w-full max-w-3xl">
                    <div class="h-16 w-full screen-glow rounded-[50%] perspective-3d border-t-4 border-white/20"></div>
                    <div class="text-center mt-8">
                        <p class="text-gray-600 text-[10px] font-bold tracking-[0.6em] uppercase text-shadow-sm">SCREEN</p>
                    </div>
                </div>
            </div>

            <!-- Seats Container -->
            <div class="overflow-x-auto no-scrollbar pb-12 px-4">
                <div class="min-w-max mx-auto flex flex-col gap-3 md:gap-4">
                    @foreach($seatsByRow as $row => $seats)
                    <div class="flex items-center justify-center gap-6 md:gap-10">
                        <!-- Row Label Left -->
                        <span class="w-6 text-right text-gray-500 font-bold text-xs md:text-sm opacity-50">{{ $row }}</span>

                        <div class="flex gap-1.5 md:gap-3">
                            @foreach($seats as $seat)
                            @php
                                $isBooked = in_array($seat->id, $bookedSeatIds);
                                $typeName = $seat->seatType->name ?? 'Standard';
                                $price = $seat->seatType ? $seat->seatType->price : 5000;

                                // Seat Styling Logic
                                $baseClasses = "relative flex items-center justify-center rounded-t-lg rounded-b-md transition-all duration-300 transform hover:-translate-y-1 seat-shadow group";
                                $colorClasses = match($typeName) {
                                    'VIP' => 'bg-gradient-to-b from-yellow-500 to-yellow-600 border-b-4 border-yellow-800 text-black',
                                    'Couple' => 'bg-gradient-to-b from-pink-500 to-pink-600 border-b-4 border-pink-800 text-white',
                                    'Premium' => 'bg-gradient-to-b from-purple-500 to-purple-600 border-b-4 border-purple-800 text-white',
                                    'Good' => 'bg-gradient-to-b from-green-500 to-green-600 border-b-4 border-green-800 text-white',
                                    default => 'bg-gradient-to-b from-gray-600 to-gray-700 border-b-4 border-gray-900 text-gray-200',
                                };
                                
                                $sizeClasses = ($typeName == 'Couple') ? 'w-16 md:w-20 h-10 md:h-12' : 'w-8 md:w-10 h-8 md:h-10';
                                
                                if ($isBooked) {
                                    $colorClasses = 'bg-gray-800 border-b-4 border-gray-900 text-gray-600 cursor-not-allowed opacity-60';
                                    $baseClasses = str_replace('hover:-translate-y-1', '', $baseClasses);
                                }
                            @endphp

                            <button
                                @if($isBooked) disabled @endif
                                @click="toggleSeat({{ $seat->id }}, '{{ $seat->seat_code }}', {{ $price }})"
                                class="{{ $baseClasses }} {{ $sizeClasses }}"
                                :class="isSelected({{ $seat->id }}) ? 'bg-gradient-to-b from-[#df1873] to-[#c21463] border-[#8a0f4a] text-white seat-selected scale-110 z-10' : '{{ $colorClasses }}'"
                                title="{{ $typeName }} - {{ number_format($price) }} Ks">
                                
                                <span class="text-[10px] md:text-xs font-bold">{{ $seat->seat_code }}</span>
                                
                                <!-- Armrest Simulation -->
                                <div class="absolute -bottom-1 -left-1 w-1 h-4 bg-black/20 rounded-full" :class="isSelected({{ $seat->id }}) ? 'hidden' : ''"></div>
                                <div class="absolute -bottom-1 -right-1 w-1 h-4 bg-black/20 rounded-full" :class="isSelected({{ $seat->id }}) ? 'hidden' : ''"></div>
                            </button>
                            @endforeach
                        </div>

                        <!-- Row Label Right -->
                        <span class="w-6 text-left text-gray-500 font-bold text-xs md:text-sm opacity-50">{{ $row }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Legend -->
            <div class="max-w-4xl mx-auto mt-8 border-t border-gray-800/50 pt-8">
                <div class="flex flex-wrap justify-center gap-x-8 gap-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-gray-800 rounded-t border-b-4 border-gray-900 opacity-60"></div>
                        <span class="text-xs text-gray-400 font-medium">Sold</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-[#df1873] rounded-t border-b-4 border-[#a81055] seat-selected"></div>
                        <span class="text-xs text-white font-bold">Selected</span>
                    </div>
                    <div class="w-px h-6 bg-gray-800 hidden sm:block"></div>
                    
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-gray-600 rounded-t border-b-4 border-gray-900"></div>
                        <span class="text-xs text-gray-400">Standard</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-green-500 rounded-t border-b-4 border-green-800"></div>
                        <span class="text-xs text-gray-400">Good</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-purple-500 rounded-t border-b-4 border-purple-800"></div>
                        <span class="text-xs text-gray-400">Premium</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 bg-yellow-500 rounded-t border-b-4 border-yellow-800"></div>
                        <span class="text-xs text-gray-400">VIP</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-6 bg-pink-500 rounded-t border-b-4 border-pink-800"></div>
                        <span class="text-xs text-gray-400">Couple</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Floating Checkout Bar -->
        <div x-show="selectedSeats.length > 0" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-full opacity-0"
             class="fixed bottom-6 left-4 right-4 md:left-auto md:right-auto md:w-full md:max-w-3xl md:mx-auto z-50">
            
            <div class="bg-[#1e293b]/90 backdrop-blur-xl text-white p-4 rounded-2xl shadow-2xl border border-white/10 flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-400 font-bold mb-1 uppercase tracking-wider" x-text="selectedSeats.length + ' SEATS SELECTED'"></p>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="seat in selectedSeats" :key="seat.id">
                            <span class="text-sm font-black text-white" x-text="seat.name"></span>
                        </template>
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs text-gray-400 font-bold mb-0.5">TOTAL</p>
                        <p class="text-xl font-black text-[#df1873]" x-text="totalPrice.toLocaleString() + ' Ks'"></p>
                    </div>
                    <form action="{{ route('book.process-seats', $showtime->id) }}" method="POST" id="bookingForm">
                        @csrf
                        <template x-for="seat in selectedSeats" :key="seat.id">
                            <input type="hidden" name="seat_ids[]" :value="seat.id">
                        </template>
                        <button type="submit" class="bg-[#df1873] hover:bg-[#c21463] text-white px-8 py-3 rounded-xl font-bold text-base shadow-lg shadow-[#df1873]/30 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center gap-2">
                            <span>Continue</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('seatSelection', () => ({
                selectedSeats: [],
                totalPrice: 0,
                maxSeats: 8,
                toggleSeat(id, name, price) {
                    const index = this.selectedSeats.findIndex(s => s.id === id);
                    if (index > -1) {
                        this.selectedSeats.splice(index, 1);
                        this.totalPrice -= price;
                    } else {
                        if (this.selectedSeats.length >= this.maxSeats) {
                            alert('You can only select up to ' + this.maxSeats + ' seats per transaction.');
                            return;
                        }
                        this.selectedSeats.push({
                            id,
                            name,
                            price
                        });
                        this.totalPrice += price;
                    }
                },
                isSelected(id) {
                    return this.selectedSeats.some(s => s.id === id);
                }
            }))
        })
    </script>
</x-app-layout>