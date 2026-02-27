<x-app-layout>
    <nav class="bg-[#0b1120] border-b border-gray-800 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-[70px]">
            <a href="javascript:history.back()" class="text-gray-300 hover:text-[#df1873] flex items-center gap-2 font-semibold transition">
                <span>&larr; Back</span>
            </a>
            <div class="text-center">
                <h1 class="text-lg font-bold text-white">Add Snacks & Beverages</h1>
                <p class="text-xs text-gray-400 font-medium">{{ count($seats) }} Seat(s) Selected</p>
            </div>
            <a href="#" class="text-gray-400 hover:text-white text-sm font-semibold transition">Skip</a>
        </div>
    </nav>

    <div x-data="foodCart({{ $seatTotal }})" class="bg-[#0b1120] min-h-screen pb-40 pt-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($foodItems as $item)
                <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden hover:border-gray-700 transition duration-300">
                    <div class="h-48 bg-gray-800 relative">
                        @if($item->imagePath)
                        <img src="{{ asset('storage/' . $item->imagePath) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-gray-600">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-white mb-1">{{ $item->name }}</h3>
                        <p class="text-xs text-gray-400 mb-4 line-clamp-2">{{ $item->description ?? 'Delicious cinematic snacks.' }}</p>

                        <div class="flex justify-between items-center">
                            <span class="text-lg font-extrabold text-[#df1873]">{{ number_format($item->price) }} Ks</span>

                            <div class="flex items-center gap-3 bg-gray-800 rounded-lg p-1">
                                <button @click="decreaseItem({{ $item->id }}, {{ $item->price }})" class="w-8 h-8 rounded-md bg-gray-700 text-white flex items-center justify-center hover:bg-gray-600 transition disabled:opacity-50" :disabled="!getQuantity({{ $item->id }})">
                                    -
                                </button>
                                <span class="w-4 text-center text-sm font-bold text-white" x-text="getQuantity({{ $item->id }})"></span>
                                <button @click="increaseItem({{ $item->id }}, {{ $item->price }})" class="w-8 h-8 rounded-md bg-[#df1873] text-white flex items-center justify-center hover:bg-[#c21463] transition">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20 text-gray-500">
                    <p>No food items available at the moment.</p>
                </div>
                @endforelse
            </div>

        </div>

        <div class="fixed bottom-0 left-0 w-full bg-[#1e293b] text-white p-4 shadow-[0_-10px_30px_rgba(0,0,0,0.8)] z-50 border-t border-gray-800">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8">

                <div class="flex gap-8">
                    <div class="hidden sm:block">
                        <p class="text-xs text-gray-400 font-bold mb-1">Seats Total</p>
                        <p class="text-lg font-bold text-white">{{ number_format($seatTotal) }} Ks</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-bold mb-1">F&B Total</p>
                        <p class="text-lg font-bold text-[#df1873]" x-text="foodTotal.toLocaleString() + ' Ks'"></p>
                    </div>
                </div>

                <div class="flex items-center gap-4 md:gap-8">
                    <div class="text-right">
                        <p class="text-xs text-gray-400 font-bold mb-1">Grand Total</p>
                        <p class="text-2xl font-black text-[#df1873]" x-text="grandTotal().toLocaleString() + ' Ks'"></p>
                    </div>
                    <form action="{{ route('book.process-food', $showtime->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="food_cart" :value="JSON.stringify(cart)">

                        <button type="submit" class="bg-[#df1873] hover:bg-[#c21463] text-white px-6 md:px-10 py-3 rounded-xl font-bold text-base md:text-lg shadow-[0_4px_15px_rgba(223,24,115,0.4)] transition transform hover:-translate-y-1 active:scale-95">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('foodCart', (initialSeatTotal) => ({
                seatTotal: initialSeatTotal,
                foodTotal: 0,
                cart: {}, // Format: { id: quantity }

                getQuantity(id) {
                    return this.cart[id] || 0;
                },

                increaseItem(id, price) {
                    if (!this.cart[id]) {
                        this.cart[id] = 0;
                    }
                    this.cart[id]++;
                    this.calculateFoodTotal(price, true);
                },

                decreaseItem(id, price) {
                    if (this.cart[id] && this.cart[id] > 0) {
                        this.cart[id]--;
                        this.calculateFoodTotal(price, false);

                        if (this.cart[id] === 0) {
                            delete this.cart[id];
                        }
                    }
                },

                calculateFoodTotal(price, isAdding) {
                    if (isAdding) {
                        this.foodTotal += price;
                    } else {
                        this.foodTotal -= price;
                    }
                },

                grandTotal() {
                    return this.seatTotal + this.foodTotal;
                }
            }))
        })
    </script>
</x-app-layout>