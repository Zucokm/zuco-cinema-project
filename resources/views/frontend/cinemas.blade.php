<x-app-layout>
    <div class="bg-[#0a0a0a] min-h-screen pt-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4 tracking-tight">Our Cinemas</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Experience the magic of movies at our state-of-the-art cinema locations across the country.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($cinemas as $cinema)
                <a href="{{ route('cinema.details', $cinema->id) }}" class="relative rounded-2xl overflow-hidden aspect-video group cursor-pointer border border-gray-800 shadow-xl block hover:border-[#df1873]/50 transition-all duration-300">
                    @if($cinema->photoPath)
                    <img src="{{ asset('storage/' . $cinema->photoPath) }}" alt="{{ $cinema->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    @else
                    <div class="w-full h-full bg-gray-800 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/40 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="absolute bottom-0 left-0 w-full p-6 text-left transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                        <div class="flex justify-between items-end">
                            <div>
                                <h4 class="text-xl font-extrabold text-white mb-1">{{ $cinema->name }}</h4>
                                <p class="text-sm text-gray-300 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $cinema->township }}, {{ $cinema->city }}
                                </p>
                            </div>
                            <div class="bg-[#df1873] p-2 rounded-full text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-x-4 group-hover:translate-x-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-500">No cinemas found.</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>