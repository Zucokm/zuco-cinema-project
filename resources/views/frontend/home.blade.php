<x-app-layout>

    
    <div class="bg-[#0a0a0a] min-h-screen pt-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-20 mt-4">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6 tracking-tight">Let's Find Your Next Movie</h2>
                <div class="max-w-2xl mx-auto relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search movies, genres..." class="w-full bg-[#111] border border-gray-800 text-white pl-12 pr-6 py-4 rounded-xl focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 placeholder-gray-600 transition-all shadow-lg">
                </div>
            </div>

            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-white tracking-wide">Recommended Movies</h3>
                    <a href="#" class="text-sm font-semibold text-indigo-500 hover:text-indigo-400 transition-colors">View All &rarr;</a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 md:gap-8">
                    @forelse($movies as $movie)
                    <a href="{{ route('movie.details', $movie->id) }}" class="group block">
                        <div class="rounded-xl overflow-hidden aspect-[2/3] mb-4 relative shadow-lg border border-gray-800 group-hover:border-indigo-500/50 transition-colors duration-300">
                            @if($movie->imagePath)
                            <img src="{{ asset('storage/' . $movie->imagePath) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                            <div class="w-full h-full bg-[#111] flex flex-col items-center justify-center text-gray-600 p-4 text-center">
                                <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs uppercase tracking-wider font-semibold">No Poster</span>
                            </div>
                            @endif

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


            <div>
                <h3 class="text-2xl font-bold text-white tracking-wide mb-8">Experience ZUCO Cinemas</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    @foreach($cinemas as $cinema)
                    <a href="#" class="relative rounded-2xl overflow-hidden aspect-video group cursor-pointer border border-gray-800 shadow-xl block">
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
                        <a href="#" class="hover:text-indigo-400 transition-colors">Ig</a>
                        <a href="#" class="hover:text-indigo-400 transition-colors">X</a>
                        <a href="#" class="hover:text-indigo-400 transition-colors">Yt</a>
                        <a href="#" class="hover:text-indigo-400 transition-colors">Tg</a>
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