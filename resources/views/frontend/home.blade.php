<x-app-layout>
    <style>
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }
        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <div class="bg-[#0a0a0a] min-h-screen pt-8 pb-24" x-data="{
        trailerOpen: false,
        trailerUrl: '',
        playTrailer(url) {
            if(url) {
                this.trailerUrl = url.replace('watch?v=', 'embed/');
                this.trailerOpen = true;
            }
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div x-data="{ 
                    activeSlide: 0, 
                    totalSlides: {{ $movies->count() }},
                    next() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides },
                    prev() { this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides },
                    startLoop() { setInterval(() => { this.next() }, 5000) }
                }" 
                x-init="startLoop" 
                class="relative w-full h-[60vh] min-h-[450px] rounded-3xl overflow-hidden shadow-2xl shadow-indigo-500/10 mb-16 border border-gray-800 group">
                
                @foreach($movies as $movie)
                <div x-show="activeSlide === {{ $loop->index }}" x-transition.opacity.duration.700ms class="absolute inset-0" style="display: none;">
                    <img src="{{ str_starts_with($movie->bgImagePath, 'http') ? $movie->bgImagePath : asset('storage/' . $movie->bgImagePath) }}" class="w-full h-full object-cover opacity-60" alt="{{ $movie->title }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/40 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0a0a0a]/90 via-[#0a0a0a]/50 to-transparent"></div>
                    
                    <div class="absolute bottom-10 left-6 md:left-12 max-w-2xl text-left transform transition-all duration-700 translate-y-0">
                        <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full mb-4 inline-block tracking-wider uppercase">New Release</span>
                        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 tracking-tight drop-shadow-lg">{{ $movie->title }}</h1>
                        <p class="text-gray-300 text-sm md:text-base mb-8 line-clamp-2 md:line-clamp-3">{{ $movie->description }}</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('movie.details', $movie->id) }}" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 px-8 rounded-full transition-colors shadow-lg shadow-indigo-600/30">Get Tickets</a>
                            <button @click="playTrailer('{{ $movie->trailerLink }}')" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 font-bold py-3 px-8 rounded-full backdrop-blur-sm transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                Trailer
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="absolute inset-y-0 right-0 flex items-center pr-4 md:pr-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button @click="next()" class="bg-black/50 hover:bg-indigo-600 text-white p-3 rounded-full backdrop-blur-sm transition-all border border-white/10 hover:border-transparent">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 md:pl-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button @click="prev()" class="bg-black/50 hover:bg-indigo-600 text-white p-3 rounded-full backdrop-blur-sm transition-all border border-white/10 hover:border-transparent">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                </div>

                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                    <template x-for="i in totalSlides" :key="i" >
                        <button @click="activeSlide = i - 1" 
                                :class="{'bg-indigo-500 w-6': activeSlide === i - 1, 'bg-gray-500 w-2': activeSlide !== i - 1}" 
                                class="h-2 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
            </div>
            <div class="text-center mb-20 mt-4 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6 tracking-tight">Let's Find Your Next Movie</h2>
                <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies, genres..." class="w-full bg-[#111] border border-gray-800 text-white pl-12 pr-6 py-4 rounded-xl focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 placeholder-gray-600 transition-all shadow-lg">
                </form>
                
                <div class="flex flex-wrap justify-center gap-3 mt-8">
                    @php $genres = ['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi', 'Romance', 'Animation']; @endphp
                    @foreach($genres as $genre)
                        <a href="{{ route('movies.index', ['genre' => $genre]) }}" class="px-4 py-2 rounded-full bg-[#111] border border-gray-800 text-gray-400 text-sm font-medium hover:bg-[#df1873] hover:text-white hover:border-[#df1873] transition-all">
                            {{ $genre }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mb-16 reveal-on-scroll">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-white tracking-wide">{{ request('search') ? 'Search Results' : 'Recommended Movies' }}</h3>
                    @if(request('search'))
                        <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-white transition-colors">Clear Search</a>
                    @else
                        <a href="{{ route('movies.index') }}" class="text-sm font-semibold text-indigo-500 hover:text-indigo-400 transition-colors">View All &rarr;</a>
                    @endif
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 md:gap-8">
                    @forelse($movies as $movie)
                    <a href="{{ route('movie.details', $movie->id) }}" class="group block">
                        <div class="tilt-card rounded-xl overflow-hidden aspect-[2/3] mb-4 relative shadow-lg border border-gray-800 group-hover:border-indigo-500/50 transition-all duration-300">
                            @if($movie->imagePath)
                            <img src="{{ str_starts_with($movie->imagePath, 'http') ? $movie->imagePath : asset('storage/' . $movie->imagePath) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                            <div class="w-full h-full bg-[#111] flex flex-col items-center justify-center text-gray-600 p-4 text-center">
                                <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs uppercase tracking-wider font-semibold">No Poster</span>
                            </div>
                            @endif

                            <div class="absolute top-3 right-3 z-10">
                                @if(\Carbon\Carbon::parse($movie->releaseDate)->isFuture())
                                    <span class="bg-blue-600/90 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded border border-blue-400/30 uppercase tracking-wide">Coming Soon</span>
                                @else
                                    <span class="bg-green-600/90 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded border border-green-400/30 uppercase tracking-wide">Now Showing</span>
                                @endif
                            </div>

                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                <span class="bg-indigo-600 text-white text-xs font-bold px-4 py-2 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 shadow-lg">Get Tickets</span>
                            </div>
                        </div>

                        <h4 class="font-bold text-base text-gray-200 truncate transition group-hover:text-indigo-400" title="{{ $movie->title }}">{{ $movie->title }}</h4>
                        <p class="text-xs text-gray-500 mt-1.5 font-medium">{{ $movie->duration }} mins <span class="mx-1.5 text-gray-700">&bull;</span> Action</p>
                    </a>
                    @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20 bg-[#111] rounded-2xl border border-gray-800 border-dashed">
                        <span class="text-4xl mb-4">🎬</span>
                        <p class="text-gray-400 font-medium">No movies are currently showing.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <hr class="border-gray-800/60 my-16">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24 reveal-on-scroll">
                <div class="bg-[#111] p-8 rounded-3xl border border-gray-800/60 text-center group hover:border-[#df1873]/50 transition-colors">
                    <div class="w-16 h-16 bg-gray-900 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Easy Booking</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Book your tickets in just a few clicks. Choose your favorite seats and pay securely.</p>
                </div>
                <div class="bg-[#111] p-8 rounded-3xl border border-gray-800/60 text-center group hover:border-[#df1873]/50 transition-colors">
                    <div class="w-16 h-16 bg-gray-900 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Immersive Experience</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Enjoy movies with state-of-the-art sound and visual technologies in our premium halls.</p>
                </div>
                <div class="bg-[#111] p-8 rounded-3xl border border-gray-800/60 text-center group hover:border-[#df1873]/50 transition-colors">
                    <div class="w-16 h-16 bg-gray-900 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Delicious Snacks</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Pre-order your popcorn and drinks to skip the line and enjoy the show.</p>
                </div>
            </div>

            <div class="reveal-on-scroll">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-white tracking-wide">Experience ZUCO Cinemas</h3>
                    <a href="{{ route('cinemas.index') }}" class="text-sm font-semibold text-indigo-500 hover:text-indigo-400 transition-colors">View All &rarr;</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    @foreach($cinemas as $cinema)
                    <a href="{{ route('cinema.details', $cinema->id) }}" class="relative rounded-2xl overflow-hidden aspect-video group cursor-pointer border border-gray-800 shadow-xl block">
                        @if($cinema->photoPath)
                        <img src="{{ asset('storage/' . $cinema->photoPath) }}" alt="{{ $cinema->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        @else
                        <img src="https://images.unsplash.com/photo-1595769816263-9b910be24d5f?q=80&w=2079&auto=format&fit=crop" alt="Cinema Placeholder" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/50 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <div class="absolute bottom-0 left-0 w-full p-6 text-left transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            <h4 class="text-xl font-extrabold text-white mb-1">{{ $cinema->township ?? 'Location' }}</h4>
                            <p class="text-sm text-gray-300 font-medium">{{ $cinema->name }}</p>
                        </div>
                    </a>
                    @endforeach

                </div>
            </div>

            <!-- Newsletter Section -->
            <div class="mt-24 mb-8 relative rounded-3xl overflow-hidden bg-[#111] border border-gray-800 reveal-on-scroll group">
                <div class="absolute inset-0">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#df1873]/20 to-purple-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="absolute -right-20 -top-20 w-96 h-96 bg-[#df1873]/10 rounded-full blur-3xl"></div>
                    <div class="absolute -left-20 -bottom-20 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl"></div>
                </div>
                <div class="relative p-10 md:p-16 flex flex-col md:flex-row items-center justify-between gap-10">
                    <div class="max-w-xl text-center md:text-left">
                        <h3 class="text-3xl font-bold text-white mb-3">Don't Miss Out!</h3>
                        <p class="text-gray-400">Subscribe to our newsletter for exclusive movie premieres, events, and special offers.</p>
                    </div>
                    <form class="w-full md:w-auto flex-1 max-w-md flex flex-col sm:flex-row gap-3" onsubmit="event.preventDefault();">
                        <input type="email" placeholder="Enter your email address" class="w-full bg-black/30 border border-gray-700 text-white placeholder-gray-500 rounded-xl px-6 py-4 focus:outline-none focus:border-[#df1873] focus:ring-1 focus:ring-[#df1873] transition-all">
                        <button type="submit" class="bg-[#df1873] hover:bg-[#c21463] text-white font-bold px-8 py-4 rounded-xl transition-all shadow-lg shadow-[#df1873]/20 whitespace-nowrap">Subscribe</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Trailer Modal -->
        <div x-show="trailerOpen" x-transition style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-6">
            <div class="absolute inset-0 bg-black/90 backdrop-blur-sm" @click="trailerOpen = false; trailerUrl = ''"></div>
            
            <div class="relative w-full max-w-5xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl border border-gray-800" @click.stop>
                <button @click="trailerOpen = false; trailerUrl = ''" class="absolute top-4 right-4 text-white/70 hover:text-white z-10 bg-black/50 rounded-full p-2 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <template x-if="trailerOpen">
                    <iframe :src="trailerUrl + '?autoplay=1'" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </template>
            </div>
        </div>
    </div>

    <footer class="relative bg-[#050505] pt-20 pb-10 overflow-hidden border-t border-gray-800/60 mt-auto">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#df1873]/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-600/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
         

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-16 reveal-on-scroll">
                
                <div class="lg:col-span-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center group mb-6">
                        <span class="text-3xl font-extrabold tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 group-hover:from-[#df1873] group-hover:to-purple-500 transition-all duration-500">ZUCO</span>
                        <div class="flex flex-col ml-1.5 mt-1">
                            <span class="text-[9px] font-black bg-[#df1873] text-white px-1.5 py-0.5 rounded-sm transform -rotate-6 mb-[2px] leading-none shadow-sm">TICKET</span>
                            <span class="text-[9px] font-black bg-purple-600 text-white px-1.5 py-0.5 rounded-sm transform rotate-6 leading-none shadow-sm">FOOD</span>
                        </div>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8 pr-4 font-medium">
                        Experience the magic of cinema with state-of-the-art visual and audio technology. Book your favorite seats and order snacks in one seamless experience.
                    </p>
                    
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-[#111] border border-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-[#1877F2] hover:text-white hover:border-[#1877F2] transition-all duration-300 hover:shadow-[0_0_15px_rgba(24,119,242,0.4)] hover:-translate-y-1 group">
                            <svg class="w-4 h-4 fill-current group-hover:scale-110 transition-transform" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-[#111] border border-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-[#E4405F] hover:text-white hover:border-[#E4405F] transition-all duration-300 hover:shadow-[0_0_15px_rgba(228,64,95,0.4)] hover:-translate-y-1 group">
                            <svg class="w-4 h-4 fill-current group-hover:scale-110 transition-transform" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-[#111] border border-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-[#1DA1F2] hover:text-white hover:border-[#1DA1F2] transition-all duration-300 hover:shadow-[0_0_15px_rgba(29,161,242,0.4)] hover:-translate-y-1 group">
                            <svg class="w-4 h-4 fill-current group-hover:scale-110 transition-transform" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 lg:col-start-6">
                    <h4 class="font-black text-white mb-6 tracking-wide flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#df1873]"></span> Explore
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('movies.index') }}" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">All Movies</a></li>
                        <li><a href="{{ route('cinemas.index') }}" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">Our Cinemas</a></li>
                        <li><a href="{{ route('movies.index', ['tab' => 'coming_soon']) }}" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">Coming Soon</a></li>
                        <li><a href="{{ route('contact.index') }}" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">Contact Us</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-2">
                    <h4 class="font-black text-white mb-6 tracking-wide flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span> Legal
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">Terms of Service</a></li>
                        <li><a href="#" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">Privacy Policy</a></li>
                        <li><a href="#" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">Ticket Policy</a></li>
                        <li><a href="{{ route('my-tickets') }}" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">My Tickets</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-3">
                    <h4 class="font-black text-white mb-6 tracking-wide flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Contact
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-sm font-medium text-gray-400">
                            <svg class="w-5 h-5 text-gray-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>No. 123, Pyay Road, Kamayut Township, Yangon.</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-gray-400">
                            <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path></svg>
                            <span>+95 9 123 456 789</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium text-gray-400">
                            <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span>hello@zucocinema.com</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="pt-8 border-t border-gray-800/60 flex flex-col md:flex-row justify-between items-center gap-6 reveal-on-scroll">
                <div class="text-sm font-medium text-gray-500 text-center md:text-left">
                    &copy; {{ date('Y') }} ZUCO Cinemas. All rights reserved. <br class="md:hidden">Designed for movie lovers.
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="bg-white/10 px-3 py-1.5 rounded border border-white/5 backdrop-blur-sm text-[10px] font-black tracking-widest text-white uppercase opacity-70 hover:opacity-100 transition-opacity cursor-default">VISA</div>
                    <div class="bg-white/10 px-3 py-1.5 rounded border border-white/5 backdrop-blur-sm text-[10px] font-black tracking-widest text-white uppercase opacity-70 hover:opacity-100 transition-opacity cursor-default">MASTER</div>
                    <div class="bg-white/10 px-3 py-1.5 rounded border border-white/5 backdrop-blur-sm text-[10px] font-black tracking-widest text-white uppercase opacity-70 hover:opacity-100 transition-opacity cursor-default flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-[#186fe0]"></span> KPay
                    </div>
                    <div class="bg-white/10 px-3 py-1.5 rounded border border-white/5 backdrop-blur-sm text-[10px] font-black tracking-widest text-white uppercase opacity-70 hover:opacity-100 transition-opacity cursor-default flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-[#fdc900]"></span> Wave
                    </div>
                </div>
            </div>
            
        </div>
    </footer>

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

            // 3D Tilt Effect
            const cards = document.querySelectorAll('.tilt-card');
            
            cards.forEach(card => {
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = ((y - centerY) / centerY) * -10;
                    const rotateY = ((x - centerX) / centerX) * 10;
                    
                    this.classList.add('glare-effect');
                    this.style.transition = 'none';
                    this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transition = 'transform 0.5s ease';
                    this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
                    this.classList.remove('glare-effect');
                });
            });
        });
    </script>
</x-app-layout>