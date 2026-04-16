@props(['showNewsletter' => true])

<footer class="relative bg-[#050505] pt-20 pb-10 overflow-hidden border-t border-gray-800/60 mt-auto">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#df1873]/5 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-600/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        @if($showNewsletter)
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
        @endif

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
                    <li><a href="{{ route('privacy') }}" class="text-sm font-medium text-gray-400 hover:text-white hover:translate-x-1 inline-block transition-all">Privacy Policy</a></li>
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
