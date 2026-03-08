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
        /* Custom Scrollbar for date picker */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div x-data="{
        trailerOpen: false,
        trailerUrl: '',
        playTrailer(url) {
            if(url) {
                this.trailerUrl = url.replace('watch?v=', 'embed/');
                this.trailerOpen = true;
            }
        }
    }" class="bg-[#0a0a0a] min-h-screen text-white">

        <!-- Hero Section -->
        <div class="relative w-full min-h-[80vh] flex items-end pb-12 md:pb-24 overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 z-0">
                @if($movie->bgImagePath)
                    <img src="{{ str_starts_with($movie->bgImagePath, 'http') ? $movie->bgImagePath : asset('storage/' . $movie->bgImagePath) }}" alt="{{ $movie->title }} background" class="w-full h-full object-cover opacity-50 scale-105 blur-sm">
                @else
                    <img src="{{ str_starts_with($movie->imagePath, 'http') ? $movie->imagePath : asset('storage/' . $movie->imagePath) }}" alt="background" class="w-full h-full object-cover opacity-30 blur-xl scale-110">
                @endif
                <!-- Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/60 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#0a0a0a] via-[#0a0a0a]/40 to-transparent"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
                <div class="flex flex-col md:flex-row gap-10 items-end">
                    
                    <!-- Poster -->
                    <div class="w-64 md:w-80 shrink-0 rounded-2xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 transform md:-mb-16 reveal-on-scroll">
                        @if($movie->imagePath)
                            <img src="{{ str_starts_with($movie->imagePath, 'http') ? $movie->imagePath : asset('storage/' . $movie->imagePath) }}" alt="{{ $movie->title }}" class="w-full aspect-[2/3] object-cover">
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="flex-1 mb-4 reveal-on-scroll" style="transition-delay: 100ms;">
                        <!-- Badges -->
                        <div class="flex flex-wrap gap-3 mb-4">
                            @if($movie->rating)
                                <div class="flex items-center gap-1 bg-yellow-500/20 text-yellow-500 px-3 py-1 rounded-full text-sm font-bold border border-yellow-500/30 backdrop-blur-md">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span>{{ $movie->rating }}/10</span>
                                </div>
                            @endif
                            <span class="bg-white/10 text-white px-3 py-1 rounded-full text-sm font-medium border border-white/10 backdrop-blur-md">{{ $movie->language }}</span>
                            <span class="bg-white/10 text-white px-3 py-1 rounded-full text-sm font-medium border border-white/10 backdrop-blur-md">{{ $movie->duration }} mins</span>
                        </div>

                        <h1 class="text-4xl md:text-6xl font-black text-white mb-4 tracking-tight leading-tight drop-shadow-lg">{{ $movie->title }}</h1>
                        
                        <p class="text-lg text-gray-300 mb-8 font-medium max-w-2xl leading-relaxed">{{ $movie->genre }}</p>

                        <div class="flex flex-wrap gap-4">
                            <a href="#showtimes" class="bg-[#df1873] hover:bg-[#c21463] text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg shadow-[#df1873]/30 transition-all transform hover:-translate-y-1 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                Get Tickets
                            </a>
                            
                            @if($movie->trailerLink)
                                <button @click="playTrailer('{{ $movie->trailerLink }}')" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-8 py-4 rounded-xl font-bold text-lg backdrop-blur-md transition-all flex items-center gap-2 group">
                                    <div class="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path></svg>
                                    </div>
                                    Watch Trailer
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Left Column: Story & Details -->
                <div class="lg:col-span-2 space-y-12">
                    <div class="reveal-on-scroll">
                        <h3 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                            <span class="w-1 h-8 bg-[#df1873] rounded-full"></span>
                            Storyline
                        </h3>
                        <p class="text-gray-400 text-lg leading-relaxed">
                            {{ $movie->description ?: 'No description available for this movie yet.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 reveal-on-scroll">
                        <div class="bg-[#111] p-4 rounded-xl border border-gray-800">
                            <p class="text-gray-500 text-xs uppercase font-bold mb-1">Director</p>
                            <p class="text-white font-medium">{{ $movie->director ?? 'Unknown' }}</p>
                        </div>
                        <div class="bg-[#111] p-4 rounded-xl border border-gray-800">
                            <p class="text-gray-500 text-xs uppercase font-bold mb-1">Release Date</p>
                            <p class="text-white font-medium">{{ \Carbon\Carbon::parse($movie->releaseDate)->format('d M Y') }}</p>
                        </div>
                        <div class="bg-[#111] p-4 rounded-xl border border-gray-800">
                            <p class="text-gray-500 text-xs uppercase font-bold mb-1">Genre</p>
                            <p class="text-white font-medium">{{ $movie->genre ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Showtimes -->
                <div class="lg:col-span-1 scroll-mt-24" id="showtimes">
                    <div class="bg-[#111] rounded-3xl p-6 border border-gray-800 sticky top-24 reveal-on-scroll">
                        <h3 class="text-xl font-bold text-white mb-6">Showtimes</h3>

                        @if($showtimesByDate->isNotEmpty())
                            <div x-data="{ selectedDate: '{{ $showtimesByDate->keys()->first() }}' }">
                                <!-- Date Selector -->
                                <div class="flex overflow-x-auto gap-3 pb-4 mb-6 hide-scrollbar">
                                    @foreach($showtimesByDate->keys() as $date)
                                        <button @click="selectedDate = '{{ $date }}'"
                                            :class="selectedDate === '{{ $date }}' ? 'bg-[#df1873] text-white border-[#df1873] shadow-lg shadow-[#df1873]/20' : 'bg-gray-900 text-gray-400 border-gray-800 hover:bg-gray-800 hover:text-white'"
                                            class="flex flex-col items-center justify-center min-w-[70px] py-3 rounded-xl border transition-all shrink-0">
                                            <span class="text-[10px] uppercase font-bold tracking-wider">{{ \Carbon\Carbon::parse($date)->format('M') }}</span>
                                            <span class="text-xl font-black leading-none my-1">{{ \Carbon\Carbon::parse($date)->format('d') }}</span>
                                            <span class="text-[10px] font-bold">{{ \Carbon\Carbon::parse($date)->format('D') }}</span>
                                        </button>
                                    @endforeach
                                </div>

                                <!-- Showtimes List -->
                                <div>
                                    @foreach($showtimesByDate as $date => $showtimes)
                                        <div x-show="selectedDate === '{{ $date }}'" 
                                             x-transition:enter="transition ease-out duration-300"
                                             x-transition:enter-start="opacity-0 transform translate-y-2"
                                             x-transition:enter-end="opacity-100 transform translate-y-0"
                                             style="display: none;" class="space-y-6">
                                            
                                            @php
                                                $showtimesByCinema = $showtimes->groupBy(function($show) {
                                                    return $show->cinemaHall->cinema->name;
                                                });
                                            @endphp

                                            @foreach($showtimesByCinema as $cinemaName => $cinemaShows)
                                                <div>
                                                    <h4 class="text-sm font-bold text-gray-300 mb-3 flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                        {{ $cinemaName }}
                                                    </h4>
                                                    <div class="grid grid-cols-3 gap-2">
                                                        @foreach($cinemaShows as $show)
                                                            <a href="{{ route('book.seats', $show->id) }}" class="group flex flex-col items-center justify-center py-2 px-1 bg-gray-900 border border-gray-800 rounded-lg hover:border-[#df1873] hover:bg-[#df1873]/10 transition-all">
                                                                <span class="text-sm font-bold text-white group-hover:text-[#df1873]">{{ \Carbon\Carbon::parse($show->start_time)->format('h:i A') }}</span>
                                                                <span class="text-[9px] text-gray-500 uppercase">{{ $show->cinemaHall->name }}</span>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">No showtimes available.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Trailer Modal -->
        <div x-show="trailerOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-6">
            <div x-show="trailerOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-black/90 backdrop-blur-sm" @click="trailerOpen = false; trailerUrl = ''"></div>
            
            <div x-show="trailerOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="relative w-full max-w-5xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl border border-gray-800" @click.stop>
                <button @click="trailerOpen = false; trailerUrl = ''" class="absolute top-4 right-4 text-white/70 hover:text-white z-10 bg-black/50 rounded-full p-2 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <template x-if="trailerOpen">
                    <iframe :src="trailerUrl + '?autoplay=1'" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </template>
            </div>
        </div>

        <footer class="bg-[#050505] border-t border-gray-800/60 pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-8 md:gap-10">

                    <div class="col-span-1 md:col-span-2 mb-8 md:mb-0">
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
                            <a href="#" class="hover:text-indigo-400 transition-colors">Ig</a>
                            <a href="#" class="hover:text-indigo-400 transition-colors">X</a>
                            <a href="#" class="hover:text-indigo-400 transition-colors">Yt</a>
                            <a href="#" class="hover:text-indigo-400 transition-colors">Tg</a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="border-b border-gray-800 md:border-none pb-4 md:pb-0">
                        <button @click="open = !open" class="flex items-center justify-between w-full md:w-auto group focus:outline-none">
                            <h4 class="font-bold text-white md:mb-5 tracking-wide">Solutions</h4>
                            <svg class="w-5 h-5 text-gray-500 md:hidden transform transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul x-show="open" x-transition class="space-y-3 text-sm text-gray-400 mt-2 md:mt-0 md:!block" style="display: none;">
                            <li><a href="#" class="hover:text-white transition-colors">Marketing</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Analytics</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Automation</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Commerce</a></li>
                        </ul>
                    </div>
                    <div x-data="{ open: false }" class="border-b border-gray-800 md:border-none pb-4 md:pb-0">
                        <button @click="open = !open" class="flex items-center justify-between w-full md:w-auto group focus:outline-none">
                            <h4 class="font-bold text-white md:mb-5 tracking-wide">Support</h4>
                            <svg class="w-5 h-5 text-gray-500 md:hidden transform transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul x-show="open" x-transition class="space-y-3 text-sm text-gray-400 mt-2 md:mt-0 md:!block" style="display: none;">
                            <li><a href="#" class="hover:text-white transition-colors">Submit ticket</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Guides</a></li>
                        </ul>
                    </div>
                    <div x-data="{ open: false }" class="border-b border-gray-800 md:border-none pb-4 md:pb-0">
                        <button @click="open = !open" class="flex items-center justify-between w-full md:w-auto group focus:outline-none">
                            <h4 class="font-bold text-white md:mb-5 tracking-wide">Company</h4>
                            <svg class="w-5 h-5 text-gray-500 md:hidden transform transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul x-show="open" x-transition class="space-y-3 text-sm text-gray-400 mt-2 md:mt-0 md:!block" style="display: none;">
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

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId && targetId !== '#') {
                        document.querySelector(targetId)?.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>
