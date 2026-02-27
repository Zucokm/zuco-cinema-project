<x-app-layout>




    <div class="relative w-full bg-[#0a0a0a] min-h-[450px] flex items-center">

        <div class="absolute inset-0 z-0 overflow-hidden">
            @if($movie->bgImagePath)
            <img src="{{ asset('storage/' . $movie->bgImagePath) }}" alt="{{ $movie->title }} background" class="w-full h-full object-cover opacity-60">
            @else
            <img src="{{ asset('storage/' . $movie->imagePath) }}" alt="background" class="w-full h-full object-cover opacity-30 blur-md scale-110">
            @endif

            <div class="absolute inset-0 bg-gradient-to-r from-[#0a0a0a] via-[#0a0a0a]/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/30 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-12">
            <div class="flex flex-col md:flex-row gap-8 items-start">

                <div class="w-64 shrink-0 rounded-2xl overflow-hidden shadow-2xl shadow-black/50 border border-gray-800">
                    @if($movie->imagePath)
                    <img src="{{ asset('storage/' . $movie->imagePath) }}" alt="{{ $movie->title }}" class="w-full aspect-[2/3] object-cover">
                    @endif

                    @if($movie->trailerLink)
                    <a href="{{ $movie->trailerLink }}" target="_blank" class="block bg-white text-center py-2.5 text-sm font-bold text-gray-900 hover:bg-gray-200 transition-colors">
                        trailer
                    </a>
                    @else
                    <div class="block bg-white text-center py-2.5 text-sm font-bold text-gray-500 cursor-not-allowed">
                        no trailer
                    </div>
                    @endif
                </div>

                <div class="text-white flex flex-col justify-center pt-2 md:pt-6">
                    <h1 class="text-4xl md:text-5xl font-extrabold mb-6">{{ $movie->title }}</h1>

                    <div class="flex items-center bg-white/10 backdrop-blur-md rounded-2xl w-fit px-5 py-3 mb-5 border border-white/5 shadow-lg">
                        <div class="flex items-center gap-2 mr-6">
                            <svg class="w-6 h-6 text-[#df1873]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-xl font-bold">{{ $movie->rating }}/10 <span class="text-sm font-medium text-gray-300 ml-1">(Global)</span></span>
                        </div>
                        <button class="bg-white text-black px-4 py-1.5 rounded-full font-bold text-sm hover:bg-gray-200 transition-colors">Search</button>
                    </div>

                    <div class="mb-5">
                        <span class="bg-white/90 text-black px-4 py-1.5 rounded-full text-sm font-bold shadow-sm">{{ $movie->language }}</span>
                    </div>

                    <p class="text-lg font-medium text-gray-200 mb-8 tracking-wide">
                        {{ $movie->duration }} Mins. <span class="mx-2 text-gray-500">/</span> {{ $movie->genre }}
                    </p>

                    <div>
                        <a href="#showtimes" class="inline-block bg-[#df1873] hover:bg-[#c21463] text-white px-10 py-3.5 rounded-xl font-bold text-lg shadow-lg shadow-[#df1873]/30 transition-all transform hover:-translate-y-1">
                            Book tickets
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="bg-[#0a0a0a] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <div class="max-w-3xl">
                <h2 class="text-2xl font-bold text-white mb-4">About the movie</h2>
                <p class="text-gray-300 leading-relaxed text-base">
                    {{ $movie->description ?: 'No description available for this movie yet.' }}
                </p>
            </div>

            <hr class="border-gray-800 my-16">

            <div id="showtimes" class="py-10" x-data="{ selectedDate: '{{ $showtimesByDate->keys()->first() ?? '' }}' }">

                <h2 class="text-3xl font-bold text-white mb-8 border-b border-gray-800 pb-4">Select Date & Showtime</h2>

                @if($showtimesByDate->isNotEmpty())

                <div class="flex overflow-x-auto gap-4 pb-4 mb-10 scrollbar-hide">
                    @foreach($showtimesByDate->keys() as $date)
                    <button @click="selectedDate = '{{ $date }}'"
                        :class="selectedDate === '{{ $date }}' ? 'bg-[#df1873] text-white border-[#df1873]' : 'bg-[#111] text-gray-400 border-gray-800 hover:bg-gray-800 hover:text-white'"
                        class="flex flex-col items-center justify-center min-w-[90px] p-3 rounded-xl border transition-all cursor-pointer shrink-0 shadow-lg">
                        <span class="text-[10px] uppercase font-bold tracking-widest mb-1">{{ \Carbon\Carbon::parse($date)->format('M') }}</span>
                        <span class="text-2xl font-extrabold leading-none mb-1">{{ \Carbon\Carbon::parse($date)->format('d') }}</span>
                        <span class="text-[11px] font-medium">{{ \Carbon\Carbon::parse($date)->format('D') }}</span>
                    </button>
                    @endforeach
                </div>

                <div class="space-y-8">
                    @foreach($showtimesByDate as $date => $showtimes)

                    <div x-show="selectedDate === '{{ $date }}'" style="display: none;" x-show.transition.opacity class="space-y-6">

                        @php
                        $showtimesByCinema = $showtimes->groupBy(function($show) {
                        return $show->cinemaHall->cinema->name;
                        });
                        @endphp

                        @foreach($showtimesByCinema as $cinemaName => $cinemaShows)
                        <div class="bg-[#111] rounded-2xl p-6 border border-gray-800/60 shadow-xl">

                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 rounded-full bg-gray-900 border border-gray-700 flex items-center justify-center text-gray-400 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">{{ $cinemaName }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">Ticket Cancellation not available</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-4 md:pl-16">
                                @foreach($cinemaShows as $show)
                                <a href="{{ route('book.seats', $show->id) }}" class="group relative px-6 py-3 bg-[#0a0a0a] border border-gray-700 rounded-xl hover:border-[#df1873] hover:bg-[#df1873]/10 transition-all flex flex-col items-center min-w-[120px] shadow-md">
                                    <span class="font-bold text-gray-200 group-hover:text-[#df1873] text-lg">{{ \Carbon\Carbon::parse($show->start_time)->format('h:i A') }}</span>
                                    <span class="text-[10px] text-gray-500 group-hover:text-gray-400 mt-1 uppercase tracking-wider">{{ $show->cinemaHall->name }}</span>
                                </a>
                                @endforeach
                            </div>

                        </div>
                        @endforeach

                    </div>

                    @endforeach
                </div>

                @else
                <div class="bg-[#111] rounded-2xl p-10 text-center border border-gray-800/60">
                    <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">No Showtimes Available</h3>
                    <p class="text-gray-500 text-sm">There are currently no scheduled showtimes for this movie.</p>
                </div>
                @endif

            </div>

        </div>
    </div>


    <footer class="bg-[#050505] border-t border-gray-800/60 pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-10">

                <div class="col-span-1 md:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center mb-5 group">
                        <span class="text-2xl font-extrabold tracking-widest text-white group-hover:text-indigo-400 transition-colors">ZUCO</span>
                        <div class="flex flex-col ml-1 mt-1">
                            <span class="text-[9px] font-bold bg-red-600 text-white px-1 rounded-sm transform -rotate-6 mb-[2px] leading-tight">TICKET</span>
                            <span class="text-[9px] font-bold bg-blue-600 text-white px-1 rounded-sm transform rotate-6 leading-tight">FOOD</span>
                        </div>
                    </a>
                    <p class="text-sm text-gray-400 mb-8 max-w-xs leading-relaxed">Making the world a better place through constructing elegant hierarchies and amazing movie experiences.</p>

                    <div class="flex space-x-5 text-gray-500">
                        <a href="#" class="hover:text-indigo-400 transition-colors">Fb</a>
                        <a href="#" class="hover:text-white transition-colors">Ig</a>
                        <a href="#" class="hover:text-white transition-colors">X</a>
                        <a href="#" class="hover:text-white transition-colors">Yt</a>
                        <a href="#" class="hover:text-white transition-colors">Tg</a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-5 tracking-wide">Solutions</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Marketing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Analytics</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Automation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Commerce</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-5 tracking-wide">Support</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Submit ticket</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Guides</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-5 tracking-wide">Company</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-20 pt-8 border-t border-gray-800/60 text-center text-xs text-gray-500">
                © {{ date('Y') }} ZUCO, Inc. All rights reserved.
            </div>
        </div>
    </footer>

</x-app-layout>