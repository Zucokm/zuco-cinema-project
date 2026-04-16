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

    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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