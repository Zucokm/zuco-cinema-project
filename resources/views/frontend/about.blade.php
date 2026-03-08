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
        });
    </script>
</x-app-layout>
