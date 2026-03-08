<x-app-layout>
    <style>
        /* Custom scrollbar for clean UI */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        /* Custom Radio Button styling inside cards */
        .payment-radio:checked + div {
            border-color: #df1873;
            background-color: rgba(223, 24, 115, 0.05);
            box-shadow: 0 0 20px rgba(223, 24, 115, 0.2);
        }
        .payment-radio:checked + div .check-icon {
            opacity: 1;
            transform: scale(1);
        }
    </style>

    <nav class="bg-[#0a0a0a]/90 backdrop-blur-xl border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-[75px]">
            <a href="{{ route('book.food', $showtime->id) }}" class="text-gray-400 hover:text-white flex items-center gap-2 font-bold transition-colors group">
                <div class="bg-gray-900 p-2 rounded-xl group-hover:bg-[#df1873]/20 group-hover:text-[#df1873] transition-colors border border-gray-800 group-hover:border-[#df1873]/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                <span class="hidden sm:inline">Back to Food</span>
            </a>
            
            <div class="text-center flex-1 pr-12 sm:pr-24">
                <h1 class="text-xl font-black text-white tracking-tight flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Secure Checkout
                </h1>
            </div>
        </div>
    </nav>

    <div class="bg-[#0a0a0a] min-h-screen pb-24 pt-12 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[30rem] h-[30rem] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[10%] right-[-10%] w-[30rem] h-[30rem] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <form action="{{ route('book.confirm', $showtime->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-10" x-data="{ paymentMethod: 'kpay' }">
                @csrf

                <div class="w-full lg:w-3/5 space-y-10">
                    
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <span class="w-8 h-8 rounded-full bg-[#df1873]/20 text-[#df1873] flex items-center justify-center font-black text-sm border border-[#df1873]/30">1</span>
                            <h2 class="text-2xl font-black text-white tracking-tight">Select Payment Method</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="payment_method" value="kpay" x-model="paymentMethod" class="payment-radio sr-only">
                                <div class="p-5 border-2 border-gray-800 rounded-2xl bg-[#111] hover:border-gray-600 transition-all h-full flex flex-col items-center justify-center text-center relative overflow-hidden">
                                    <div class="absolute top-3 right-3 text-[#df1873] opacity-0 transform scale-50 transition-all duration-300 check-icon">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div class="w-16 h-16 bg-blue-600/10 rounded-full flex items-center justify-center mb-3">
                                        <span class="text-blue-500 font-black text-xl italic tracking-tighter">KPay</span>
                                    </div>
                                    <span class="text-white font-bold mb-1">KBZ Pay</span>
                                    <span class="text-xs text-gray-500">Manual Transfer</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer group">
                                <input type="radio" name="payment_method" value="wavepay" x-model="paymentMethod" class="payment-radio sr-only">
                                <div class="p-5 border-2 border-gray-800 rounded-2xl bg-[#111] hover:border-gray-600 transition-all h-full flex flex-col items-center justify-center text-center relative overflow-hidden">
                                    <div class="absolute top-3 right-3 text-[#df1873] opacity-0 transform scale-50 transition-all duration-300 check-icon">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <div class="w-16 h-16 bg-yellow-500/10 rounded-full flex items-center justify-center mb-3">
                                        <span class="text-yellow-500 font-black text-xl italic tracking-tighter">Wave</span>
                                    </div>
                                    <span class="text-white font-bold mb-1">Wave Pay</span>
                                    <span class="text-xs text-gray-500">Manual Transfer</span>
                                </div>
                            </label>
                        </div>

                        <div x-show="['kpay', 'wavepay'].includes(paymentMethod)" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="mt-6 bg-[#111] border border-gray-800 rounded-2xl p-6 shadow-inner relative overflow-hidden" style="display: none;">
                            
                            <div class="absolute top-0 left-0 w-1 h-full" :class="paymentMethod === 'kpay' ? 'bg-blue-500' : 'bg-yellow-500'"></div>
                            
                            <div class="flex items-start gap-4 mb-6">
                                <div class="bg-gray-900 p-3 rounded-xl">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold mb-1">Transfer Details</h4>
                                    <p class="text-sm text-gray-400 mb-1" x-show="paymentMethod === 'kpay'">Account: <strong class="text-white">09 123 456 789</strong> (ZUCO Cinema)</p>
                                    <p class="text-sm text-gray-400 mb-1" x-show="paymentMethod === 'wavepay'">Account: <strong class="text-white">09 987 654 321</strong> (ZUCO Cinema)</p>
                                    <p class="text-xs text-[#df1873] font-medium">Please transfer the exact Grand Total amount below.</p>
                                </div>
                            </div>

                            <label class="block text-sm font-bold text-white mb-3">Upload Payment Screenshot <span class="text-[#df1873]">*</span></label>
                            <div class="relative w-full">
                                <input type="file" name="payment_screenshot" required class="block w-full text-sm text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-gray-800 file:text-white hover:file:bg-gray-700 transition-colors cursor-pointer bg-[#0a0a0a] rounded-xl border border-gray-800 focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50" accept="image/*">
                            </div>
                            <p class="text-xs text-gray-500 mt-3 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                We will confirm your tickets within 5 minutes after verification.
                            </p>
                            @error('payment_screenshot')
                                <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <span class="w-8 h-8 rounded-full bg-[#df1873]/20 text-[#df1873] flex items-center justify-center font-black text-sm border border-[#df1873]/30">2</span>
                            <h2 class="text-2xl font-black text-white tracking-tight">Contact Details</h2>
                        </div>
                        
                        <div class="bg-[#111] border border-gray-800 rounded-2xl p-6 md:p-8 space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Email Address</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600" placeholder="Where should we send your receipt?" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Phone Number</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path></svg>
                                    </div>
                                    <input type="text" name="phone" class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600" placeholder="e.g. 09123456789" required>
                                </div>
                                <p class="text-[11px] text-gray-500 mt-2 font-medium">Your e-tickets will be sent via SMS to this number.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/5">
                    <div class="bg-[#111]/80 backdrop-blur-2xl border border-gray-800 rounded-[2rem] p-6 sm:p-8 sticky top-[100px] shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                        <h2 class="text-xl font-black text-white mb-6 flex items-center justify-between">
                            Order Summary
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </h2>

                        <div class="flex gap-5 mb-8 bg-[#0a0a0a] p-4 rounded-2xl border border-gray-800/80">
                            <div class="w-[72px] h-24 rounded-xl overflow-hidden shrink-0 shadow-lg">
                                @if($showtime->movie->imagePath)
                                <img src="{{ str_starts_with($showtime->movie->imagePath, 'http') ? $showtime->movie->imagePath : asset('storage/' . $showtime->movie->imagePath) }}" alt="Poster" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                @endif
                            </div>
                            <div class="flex flex-col justify-center">
                                <h3 class="font-black text-white text-lg leading-tight mb-1">{{ $showtime->movie->title }}</h3>
                                <div class="flex flex-wrap gap-2 text-[10px] font-bold uppercase tracking-wider mb-2">
                                    <span class="bg-gray-800 text-gray-300 px-2 py-0.5 rounded">{{ $showtime->movie->language }}</span>
                                    <span class="bg-gray-800 text-gray-300 px-2 py-0.5 rounded">2D</span>
                                </div>
                                <p class="text-xs text-gray-400 font-medium">{{ \Carbon\Carbon::parse($showtime->date)->format('d M Y') }} &bull; {{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</p>
                                <p class="text-xs text-[#df1873] font-bold mt-1">{{ $showtime->cinemaHall->cinema->name }} ({{ $showtime->cinemaHall->name }})</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <div class="flex justify-between items-start mb-2.5">
                                    <span class="text-sm font-bold text-gray-400">Tickets ({{ count($seats) }})</span>
                                    <span class="text-sm font-black text-white">{{ number_format($seatTotal) }} Ks</span>
                                </div>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($seats as $seat)
                                    <span class="text-xs font-bold bg-[#df1873]/10 text-[#df1873] px-2.5 py-1 rounded-md border border-[#df1873]/20">{{ $seat->seat_code }}</span>
                                    @endforeach
                                </div>
                            </div>

                            @if(count($orderFoods) > 0)
                            <div class="pt-5 border-t border-gray-800 border-dashed">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="text-sm font-bold text-gray-400">Food & Beverages</span>
                                    <span class="text-sm font-black text-white">{{ number_format($foodTotal) }} Ks</span>
                                </div>
                                <div class="space-y-2">
                                    @foreach($orderFoods as $food)
                                    <div class="flex justify-between items-start text-xs font-medium text-gray-500">
                                        <span class="flex items-start gap-2">
                                            <span class="font-bold text-gray-400">{{ $food['quantity'] }}x</span> 
                                            {{ $food['item']->name }}
                                        </span>
                                        <span class="shrink-0">{{ number_format($food['subtotal']) }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-800">
                            <div class="flex justify-between items-end mb-6">
                                <span class="text-sm font-black text-gray-300 uppercase tracking-widest">Grand Total</span>
                                <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#df1873] to-purple-400">{{ number_format($grandTotal) }} <span class="text-sm text-[#df1873] uppercase">Ks</span></span>
                            </div>

                            <button type="submit" class="w-full bg-[#df1873] hover:bg-[#c21463] text-white py-4.5 rounded-xl font-bold text-lg shadow-[0_0_25px_rgba(223,24,115,0.4)] hover:shadow-[0_0_35px_rgba(223,24,115,0.6)] transition-all transform hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2 group relative overflow-hidden">
                                <span class="relative z-10">Confirm & Pay</span>
                                <svg class="w-5 h-5 relative z-10 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                            
                            <div class="text-center mt-4 text-[10px] font-medium text-gray-500 flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Secure 256-bit SSL encrypted payment
                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>