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
        .text-glow {
            text-shadow: 0 0 30px rgba(223, 24, 115, 0.5);
        }
        .counter-card:hover .icon-box {
            transform: scale(1.1) rotate(5deg);
            background-color: #df1873;
            color: white;
        }
    </style>

    <div class="relative w-full bg-[#0a0a0a] min-h-screen overflow-hidden">
        <!-- Background Blobs -->
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-[600px] h-[600px] bg-purple-900/10 rounded-full blur-[120px] pointer-events-none"></div>

        <!-- Hero Section -->
        <div class="relative pt-24 pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center reveal-on-scroll">
            <span class="px-4 py-1.5 rounded-full bg-[#111] border border-gray-800 text-[#df1873] text-sm font-bold tracking-widest uppercase mb-8 inline-block shadow-lg">Since 2024</span>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tight leading-tight">
                Redefining The <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#df1873] via-purple-500 to-[#df1873] text-glow">Cinema Experience</span>
            </h1>
            <p class="text-gray-400 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed mb-12">
                ZUCO Cinema is not just a place to watch movies; it's a destination where storytelling meets state-of-the-art technology. We bring magic to life with immersive audio, crystal-clear visuals, and premium comfort.
            </p>
            
            <div class="flex justify-center gap-6">
                <a href="{{ route('movies.index') }}" class="bg-[#df1873] hover:bg-[#c21463] text-white px-8 py-4 rounded-xl font-bold text-lg shadow-[0_0_20px_rgba(223,24,115,0.3)] transition-all hover:-translate-y-1">
                    Book Tickets
                </a>
                <a href="#our-story" class="bg-[#111] hover:bg-[#1a1a1a] text-white border border-gray-800 px-8 py-4 rounded-xl font-bold text-lg transition-all hover:-translate-y-1">
                    Read Our Story
                </a>
            </div>
        </div>

        <!-- Stats Section (Data Rich) -->
        <div class="border-y border-gray-800/50 bg-[#050505]/50 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">
                    <div class="text-center reveal-on-scroll">
                        <div class="text-4xl md:text-5xl font-black text-white mb-2">15+</div>
                        <div class="text-sm text-gray-500 font-bold uppercase tracking-wider">Premium Screens</div>
                    </div>
                    <div class="text-center reveal-on-scroll" style="transition-delay: 100ms;">
                        <div class="text-4xl md:text-5xl font-black text-white mb-2">4K</div>
                        <div class="text-sm text-gray-500 font-bold uppercase tracking-wider">Laser Projection</div>
                    </div>
                    <div class="text-center reveal-on-scroll" style="transition-delay: 200ms;">
                        <div class="text-4xl md:text-5xl font-black text-white mb-2">50k+</div>
                        <div class="text-sm text-gray-500 font-bold uppercase tracking-wider">Happy Customers</div>
                    </div>
                    <div class="text-center reveal-on-scroll" style="transition-delay: 300ms;">
                        <div class="text-4xl md:text-5xl font-black text-white mb-2">24/7</div>
                        <div class="text-sm text-gray-500 font-bold uppercase tracking-wider">Online Booking</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Grid / Story -->
        <div id="our-story" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative reveal-on-scroll">
                    <div class="absolute -inset-4 bg-gradient-to-r from-[#df1873] to-purple-600 rounded-[2.5rem] opacity-30 blur-2xl"></div>
                    <div class="relative grid grid-cols-2 gap-4">
                        <img src="https://i.pinimg.com/736x/76/df/e3/76dfe38700394147edf790fd2e5bfd13.jpg" class="rounded-3xl w-full h-64 object-cover transform translate-y-8 shadow-2xl border border-gray-800">
                        <img src="https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=1000&auto=format&fit=crop" class="rounded-3xl w-full h-64 object-cover shadow-2xl border border-gray-800">
                    </div>
                </div>
                
                <div class="reveal-on-scroll">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">More Than Just A Cinema</h2>
                    <div class="space-y-6 text-gray-400 text-lg leading-relaxed">
                        <p>
                            Founded with a passion for film, <strong class="text-white">ZUCO Cinema</strong> started as a dream to bring world-class entertainment to Myanmar. We believe that every movie is an emotional journey, and the environment you watch it in matters.
                        </p>
                        <p>
                            From our ergonomic reclining seats to our gourmet snack bars, every detail is curated for your enjoyment. We are committed to innovation, constantly upgrading our technology to ensure you see the picture exactly as the director intended.
                        </p>
                        <ul class="space-y-3 mt-4">
                            <li class="flex items-center gap-3 text-white font-medium">
                                <svg class="w-5 h-5 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Dolby Atmos Surround Sound
                            </li>
                            <li class="flex items-center gap-3 text-white font-medium">
                                <svg class="w-5 h-5 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                IMAX & 3D Capabilities
                            </li>
                            <li class="flex items-center gap-3 text-white font-medium">
                                <svg class="w-5 h-5 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Premium VIP Lounges
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Bento Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center mb-16 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold text-white">Why Choose ZUCO?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-[#111] p-8 rounded-3xl border border-gray-800 hover:border-[#df1873]/50 transition-all duration-300 group counter-card reveal-on-scroll">
                    <div class="icon-box w-14 h-14 bg-gray-900 rounded-2xl flex items-center justify-center mb-6 text-[#df1873] transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Easy Booking</h3>
                    <p class="text-gray-400">Seamless online ticketing system. Choose your favorite seats and pay securely in seconds.</p>
                </div>

                <!-- Card 2 (Featured) -->
                <div class="bg-gradient-to-br from-[#1a1a1a] to-[#0a0a0a] p-8 rounded-3xl border border-gray-700 shadow-2xl relative overflow-hidden group counter-card reveal-on-scroll md:-translate-y-4">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#df1873]/20 rounded-full blur-3xl"></div>
                    <div class="icon-box w-14 h-14 bg-[#df1873] rounded-2xl flex items-center justify-center mb-6 text-white transition-all duration-300 shadow-lg shadow-[#df1873]/30">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">VIP Experience</h3>
                    <p class="text-gray-400">Exclusive lounges, reclining leather seats, and personalized service for the ultimate comfort.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-[#111] p-8 rounded-3xl border border-gray-800 hover:border-[#df1873]/50 transition-all duration-300 group counter-card reveal-on-scroll">
                    <div class="icon-box w-14 h-14 bg-gray-900 rounded-2xl flex items-center justify-center mb-6 text-[#df1873] transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Fresh Snacks</h3>
                    <p class="text-gray-400">From classic caramel popcorn to gourmet hotdogs, our snack bar has everything you crave.</p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-t border-gray-800/50">
            <div class="text-center mb-16 reveal-on-scroll">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Meet The Team</h2>
                <p class="text-gray-400">The passionate people behind the screens.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $team = [
                        ['name' => 'Alex Johnson', 'role' => 'Founder & CEO', 'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&auto=format&fit=crop'],
                        ['name' => 'Sarah Smith', 'role' => 'Operations Manager', 'img' => 'https://i.pinimg.com/736x/ab/19/20/ab1920a025b694651a43048618b88096.jpg'],
                        ['name' => 'Mike Brown', 'role' => 'Technical Lead', 'img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=400&auto=format&fit=crop'],
                        ['name' => 'Emily Davis', 'role' => 'Marketing Head', 'img' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=400&auto=format&fit=crop'],
                    ];
                @endphp

                @foreach($team as $member)
                <div class="text-center group reveal-on-scroll">
                    <div class="relative w-32 h-32 md:w-40 md:h-40 mx-auto mb-6 rounded-full overflow-hidden border-2 border-gray-800 group-hover:border-[#df1873] transition-all duration-300">
                        <img src="{{ $member['img'] }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="text-lg font-bold text-white group-hover:text-[#df1873] transition-colors">{{ $member['name'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $member['role'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- CTA -->
        <div class="relative py-24 text-center reveal-on-scroll">
            <div class="absolute inset-0 bg-gradient-to-t from-[#df1873]/10 to-transparent pointer-events-none"></div>
            <h2 class="text-4xl font-black text-white mb-8">Ready for the show?</h2>
            <a href="{{ route('movies.index') }}" class="inline-flex items-center gap-2 bg-white text-black hover:bg-gray-200 px-10 py-4 rounded-full font-bold text-lg transition-all transform hover:scale-105">
                <span>Browse Movies</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

    </div>

    <x-footer />
</x-app-layout>
