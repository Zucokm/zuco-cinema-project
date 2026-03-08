<x-app-layout>
    <style>
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.5, 0, 0, 1);
        }
        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        /* Clean scrollbar */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <nav class="bg-[#0a0a0a]/90 backdrop-blur-xl border-b border-gray-800 sticky top-[70px] z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-[75px]">
            <a href="javascript:history.back()" class="text-gray-400 hover:text-white flex items-center gap-2 font-bold transition-colors group">
                <div class="bg-gray-900 p-2 rounded-xl group-hover:bg-[#df1873]/20 group-hover:text-[#df1873] transition-colors border border-gray-800 group-hover:border-[#df1873]/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                <span class="hidden sm:inline">Back to Seats</span>
            </a>
            
            <div class="text-center">
                <h1 class="text-xl font-black text-white tracking-tight">Complete Your Experience</h1>
                <div class="flex items-center justify-center gap-2 mt-0.5 text-xs font-bold text-[#df1873] uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-[#df1873] animate-pulse shadow-[0_0_8px_#df1873]"></span>
                    {{ count($seats) }} Seat(s) Reserved
                </div>
            </div>
            
            <form action="{{ route('book.process-food', $showtime->id) }}" method="POST" id="skipForm">
                @csrf
                <input type="hidden" name="food_cart" value="{}">
                <button type="submit" class="text-gray-500 hover:text-gray-300 text-sm font-bold transition-colors uppercase tracking-wider border-b border-transparent hover:border-gray-500 pb-0.5">Skip</button>
            </form>
        </div>
    </nav>

    <div x-data="foodCart({{ $seatTotal }})" class="bg-[#0a0a0a] min-h-screen pb-40 pt-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[30rem] h-[30rem] bg-[#df1873]/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute top-[40%] right-[-10%] w-[30rem] h-[30rem] bg-purple-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center mb-10 reveal-on-scroll">
                <h2 class="text-3xl font-black text-white mb-2">Enhance Your Movie Magic</h2>
                <p class="text-gray-400 font-medium">Grab your favorite snacks and drinks before they sell out. Skip the queue!</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($foodItems as $index => $item)
                <div class="bg-[#111] border border-gray-800/80 rounded-[2rem] overflow-hidden hover:border-[#df1873]/50 shadow-lg hover:shadow-[0_15px_40px_rgba(223,24,115,0.15)] transition-all duration-300 transform hover:-translate-y-1 group reveal-on-scroll" style="transition-delay: {{ $index * 50 }}ms;">
                    
                    <div class="h-52 bg-gray-900 relative overflow-hidden">
                        @if($item->imagePath)
                        <img src="{{ asset('storage/' . $item->imagePath) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-700 bg-gradient-to-br from-gray-900 to-black">
                            <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider opacity-50">No Image</span>
                        </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-[#111] via-transparent to-transparent opacity-90"></div>

                        @if($index == 0 || str_contains(strtolower($item->name), 'combo') || str_contains(strtolower($item->name), 'popcorn'))
                            <div class="absolute top-4 left-4">
                                <span class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-black text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg uppercase tracking-wider flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    Best Seller
                                </span>
                            </div>
                        @elseif($index == 1 || str_contains(strtolower($item->name), 'drink') || str_contains(strtolower($item->name), 'coke'))
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg uppercase tracking-wider border border-blue-400/30">
                                    Perfect Match
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6 relative -mt-8 z-10">
                        <div class="bg-[#1a1a1a]/90 backdrop-blur-md border border-gray-800 p-4 rounded-2xl shadow-xl flex justify-between items-end mb-4 group-hover:border-gray-700 transition-colors">
                            <div>
                                <h3 class="text-lg font-black text-white leading-tight mb-1">{{ $item->name }}</h3>
                                <span class="text-lg font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#df1873] to-purple-400">{{ number_format($item->price) }} <span class="text-[10px] text-[#df1873] uppercase">Ks</span></span>
                            </div>
                        </div>
                        
                        <p class="text-sm text-gray-500 font-medium mb-6 line-clamp-2 min-h-[40px] px-1">{{ $item->description ?? 'The perfect companion for your cinematic journey. Fresh, delicious, and ready for you.' }}</p>

                        <div class="flex items-center justify-between bg-[#0a0a0a] border border-gray-800 rounded-2xl p-1.5" :class="getQuantity({{ $item->id }}) > 0 ? 'border-[#df1873]/50 bg-[#df1873]/5' : ''">
                            <button type="button" @click="decreaseItem({{ $item->id }}, {{ $item->price }})" 
                                    class="w-12 h-10 rounded-xl bg-[#111] text-gray-400 flex items-center justify-center transition-all disabled:opacity-30 disabled:cursor-not-allowed hover:bg-gray-800 hover:text-white" 
                                    :disabled="!getQuantity({{ $item->id }})">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </button>
                            
                            <div class="flex flex-col items-center justify-center flex-1">
                                <span class="text-sm font-bold text-gray-500 uppercase tracking-widest text-[10px] mb-0.5" x-show="getQuantity({{ $item->id }}) === 0">Add to cart</span>
                                <span class="text-lg font-black text-white" x-show="getQuantity({{ $item->id }}) > 0" x-text="getQuantity({{ $item->id }})"></span>
                            </div>
                            
                            <button type="button" @click="increaseItem({{ $item->id }}, {{ $item->price }})" 
                                    class="w-12 h-10 rounded-xl bg-[#111] text-white flex items-center justify-center hover:bg-[#df1873] transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-32 bg-[#111]/40 backdrop-blur-md rounded-[3rem] border border-gray-800 border-dashed reveal-on-scroll">
                    <div class="w-24 h-24 bg-[#0a0a0a] rounded-full flex items-center justify-center mb-6">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">No Snacks Available</h3>
                    <p class="text-gray-500 font-medium">We're currently restocking. Please continue to checkout.</p>
                </div>
                @endforelse
            </div>

        </div>

        <div class="fixed bottom-6 left-4 right-4 md:left-auto md:right-auto md:w-full md:max-w-4xl md:mx-auto z-50">
            <div class="bg-[#1e293b]/95 backdrop-blur-2xl text-white p-4 sm:p-5 rounded-[2rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.7)] border border-white/10 flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0">
                
                <div class="flex gap-6 sm:gap-10 w-full sm:w-auto justify-between sm:justify-start px-2 sm:px-0">
                    <div class="hidden md:block">
                        <p class="text-[10px] text-gray-400 font-black tracking-widest uppercase mb-1">Tickets</p>
                        <p class="text-lg font-bold text-white">{{ number_format($seatTotal) }} Ks</p>
                    </div>
                    <div class="hidden md:block w-px h-10 bg-gray-700"></div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-black tracking-widest uppercase mb-1">Snacks</p>
                        <p class="text-lg font-bold text-pink-400" x-text="foodTotal.toLocaleString() + ' Ks'"></p>
                    </div>
                    <div class="w-px h-10 bg-gray-700"></div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-black tracking-widest uppercase mb-1">Total</p>
                        <p class="text-xl sm:text-2xl font-black text-[#df1873]" x-text="grandTotal().toLocaleString() + ' Ks'"></p>
                    </div>
                </div>

                <form action="{{ route('book.process-food', $showtime->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    <input type="hidden" name="food_cart" :value="JSON.stringify(cart)">

                    <button type="submit" class="w-full sm:w-auto bg-[#df1873] hover:bg-[#c21463] text-white px-8 py-3.5 rounded-xl font-bold text-base shadow-[0_0_20px_rgba(223,24,115,0.4)] transition transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2 group">
                        <span>Checkout</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('foodCart', (initialSeatTotal) => ({
                seatTotal: initialSeatTotal,
                foodTotal: 0,
                cart: {}, 

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