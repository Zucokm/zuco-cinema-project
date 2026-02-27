<x-app-layout>
    <nav class="bg-[#0b1120] border-b border-gray-800 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-[70px]">
            <a href="{{ route('movie.details', $showtime->movie_id) }}" class="text-gray-300 hover:text-[#df1873] flex items-center gap-2 font-semibold transition">
                <span>&larr; Back</span>
            </a>
            <div class="text-center">
                <h1 class="text-lg font-bold text-white">{{ $showtime->movie->title }}</h1>
            </div>
            <div class="w-16"></div>
        </div>
    </nav>

    <div x-data="seatSelection()" class="bg-[#0b1120] min-h-screen pb-40 pt-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-16 text-center">
                <div class="w-1/2 mx-auto h-8 border-t-[4px] border-[#df1873] rounded-t-[50%] opacity-80 shadow-[0_-10px_30px_rgba(223,24,115,0.2)]"></div>
                <p class="text-gray-500 text-[10px] font-bold tracking-[0.4em] uppercase mt-2">SCREEN</p>
            </div>

            <div class="flex flex-col items-center gap-4 overflow-x-auto pb-10">
                @foreach($seatsByRow as $row => $seats)
                @php
                    // Define styles map at the top of the loop or in a View Composer
                    $seatStyles = [
                        1 => [ // VIP
                            'base' => 'w-10 h-10 bg-yellow-400 text-black border-yellow-600 hover:bg-yellow-300',
                        ],
                        4 => [ // Couple
                            'base' => 'w-[80px] h-10 bg-pink-500 text-white border-pink-700 hover:bg-pink-400',
                        ],
                        3 => [ // Good
                            'base' => 'w-10 h-10 bg-green-500 text-white border-green-700 hover:bg-green-400',
                        ],
                        'default' => [ // Standard
                            'base' => 'w-10 h-10 bg-blue-600 text-white border-blue-800 hover:bg-blue-500',
                        ]
                    ];
                @endphp
                <div class="flex items-center gap-4">
                    <span class="w-6 text-center text-gray-400 font-bold text-sm">{{ $row }}</span>

                    <div class="flex gap-2">
                        @foreach($seats as $seat)
                        @php
                        $isBooked = in_array($seat->id, $bookedSeatIds);

                        // FIX: Check the seat_type_id directly from the seats table
                        // ID 1 = VIP, ID 2 = Standard, ID 3 = Good, ID 4 = Couple
                        $typeId = $seat->seat_type_id;

                        // Default price fallback if relationship fails
                        $seatPrice = $seat->seatType ? $seat->seatType->price : 5000;

                        $style = $seatStyles[$typeId] ?? $seatStyles['default'];
                        $baseClass = $style['base'];
                        $selectedClass = str_replace(['w-10', 'w-[80px]'], '', $baseClass) . ' ' . ($typeId == 4 ? 'w-[80px]' : 'w-10') . ' h-10 bg-[#df1873] border-[#a81055] text-white scale-110 shadow-[0_0_15px_rgba(223,24,115,0.8)] z-10';

                        if ($isBooked) {
                            $baseClass = 'w-10 h-10 bg-gray-700 text-gray-400 opacity-50 cursor-not-allowed border-gray-900';
                            $selectedClass = $baseClass;
                        }
                        @endphp

                        <button
                            @if($isBooked) disabled @endif
                            @click="toggleSeat({{ $seat->id }}, '{{ $seat->seat_code }}', {{ $seatPrice }})"
                            class="flex items-center justify-center text-xs font-bold rounded-t-lg border-b-[4px] transition-all duration-200 active:scale-95"
                            :class="isSelected({{ $seat->id }}) ? '{{ $selectedClass }}' : '{{ $baseClass }}'">
                            {{ $seat->seat_code }}
                        </button>
                        @endforeach
                    </div>

                    <span class="w-6 text-center text-gray-400 font-bold text-sm">{{ $row }}</span>
                </div>
                @endforeach
            </div>

            <div class="flex flex-wrap justify-center gap-6 mt-10 border-t border-gray-800 pt-8 pb-10">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-gray-700 rounded-t border-b-[3px] border-gray-900"></div>
                    <span class="text-sm text-gray-300">Sold</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-[#df1873] rounded-t border-b-[3px] border-[#a81055]"></div>
                    <span class="text-sm text-white font-bold">Selected</span>
                </div>
                <div class="w-px h-6 bg-gray-700 mx-2 hidden md:block"></div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-blue-600 rounded-t border-b-[3px] border-blue-800"></div>
                    <span class="text-sm text-gray-300">Standard</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-green-500 rounded-t border-b-[3px] border-green-700"></div>
                    <span class="text-sm text-gray-300">Good</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-yellow-400 rounded-t border-b-[3px] border-yellow-600"></div>
                    <span class="text-sm text-gray-300">VIP</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-10 h-6 bg-pink-500 rounded-t border-b-[3px] border-pink-700"></div>
                    <span class="text-sm text-gray-300">Couple</span>
                </div>
            </div>

        </div>

        <div x-show="selectedSeats.length > 0" x-transition.translate.y class="fixed bottom-0 left-0 w-full bg-[#1e293b] text-white p-4 shadow-[0_-10px_30px_rgba(0,0,0,0.8)] z-50 border-t border-gray-800">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8">
                <div>
                    <p class="text-sm text-gray-400 font-bold mb-1" x-text="selectedSeats.length + ' Seat(s)'"></p>
                    <div class="flex flex-wrap gap-1.5">
                        <template x-for="seat in selectedSeats" :key="seat.id">
                            <span class="text-xs font-bold bg-gray-900 text-[#df1873] px-2.5 py-1 rounded border border-gray-700" x-text="seat.name"></span>
                        </template>
                    </div>
                </div>
                <div class="flex items-center gap-4 md:gap-8">
                    <div class="text-right hidden md:block">
                        <p class="text-xs text-gray-400 font-bold mb-1">Total Amount</p>
                        <p class="text-2xl font-black text-[#df1873]" x-text="totalPrice.toLocaleString() + ' Ks'"></p>
                    </div>
                    <form action="{{ route('book.process-seats', $showtime->id) }}" method="POST" id="bookingForm">
                        @csrf
                        <template x-for="seat in selectedSeats" :key="seat.id">
                            <input type="hidden" name="seat_ids[]" :value="seat.id">
                        </template>
                        <button type="submit" class="bg-[#df1873] hover:bg-[#c21463] text-white px-6 md:px-10 py-3 rounded-xl font-bold text-base md:text-lg shadow-[0_4px_15px_rgba(223,24,115,0.4)] transition transform hover:-translate-y-1 active:scale-95 flex items-center gap-2">
                            <span>Pay</span>
                            <span class="md:hidden" x-text="totalPrice.toLocaleString() + ' Ks'"></span>
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