<x-app-layout>
    <nav class="bg-[#0b1120] border-b border-gray-800 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-[70px]">
            <a href="javascript:history.back()" class="text-gray-300 hover:text-[#df1873] flex items-center gap-2 font-semibold transition">
                <span>&larr; Back</span>
            </a>
            <div class="text-center">
                <h1 class="text-lg font-bold text-white">Secure Checkout</h1>
            </div>
            <div class="w-16"></div>
        </div>
    </nav>

    <div class="bg-[#0b1120] min-h-screen pb-20 pt-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col lg:flex-row gap-10">

                <div class="w-full lg:w-3/5 space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-6">Payment Method</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative flex items-center p-4 border-2 border-gray-700 rounded-xl cursor-pointer hover:border-blue-500 transition group bg-gray-900/50">
                                <input type="radio" name="payment_method" value="kpay" class="w-5 h-5 text-blue-600 bg-gray-800 border-gray-600 focus:ring-blue-500 focus:ring-2" checked>
                                <div class="ml-4 flex flex-col">
                                    <span class="text-white font-bold text-lg">KBZ Pay</span>
                                    <span class="text-xs text-gray-500">Pay directly from KBZ app</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-4 border-2 border-gray-700 rounded-xl cursor-pointer hover:border-yellow-500 transition group bg-gray-900/50">
                                <input type="radio" name="payment_method" value="wavepay" class="w-5 h-5 text-yellow-500 bg-gray-800 border-gray-600 focus:ring-yellow-500 focus:ring-2">
                                <div class="ml-4 flex flex-col">
                                    <span class="text-white font-bold text-lg">Wave Pay</span>
                                    <span class="text-xs text-gray-500">Fast and secure transfer</span>
                                </div>
                            </label>

                            <label class="relative flex items-center p-4 border-2 border-gray-700 rounded-xl cursor-pointer hover:border-[#df1873] transition group bg-gray-900/50 md:col-span-2">
                                <input type="radio" name="payment_method" value="card" class="w-5 h-5 text-[#df1873] bg-gray-800 border-gray-600 focus:ring-[#df1873] focus:ring-2">
                                <div class="ml-4 flex flex-col">
                                    <span class="text-white font-bold text-lg">Credit / Debit Card</span>
                                    <span class="text-xs text-gray-500">Visa, Mastercard, JCB accepted</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-white mb-4">Contact Information</h2>
                        <div class="bg-gray-900/50 border border-gray-800 rounded-xl p-5 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Email Address</label>
                                <input type="email" value="{{ auth()->user()->email ?? '' }}" class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg p-3 focus:ring-[#df1873] focus:border-[#df1873]" placeholder="Enter your email" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-1">Phone Number</label>
                                <input type="text" class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg p-3 focus:ring-[#df1873] focus:border-[#df1873]" placeholder="e.g. 09123456789" required>
                                <p class="text-[10px] text-gray-500 mt-1">We will send your e-ticket to this number via SMS.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/5">
                    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sticky top-24 shadow-xl">
                        <h2 class="text-xl font-bold text-white mb-6 border-b border-gray-800 pb-4">Booking Summary</h2>

                        <div class="flex gap-4 mb-6">
                            <div class="w-20 rounded-lg overflow-hidden shrink-0 border border-gray-700">
                                @if($showtime->movie->imagePath)
                                <img src="{{ asset('storage/' . $showtime->movie->imagePath) }}" alt="Poster" class="w-full h-auto object-cover">
                                @else
                                <div class="w-full h-28 bg-gray-800"></div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-white text-lg leading-tight">{{ $showtime->movie->title }}</h3>
                                <p class="text-xs text-gray-400 mt-1">{{ $showtime->movie->language }} | 2D</p>
                                <p class="text-xs text-[#df1873] font-bold mt-2">{{ $showtime->cinemaHall->cinema->name }} ({{ $showtime->cinemaHall->name }})</p>
                                <p class="text-xs text-white mt-1">{{ \Carbon\Carbon::parse($showtime->date)->format('D, d M Y') }} | {{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</p>
                            </div>
                        </div>

                        <hr class="border-gray-800 mb-4">

                        <div class="mb-4">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-sm text-gray-400">Seats ({{ count($seats) }})</span>
                                <span class="text-sm font-bold text-white">{{ number_format($seatTotal) }} Ks</span>
                            </div>
                            <div class="flex flex-wrap gap-1">
                                @foreach($seats as $seat)
                                <span class="text-[10px] font-bold bg-gray-800 text-gray-300 px-2 py-1 rounded border border-gray-700">{{ $seat->seat_code }}</span>
                                @endforeach
                            </div>
                        </div>

                        @if(count($orderFoods) > 0)
                        <div class="mb-4 pt-4 border-t border-gray-800 border-dashed">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-sm text-gray-400">Food & Beverages</span>
                                <span class="text-sm font-bold text-white">{{ number_format($foodTotal) }} Ks</span>
                            </div>
                            @foreach($orderFoods as $food)
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-xs text-gray-500">{{ $food['quantity'] }}x {{ $food['item']->name }}</span>
                                <span class="text-xs text-gray-500">{{ number_format($food['subtotal']) }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <hr class="border-gray-800 my-4">

                        <div class="flex justify-between items-center mb-8">
                            <span class="text-base font-bold text-white">Grand Total</span>
                            <span class="text-2xl font-black text-[#df1873]">{{ number_format($grandTotal) }} Ks</span>
                        </div>

                        <form action="{{ route('book.confirm', $showtime->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-[#df1873] hover:bg-[#c21463] text-white py-4 rounded-xl font-bold text-lg shadow-[0_4px_15px_rgba(223,24,115,0.4)] transition transform hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2">
                                <span>Confirm Payment</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </form>
                        <p class="text-center text-[10px] text-gray-500 mt-4">By clicking confirm, you agree to our Terms & Conditions.</p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>