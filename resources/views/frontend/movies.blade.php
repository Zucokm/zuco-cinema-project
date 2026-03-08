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

        /* 3D Tilt Effect Styles */
        .tilt-card {
            transform-style: preserve-3d;
            transform: perspective(1000px);
        }

        .glare-effect {
            position: relative;
            overflow: hidden;
        }

        .glare-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(125deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0) 100%);
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
            z-index: 20;
        }

        .tilt-card:hover .glare-effect::before {
            opacity: 1;
        }

        /* Custom hide scrollbar for filters */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div class="relative bg-[#0a0a0a] min-h-screen pt-12 pb-24 overflow-hidden">

        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-[#df1873]/15 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[40rem] h-[40rem] bg-purple-600/15 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-8 reveal-on-scroll">
                <div>
                    <span class="px-4 py-1.5 rounded-full bg-[#111] border border-gray-800 text-[#df1873] text-sm font-bold tracking-widest uppercase mb-4 inline-block shadow-lg">Discover</span>
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">Browse <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#df1873] to-purple-500 drop-shadow-[0_0_15px_rgba(223,24,115,0.3)]">Movies</span></h1>

                    <div class="flex space-x-6 border-b border-gray-800/80">
                        <a href="{{ route('movies.index', ['tab' => 'now_showing']) }}" class="pb-3 text-sm font-bold uppercase tracking-wider transition-all border-b-2 relative {{ $tab === 'now_showing' ? 'text-[#df1873] border-[#df1873]' : 'text-gray-500 border-transparent hover:text-white' }}">
                            Now Showing
                            @if($tab === 'now_showing')
                            <span class="absolute -bottom-[2px] left-0 w-full h-[2px] bg-[#df1873] shadow-[0_0_10px_#df1873]"></span>
                            @endif
                        </a>
                        <a href="{{ route('movies.index', ['tab' => 'coming_soon']) }}" class="pb-3 text-sm font-bold uppercase tracking-wider transition-all border-b-2 relative {{ $tab === 'coming_soon' ? 'text-[#df1873] border-[#df1873]' : 'text-gray-500 border-transparent hover:text-white' }}">
                            Coming Soon
                            @if($tab === 'coming_soon')
                            <span class="absolute -bottom-[2px] left-0 w-full h-[2px] bg-[#df1873] shadow-[0_0_10px_#df1873]"></span>
                            @endif
                        </a>
                    </div>
                </div>

                <form action="{{ route('movies.index') }}" method="GET" class="relative group w-full md:w-80">
                    @if(request('tab'))
                    <input type="hidden" name="tab" value="{{ request('tab') }}">
                    @endif
                    @if(request('genre'))
                    <input type="hidden" name="genre" value="{{ request('genre') }}">
                    @endif
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies..." class="w-full bg-[#111]/80 backdrop-blur-md border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-2xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 placeholder-gray-600 transition-all shadow-inner text-sm font-medium">
                </form>
            </div>

            <div class="flex flex-col lg:flex-row gap-10 reveal-on-scroll">

                <div class="w-full lg:w-64 shrink-0">
                    <div class="bg-[#111]/60 backdrop-blur-xl rounded-[2rem] p-6 sm:p-8 border border-gray-800 sticky top-24 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                </svg>
                                Filters
                            </h3>
                            @if(request('genre'))
                            <a href="{{ route('movies.index', request()->except('genre')) }}" class="text-[10px] bg-red-500/10 text-red-500 hover:bg-red-500/20 px-2 py-1 rounded font-bold uppercase transition-colors">Clear</a>
                            @endif
                        </div>

                        <div class="flex flex-row lg:flex-col gap-2 overflow-x-auto hide-scrollbar pb-2 lg:pb-0">
                            <a href="{{ route('movies.index', array_merge(request()->except('genre', 'page'))) }}"
                                class="whitespace-nowrap px-4 py-2.5 rounded-xl text-sm font-medium transition-all border {{ !request('genre') ? 'bg-gradient-to-r from-[#df1873] to-[#c21463] text-white border-transparent shadow-[0_0_15px_rgba(223,24,115,0.3)]' : 'bg-[#0a0a0a] text-gray-400 hover:text-white border-gray-800 hover:border-gray-600' }}">
                                All Genres
                            </a>
                            @foreach($genres as $genre)
                            <a href="{{ route('movies.index', array_merge(request()->except('page'), ['genre' => $genre])) }}"
                                class="whitespace-nowrap px-4 py-2.5 rounded-xl text-sm font-medium transition-all border {{ request('genre') == $genre ? 'bg-gradient-to-r from-[#df1873] to-[#c21463] text-white border-transparent shadow-[0_0_15px_rgba(223,24,115,0.3)]' : 'bg-[#0a0a0a] text-gray-400 hover:text-white border-gray-800 hover:border-gray-600' }}">
                                {{ $genre }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    @if($movies->isEmpty())
                    <div class="flex flex-col items-center justify-center py-32 bg-[#111]/40 backdrop-blur-md rounded-[2.5rem] border border-gray-800 border-dashed shadow-2xl">
                        <div class="w-24 h-24 bg-[#0a0a0a] rounded-[2rem] flex items-center justify-center mb-6 shadow-inner border border-gray-800">
                            <svg class="w-10 h-10 text-gray-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">No Movies Found</h3>
                        <p class="text-gray-500 font-medium">Try adjusting your search or category filters.</p>
                        <a href="{{ route('movies.index') }}" class="mt-8 bg-[#df1873]/10 hover:bg-[#df1873] text-[#df1873] hover:text-white border border-[#df1873]/30 px-6 py-2.5 rounded-full font-bold transition-all shadow-[0_0_15px_rgba(223,24,115,0.1)]">Reset Filters</a>
                    </div>
                    @else
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                        @foreach($movies as $movie)
                        <a href="{{ route('movie.details', $movie->id) }}" class="group block">
                            <div class="tilt-card rounded-2xl overflow-hidden aspect-[2/3] mb-5 relative shadow-[0_15px_35px_rgba(0,0,0,0.5)] border border-gray-800 group-hover:border-[#df1873]/50 transition-all duration-300 bg-[#111]">
                                @if($movie->imagePath)
                                <img src="{{ str_starts_with($movie->imagePath, 'http') ? $movie->imagePath : asset('storage/' . $movie->imagePath) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-900 to-black flex flex-col items-center justify-center text-gray-600 p-4 text-center">
                                    <svg class="w-10 h-10 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-xs uppercase tracking-widest font-bold opacity-50">No Poster</span>
                                </div>
                                @endif

                                <div class="absolute top-3 left-3 right-3 flex justify-between items-start z-10 pointer-events-none">
                                    <span class="bg-black/70 backdrop-blur-md text-white text-[10px] font-black px-2.5 py-1 rounded border border-white/10 uppercase tracking-widest shadow-lg">
                                        {{ $movie->language }}
                                    </span>
                                    @if($tab === 'coming_soon')
                                    <span class="bg-blue-600/80 backdrop-blur-md text-white text-[10px] font-black px-2 py-1 rounded uppercase shadow-lg">
                                        Soon
                                    </span>
                                    @endif
                                </div>

                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-70 group-hover:opacity-90 transition-opacity duration-300 pointer-events-none"></div>

                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="bg-[#df1873] text-white text-sm font-bold px-6 py-3 rounded-full shadow-[0_0_20px_rgba(223,24,115,0.4)] transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 flex items-center gap-2">
                                        @if($tab === 'now_showing')
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                        </svg>
                                        Get Tickets
                                        @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        View Info
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="px-1">
                                <h4 class="font-extrabold text-lg text-white truncate group-hover:text-[#df1873] transition-colors" title="{{ $movie->title }}">{{ $movie->title }}</h4>
                                <div class="flex items-center text-xs text-gray-500 mt-1.5 font-medium">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $movie->duration }} m
                                    </span>
                                    <span class="mx-2 text-gray-700">&bull;</span>
                                    <span class="text-gray-400 truncate">{{ $movie->genre ?? 'Genre' }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    <div class="mt-16 bg-[#111]/40 backdrop-blur-md rounded-2xl p-4 border border-gray-800 shadow-xl">
                        {{ $movies->links() }}
                    </div>
                    @endif
                </div>
            </div>
        
        </div>
    </div>

    <footer class="relative bg-[#050505] pt-20 pb-10 overflow-hidden border-t border-gray-800/60 mt-auto">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#df1873]/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-600/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="bg-[#111]/80 backdrop-blur-md rounded-[2rem] p-8 md:p-10 mb-16 border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col md:flex-row items-center justify-between gap-8 reveal-on-scroll">
                <div>
                    <h3 class="text-2xl font-black text-white mb-2 tracking-tight">Join ZUCO VIP Club</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">Subscribe to our newsletter to get exclusive movie offers, early premiere invites, and free popcorn vouchers!</p>
                </div>
                <form class="flex w-full md:w-auto gap-3" onsubmit="event.preventDefault();">
                    <input type="email" placeholder="Enter your email address" class="w-full md:w-72 bg-[#0a0a0a] border border-gray-700 text-white px-5 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 text-sm font-medium transition-all shadow-inner">
                    <button type="submit" class="bg-[#df1873] hover:bg-[#c21463] text-white font-bold px-8 py-3.5 rounded-xl transition-all shadow-[0_0_15px_rgba(223,24,115,0.3)] hover:shadow-[0_0_25px_rgba(223,24,115,0.5)] whitespace-nowrap">Subscribe</button>
                </form>
            </div>

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
            // Scroll Reveal Animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });

            // 3D Tilt Effect Setup
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