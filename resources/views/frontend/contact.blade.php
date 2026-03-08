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
        /* Hide map controls cleanly */
        .gmnoprint {
            display: none !important;
        }
    </style>

    <div class="relative w-full bg-[#0a0a0a] min-h-screen overflow-hidden pb-24">
        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-[#df1873]/15 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40rem] h-[40rem] bg-purple-600/15 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
            
            <div class="text-center mb-16 reveal-on-scroll">
                <span class="px-4 py-1.5 rounded-full bg-[#111] border border-gray-800 text-[#df1873] text-sm font-bold tracking-widest uppercase mb-6 inline-block shadow-lg">Get In Touch</span>
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight">We'd Love To <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#df1873] to-purple-500 drop-shadow-[0_0_15px_rgba(223,24,115,0.3)]">Hear From You</span></h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">Have a question about showtimes, tickets, or just want to say hello? Our team is here to help you.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                
                <div class="space-y-6 reveal-on-scroll">
                    <div class="bg-[#111]/60 backdrop-blur-xl p-8 rounded-[2rem] border border-gray-800 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:border-[#df1873]/50 hover:bg-[#111]/80 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-[#0a0a0a] border border-gray-800 rounded-2xl flex items-center justify-center mb-6 text-[#df1873] group-hover:scale-110 group-hover:shadow-[0_0_15px_rgba(223,24,115,0.3)] transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Visit Us</h3>
                        <p class="text-gray-400 leading-relaxed font-medium">No. 123, Pyay Road, Kamayut Township,<br>Yangon, Myanmar.</p>
                    </div>

                    <div class="bg-[#111]/60 backdrop-blur-xl p-8 rounded-[2rem] border border-gray-800 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:border-purple-500/50 hover:bg-[#111]/80 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-[#0a0a0a] border border-gray-800 rounded-2xl flex items-center justify-center mb-6 text-purple-500 group-hover:scale-110 group-hover:shadow-[0_0_15px_rgba(168,85,247,0.3)] transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Email Us</h3>
                        <p class="text-gray-400 leading-relaxed mb-1 font-medium">General: <a href="mailto:info@zucocinema.com" class="hover:text-purple-400 transition-colors">info@zucocinema.com</a></p>
                        <p class="text-gray-400 leading-relaxed font-medium">Support: <a href="mailto:support@zucocinema.com" class="hover:text-purple-400 transition-colors">support@zucocinema.com</a></p>
                    </div>

                    <div class="bg-[#111]/60 backdrop-blur-xl p-8 rounded-[2rem] border border-gray-800 shadow-[0_10px_30px_rgba(0,0,0,0.5)] hover:border-blue-500/50 hover:bg-[#111]/80 transition-all duration-300 group">
                        <div class="w-14 h-14 bg-[#0a0a0a] border border-gray-800 rounded-2xl flex items-center justify-center mb-6 text-blue-500 group-hover:scale-110 group-hover:shadow-[0_0_15px_rgba(59,130,246,0.3)] transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Call Us</h3>
                        <p class="text-gray-400 leading-relaxed mb-1 font-medium"><a href="tel:+959123456789" class="hover:text-blue-400 transition-colors">+95 9 123 456 789</a></p>
                        <p class="text-gray-400 leading-relaxed font-medium">Mon - Sun: 9:00 AM - 10:00 PM</p>
                    </div>
                </div>

                <div class="reveal-on-scroll">
                    <div class="bg-[#111]/80 backdrop-blur-xl p-8 md:p-10 rounded-[2.5rem] border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative overflow-hidden">
                        
                        @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" class="mb-8 bg-green-900/20 border border-green-500/50 text-green-400 px-6 py-4 rounded-2xl flex items-start gap-4 relative shadow-lg">
                            <div class="bg-green-500/20 rounded-full p-2 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="pt-0.5">
                                <strong class="font-bold text-lg block text-white">Message Sent!</strong>
                                <span class="text-sm opacity-90 mt-1 block">{{ session('success') }}</span>
                            </div>
                            <button @click="show = false" class="absolute top-4 right-4 text-green-400 hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-bold text-gray-300 mb-2">Your Name</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                        <input type="text" name="name" id="name" required class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600" placeholder="John Doe">
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-300 mb-2">Email Address</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <input type="email" name="email" id="email" required class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600" placeholder="john@example.com">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-bold text-gray-300 mb-2">Subject</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                    </div>
                                    <input type="text" name="subject" id="subject" required class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600" placeholder="How can we help?">
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-bold text-gray-300 mb-2">Message</label>
                                <textarea name="message" id="message" rows="5" required class="w-full bg-[#0a0a0a] border border-gray-800 text-white px-4 py-4 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 transition-all shadow-inner text-sm font-medium placeholder-gray-600 resize-none" placeholder="Write your message here..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-[#df1873] hover:bg-[#c21463] text-white font-bold py-4 rounded-xl transition-all shadow-[0_0_20px_rgba(223,24,115,0.3)] hover:shadow-[0_0_25px_rgba(223,24,115,0.5)] flex justify-center items-center gap-2 group mt-8">
                                <span>Send Message</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="mt-24 reveal-on-scroll relative">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-white tracking-tight flex items-center justify-center gap-3">
                        <svg class="w-8 h-8 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        Find Us Here
                    </h2>
                </div>
                
                <div class="relative p-2 bg-[#111]/80 backdrop-blur-md rounded-[2.5rem] border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                    <div id="map" class="h-[450px] md:h-[500px] w-full rounded-[2rem] overflow-hidden bg-[#0a0a0a]"></div>
                    
                    <div class="absolute bottom-8 left-8 bg-[#0a0a0a]/90 backdrop-blur-xl border border-gray-800 p-5 rounded-2xl shadow-2xl flex items-center gap-4 pointer-events-none">
                        <div class="bg-[#df1873] p-3 rounded-xl text-white shadow-[0_0_15px_rgba(223,24,115,0.4)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold">ZUCO Cinema (Main)</h4>
                            <p class="text-gray-400 text-xs font-medium mt-1">Junction Square, Yangon</p>
                        </div>
                    </div>
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

        // Google Maps Initialization
        function initMap() {
            // Coordinates for Pyay Road, Kamayut Township, Yangon
            const zucoLocation = { lat: 16.8284, lng: 96.1299 }; 
            
            // Custom Dark Theme (Aubergine adjusted for Pitch Black)
            const mapStyles = [
                { "elementType": "geometry", "stylers": [{ "color": "#111111" }] },
                { "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] },
                { "elementType": "labels.text.stroke", "stylers": [{ "color": "#212121" }] },
                { "featureType": "administrative", "elementType": "geometry", "stylers": [{ "color": "#757575" }] },
                { "featureType": "administrative.country", "elementType": "labels.text.fill", "stylers": [{ "color": "#9e9e9e" }] },
                { "featureType": "administrative.land_parcel", "stylers": [{ "visibility": "off" }] },
                { "featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{ "color": "#bdbdbd" }] },
                { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] },
                { "featureType": "poi.park", "elementType": "geometry", "stylers": [{ "color": "#181818" }] },
                { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [{ "color": "#616161" }] },
                { "featureType": "poi.park", "elementType": "labels.text.stroke", "stylers": [{ "color": "#1b1b1b" }] },
                { "featureType": "road", "elementType": "geometry.fill", "stylers": [{ "color": "#2c2c2c" }] },
                { "featureType": "road", "elementType": "labels.text.fill", "stylers": [{ "color": "#8a8a8a" }] },
                { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#373737" }] },
                { "featureType": "road.highway", "elementType": "geometry", "stylers": [{ "color": "#3c3c3c" }] },
                { "featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [{ "color": "#4e4e4e" }] },
                { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [{ "color": "#616161" }] },
                { "featureType": "transit", "elementType": "labels.text.fill", "stylers": [{ "color": "#757575" }] },
                { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#000000" }] },
                { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{ "color": "#3d3d3d" }] }
            ];

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: zucoLocation,
                styles: mapStyles,
                disableDefaultUI: true, // Hides messy default UI
                zoomControl: true,      // Keeps only zoom buttons
            });

            // The exact custom Pink SVG marker you provided
            const marker = new google.maps.Marker({
                position: zucoLocation,
                map: map,
                title: "ZUCO Cinema",
                icon: {
                    url: "data:image/svg+xml;charset=UTF-8," + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23df1873" width="48px" height="48px"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>'),
                    scaledSize: new google.maps.Size(48, 48)
                },
                animation: google.maps.Animation.DROP
            });
        }
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
</x-app-layout>