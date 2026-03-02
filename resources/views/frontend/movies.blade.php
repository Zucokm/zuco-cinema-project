<x-app-layout>
    <div class="bg-[#0a0a0a] min-h-screen pt-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div class="flex space-x-8 mb-6 md:mb-0">
                    <a href="{{ route('movies.index', ['tab' => 'now_showing']) }}" class="text-2xl font-extrabold tracking-tight transition-colors {{ $tab === 'now_showing' ? 'text-white border-b-4 border-[#df1873] pb-1' : 'text-gray-500 hover:text-gray-300' }}">Now Showing</a>
                    <a href="{{ route('movies.index', ['tab' => 'coming_soon']) }}" class="text-2xl font-extrabold tracking-tight transition-colors {{ $tab === 'coming_soon' ? 'text-white border-b-4 border-[#df1873] pb-1' : 'text-gray-500 hover:text-gray-300' }}">Coming Soon</a>
                </div>
                
                <form action="{{ route('movies.index') }}" method="GET" class="relative group w-full md:w-96">
                    @if(request('tab'))
                        <input type="hidden" name="tab" value="{{ request('tab') }}">
                    @endif
                    @if(request('genre'))
                        <input type="hidden" name="genre" value="{{ request('genre') }}">
                    @endif
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search movies..." class="w-full bg-[#111] border border-gray-800 text-white pl-12 pr-6 py-3 rounded-xl focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 placeholder-gray-600 transition-all shadow-lg">
                </form>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar -->
                <div class="w-full lg:w-64 shrink-0">
                    <div class="bg-[#111] rounded-xl p-6 border border-gray-800 sticky top-24">
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-800 pb-2">Genres</h3>
                        <div class="space-y-2">
                            <a href="{{ route('movies.index', array_merge(request()->except('genre', 'page'))) }}" 
                               class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('genre') ? 'bg-[#df1873] text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                                All Genres
                            </a>
                            @foreach($genres as $genre)
                                <a href="{{ route('movies.index', array_merge(request()->except('page'), ['genre' => $genre])) }}" 
                                   class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request('genre') == $genre ? 'bg-[#df1873] text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                                    {{ $genre }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-1">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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
                                    @if($tab === 'now_showing')
                                        <span class="bg-[#df1873] text-white text-xs font-bold px-4 py-2 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 shadow-lg">Get Tickets</span>
                                    @else
                                        <span class="bg-gray-700 text-white text-xs font-bold px-4 py-2 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 shadow-lg">View Details</span>
                                    @endif
                                </div>
                            </div>
        
                            <h4 class="font-bold text-base text-gray-200 truncate transition group-hover:text-indigo-400" title="{{ $movie->title }}">{{ $movie->title }}</h4>
                            <p class="text-xs text-gray-500 mt-1.5 font-medium">{{ $movie->duration }} mins <span class="mx-1.5 text-gray-700">&bull;</span> {{ $movie->genre ?? 'Action' }}</p>
                        </a>
                        @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-20 bg-[#111] rounded-2xl border border-gray-800 border-dashed">
                            <span class="text-4xl mb-4">🎬</span>
                            <p class="text-gray-400 font-medium">No movies found.</p>
                        </div>
                        @endforelse
                    </div>
        
                    <div class="mt-12">
                        {{ $movies->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>