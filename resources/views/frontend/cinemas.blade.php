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

        /* Custom glowing text */
        .text-glow {
            text-shadow: 0 0 30px rgba(223, 24, 115, 0.4);
        }
    </style>

    <div class="relative w-full bg-[#0a0a0a] pt-20 pb-12 overflow-hidden">
        <div class="absolute top-[-50%] left-[20%] w-[600px] h-[600px] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute top-[-20%] right-[10%] w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center reveal-on-scroll">
            <span class="px-4 py-1.5 rounded-full bg-[#111] border border-gray-800 text-[#df1873] text-sm font-bold tracking-widest uppercase mb-6 inline-block shadow-lg">Our Locations</span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">Experience The <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#df1873] to-purple-500 text-glow">Magic</span></h1>
            <p class="text-gray-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">Find a state-of-the-art ZUCO cinema near you and immerse yourself in unparalleled visual and audio experiences.</p>
        </div>
    </div>

    <div class="bg-[#0a0a0a] pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-10 reveal-on-scroll">
                <h2 class="text-2xl font-bold text-white border-l-4 border-[#df1873] pl-4">Available Cinemas</h2>
                <div class="hidden sm:flex space-x-2">
                    <span class="w-2 h-2 rounded-full bg-gray-600"></span>
                    <span class="w-2 h-2 rounded-full bg-gray-600"></span>
                    <span class="w-2 h-2 rounded-full bg-[#df1873] shadow-[0_0_10px_#df1873]"></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                @forelse($cinemas as $cinema)
                <a href="{{ route('cinema.details', $cinema->id) }}" class="reveal-on-scroll group block bg-[#111]/80 backdrop-blur-sm rounded-3xl overflow-hidden border border-gray-800 shadow-xl hover:shadow-[0_20px_40px_-15px_rgba(223,24,115,0.2)] hover:border-[#df1873]/50 transition-all duration-500 transform hover:-translate-y-2">

                    <div class="relative h-64 overflow-hidden">
                        @if($cinema->photoPath)
                        <img src="{{ asset('storage/' . $cinema->photoPath) }}" alt="{{ $cinema->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        @else
                        <div class="w-full h-full bg-gray-900 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        @endif

                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="bg-black/60 backdrop-blur-md border border-white/10 text-white text-[10px] font-black px-2.5 py-1 rounded uppercase tracking-wider">IMAX</span>
                            <span class="bg-[#df1873]/80 backdrop-blur-md border border-white/10 text-white text-[10px] font-black px-2.5 py-1 rounded uppercase tracking-wider">Dolby Atmos</span>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-[#111] via-[#111]/20 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <div class="p-6 relative">
                        <div class="absolute -top-6 right-6 w-12 h-12 bg-[#df1873] rounded-full flex items-center justify-center text-white shadow-[0_0_20px_rgba(223,24,115,0.4)] group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>

                        <h4 class="text-2xl font-extrabold text-white mb-2 group-hover:text-[#df1873] transition-colors">{{ $cinema->name }}</h4>

                        <div class="space-y-3 mt-4">
                            <p class="text-sm text-gray-400 font-medium flex items-start gap-3">
                                <span class="bg-gray-800 p-1.5 rounded-lg text-gray-300 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </span>
                                <span class="mt-1">{{ $cinema->township }}, {{ $cinema->city }}</span>
                            </p>

                            @if($cinema->phone)
                            <p class="text-sm text-gray-400 font-medium flex items-center gap-3">
                                <span class="bg-gray-800 p-1.5 rounded-lg text-gray-300 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path>
                                    </svg>
                                </span>
                                <span>{{ $cinema->phone }}</span>
                            </p>
                            @endif
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-800 flex justify-between items-center">
                            <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Check Showtimes</span>
                            <span class="text-[#df1873] text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity">Book Now →</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-20 bg-[#111] rounded-3xl border border-gray-800 border-dashed reveal-on-scroll">
                    <div class="w-20 h-20 bg-gray-900 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">No Cinemas Yet</h3>
                    <p class="text-gray-500">We are expanding! New cinemas will be added soon.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-24 pt-16 border-t border-gray-800/60 reveal-on-scroll">
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold text-white tracking-wide">The Premium Experience</h2>
                    <p class="text-gray-500 mt-2 text-sm">Elevate your movie nights with our world-class facilities</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-[#111] to-[#0a0a0a] p-8 rounded-3xl border border-gray-800 text-center hover:border-gray-700 transition-colors">
                        <div class="w-16 h-16 bg-gray-900/50 border border-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 text-yellow-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Crystal Clear Visuals</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Experience stunning 4K laser projection that brings every scene to life with vibrant colors.</p>
                    </div>
                    <div class="bg-gradient-to-br from-[#111] to-[#0a0a0a] p-8 rounded-3xl border border-gray-800 text-center hover:border-gray-700 transition-colors">
                        <div class="w-16 h-16 bg-gray-900/50 border border-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 text-purple-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Immersive Audio</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Feel the action with Dolby Atmos multidimensional sound flowing all around you.</p>
                    </div>
                    <div class="bg-gradient-to-br from-[#111] to-[#0a0a0a] p-8 rounded-3xl border border-gray-800 text-center hover:border-gray-700 transition-colors">
                        <div class="w-16 h-16 bg-gray-900/50 border border-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6 text-[#df1873]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5h18z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">Gourmet Treats</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Enjoy chef-inspired snacks, artisan popcorn, and a wide selection of premium beverages.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <x-footer />
</x-app-layout>