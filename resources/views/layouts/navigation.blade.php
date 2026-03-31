@php
    // Logic to determine if we should show the Frontend Nav or Admin Nav
    $isFrontendPage = request()->routeIs('home', 'movie.*','profile.*','about', 'contact.*', 'movies.*', 'book.*', 'cinema.*', 'cinemas.*', 'login', 'my-tickets', 'register', 'password.*');
    $isAdminUser = Auth::check() && Auth::user()->role === 'admin';
    $showFrontendNav = $isFrontendPage && !$isAdminUser;

    // Logic for Dashboard Route based on role
    $dashboardRoute = $isAdminUser ? route('admin.dashboard') : route('home');
    $isDashboardActive = $isAdminUser ? request()->routeIs('admin.dashboard') : request()->routeIs('home');
@endphp

@if($showFrontendNav)
    <nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
         :class="{'bg-[#0a0a0a]/90 backdrop-blur-xl shadow-lg border-b border-white/10': scrolled, 'bg-transparent border-b border-transparent': !scrolled}"
         class="sticky top-0 z-[100] transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-[80px] transition-all duration-500" :class="{'h-[70px]': scrolled}">

                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <span class="text-3xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 group-hover:from-[#df1873] group-hover:to-purple-500 transition-all duration-500">ZUCO</span>
                        <div class="flex flex-col ml-1.5 mt-1">
                            <span class="text-[9px] font-black bg-[#df1873] text-white px-1.5 py-0.5 rounded-sm transform -rotate-6 mb-[2px] leading-none shadow-[0_0_10px_rgba(223,24,115,0.5)]">TICKET</span>
                            <span class="text-[9px] font-black bg-purple-600 text-white px-1.5 py-0.5 rounded-sm transform rotate-6 leading-none shadow-[0_0_10px_rgba(147,51,234,0.5)]">FOOD</span>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex space-x-10 items-center justify-center flex-1">
                    @foreach(['movies.index' => 'Movies', 'cinemas.index' => 'Cinemas', 'contact.index' => 'Contact Us', 'about' => 'About Us'] as $route => $label)
                        <a href="{{ route($route) }}" class="relative text-gray-300 font-bold text-sm hover:text-white transition-colors group py-2">
                            {{ $label }}
                            <span class="absolute bottom-0 left-0 {{ request()->routeIs($route) ? 'w-full' : 'w-0' }} h-0.5 bg-[#df1873] transition-all duration-300 ease-out group-hover:w-full rounded-full shadow-[0_0_8px_rgba(223,24,115,0.8)]"></span>
                        </a>
                    @endforeach
                </div>

                <div class="hidden md:flex items-center space-x-6 flex-shrink-0">
                    @auth
                        <a href="{{ route('my-tickets') }}" class="text-gray-300 hover:text-white font-bold text-sm transition-colors hover:scale-105 transform relative group">
                            My Tickets
                            <span class="absolute -top-1 -right-2 flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#df1873] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-[#df1873]"></span>
                            </span>
                        </a>

                        <div x-data="{ profileOpen: false }" class="relative" @click.away="profileOpen = false">
                            <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 bg-white/5 hover:bg-white/10 border border-white/10 text-white font-bold text-sm px-4 py-2 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-[#df1873]/50">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-[#df1873] to-purple-500 flex items-center justify-center text-xs text-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg :class="{'rotate-180': profileOpen}" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="profileOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                 class="absolute right-0 mt-3 w-48 bg-[#111]/90 backdrop-blur-2xl border border-white/10 rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.8)] py-2 z-50 overflow-hidden">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 transition-colors group">
                                    <svg class="w-4 h-4 text-gray-500 group-hover:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profile Settings
                                </a>
                                <div class="border-t border-white/5 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors group">
                                        <svg class="w-4 h-4 text-red-500/70 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 font-bold text-sm hover:text-white transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-[#df1873] to-purple-600 hover:from-[#c21463] hover:to-purple-700 text-white font-bold text-sm px-6 py-2.5 rounded-full transition-all shadow-[0_0_15px_rgba(223,24,115,0.4)] hover:shadow-[0_0_25px_rgba(223,24,115,0.6)] transform hover:-translate-y-0.5">Register</a>
                    @endauth
                </div>

                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-300 hover:text-white focus:outline-none p-2 rounded-xl hover:bg-white/5 transition-colors border border-transparent hover:border-white/10">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" x-show="!mobileMenuOpen"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" x-show="mobileMenuOpen" x-cloak/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-cloak
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden bg-[#0a0a0a]/95 backdrop-blur-2xl border-b border-gray-800 absolute w-full left-0 shadow-2xl">
            <div class="px-4 pt-4 pb-6 space-y-2">
                @foreach(['movies.index' => 'Movies', 'cinemas.index' => 'Cinemas', 'contact.index' => 'Contact Us', 'about' => 'About Us'] as $route => $label)
                    <a href="{{ route($route) }}" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl font-bold text-base transition-colors">{{ $label }}</a>
                @endforeach
                
                <div class="border-t border-white/5 my-4"></div>

                @auth
                    <div class="px-4 py-2 mb-2 bg-white/5 rounded-xl border border-white/5">
                        <div class="font-black text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-xs text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                    <a href="{{ route('my-tickets') }}" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl font-bold text-base transition-colors">My Tickets</a>
                    <a href="{{ route('profile.edit') }}" class="block text-gray-300 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl font-bold text-base transition-colors">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block text-red-400 hover:text-red-300 hover:bg-red-500/10 px-4 py-3 rounded-xl font-bold text-base transition-colors">Log Out</button>
                    </form>
                @else
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <a href="{{ route('login') }}" class="block text-center border border-gray-700 hover:border-gray-500 text-white px-3 py-3 rounded-xl font-bold text-base transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="block bg-gradient-to-r from-[#df1873] to-purple-600 text-white text-center px-3 py-3 rounded-xl font-bold text-base transition-all shadow-[0_0_15px_rgba(223,24,115,0.3)]">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

@else
    <nav x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 10) ? true : false"
         :class="{'bg-[#0a0a0a]/80 backdrop-blur-xl border-white/5 shadow-2xl': scrolled, 'bg-[#0a0a0a] border-transparent': !scrolled}"
         class="sticky top-0 z-[100] transition-all duration-500 border-b">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="absolute top-0 left-1/4 w-32 h-1 bg-[#df1873] shadow-[0_0_20px_#df1873] rounded-b-full opacity-50"></div>

            <div class="flex justify-between h-[70px]">
                <div class="flex items-center">
                    
                    <a href="{{ $dashboardRoute }}" class="flex items-center group">
                        <span class="text-2xl font-black tracking-widest text-white group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-indigo-400 group-hover:to-purple-500 transition-all duration-500">ZUCO</span>
                        <div class="flex flex-col ml-1.5 mt-1">
                            <span class="text-[9px] font-black bg-indigo-600 text-white px-1.5 py-0.5 rounded-sm transform -rotate-6 mb-[2px] leading-none shadow-[0_0_10px_rgba(79,70,229,0.5)]">ADMIN</span>
                        </div>
                    </a>

                    <div class="hidden space-x-6 sm:ms-10 sm:flex items-center">
                        <a href="{{ $dashboardRoute }}" class="relative font-bold text-sm transition-colors py-2 group {{ $isDashboardActive ? 'text-white' : 'text-gray-400 hover:text-white' }}">
                            Dashboard
                            <span class="absolute bottom-0 left-0 {{ $isDashboardActive ? 'w-full' : 'w-0' }} h-0.5 bg-indigo-500 transition-all duration-300 ease-out group-hover:w-full rounded-full shadow-[0_0_8px_rgba(99,102,241,0.8)]"></span>
                        </a>

                        <a href="{{ route('my-tickets') }}" class="relative font-bold text-sm transition-colors py-2 group {{ request()->routeIs('my-tickets') ? 'text-white' : 'text-gray-400 hover:text-white' }}">
                            My Tickets
                            <span class="absolute bottom-0 left-0 {{ request()->routeIs('my-tickets') ? 'w-full' : 'w-0' }} h-0.5 bg-indigo-500 transition-all duration-300 ease-out group-hover:w-full rounded-full shadow-[0_0_8px_rgba(99,102,241,0.8)]"></span>
                        </a>

                        <a href="{{ route('admin.reports.index') }}" class="relative font-bold text-sm transition-colors py-2 group {{ request()->routeIs('admin.reports.index') ? 'text-white' : 'text-gray-400 hover:text-white' }}">
                            Reports
                            <span class="absolute bottom-0 left-0 {{ request()->routeIs('admin.reports.index') ? 'w-full' : 'w-0' }} h-0.5 bg-[#df1873] transition-all duration-300 ease-out group-hover:w-full rounded-full shadow-[0_0_8px_rgba(223,24,115,0.8)]"></span>
                        </a>

                        <div x-data="{ opsOpen: false }" class="relative" @mouseenter="opsOpen = true" @mouseleave="opsOpen = false">
                            <button class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-bold transition-all duration-200 text-gray-400 hover:text-white hover:bg-white/5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <span>Operations</span>
                                <svg :class="{'rotate-180': opsOpen}" class="w-3 h-3 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="opsOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-3"
                                 class="absolute left-0 mt-0 w-56 bg-[#111]/95 backdrop-blur-2xl border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.8)] p-2 z-50">
                                
                                <a href="{{ route('admin.pos') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-indigo-500/20 hover:translate-x-1 transition-all group">
                                    <div class="bg-indigo-500/20 p-1.5 rounded-lg text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg></div>
                                    POS / Booking
                                </a>
                                <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-yellow-500/20 hover:translate-x-1 transition-all group">
                                    <div class="bg-yellow-500/20 p-1.5 rounded-lg text-yellow-500 group-hover:bg-yellow-500 group-hover:text-gray-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                    Payments
                                </a>
                                <a href="{{ route('admin.scanner') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-[#df1873]/20 hover:translate-x-1 transition-all group">
                                    <div class="bg-[#df1873]/20 p-1.5 rounded-lg text-[#df1873] group-hover:bg-[#df1873] group-hover:text-white transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg></div>
                                    QR Scanner
                                </a>
                                <div class="border-t border-white/5 my-1 mx-2"></div>
                                <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white hover:bg-blue-500/20 hover:translate-x-1 transition-all group">
                                    <div class="bg-blue-500/20 p-1.5 rounded-lg text-blue-400 group-hover:bg-blue-500 group-hover:text-white transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg></div>
                                    User Messages
                                </a>
                            </div>
                        </div>

                        <div x-data="{ sysOpen: false }" class="relative" @mouseenter="sysOpen = true" @mouseleave="sysOpen = false">
                            <button class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-bold transition-all duration-200 text-gray-400 hover:text-white hover:bg-white/5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>System Setup</span>
                                <svg :class="{'rotate-180': sysOpen}" class="w-3 h-3 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="sysOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-3"
                                 class="absolute left-0 mt-0 w-56 bg-[#111]/95 backdrop-blur-2xl border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.8)] p-2 z-50">
                                
                                <div class="px-3 pt-2 pb-1 text-[10px] font-black text-indigo-400 uppercase tracking-widest">Movies</div>
                                <a href="{{ route('admin.movies.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Movies List</a>
                                <a href="{{ route('admin.showtimes.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Showtimes</a>
                                
                                <div class="border-t border-white/5 my-2 mx-2"></div>
                                
                                <div class="px-3 pt-1 pb-1 text-[10px] font-black text-[#df1873] uppercase tracking-widest">Cinema & Seats</div>
                                <a href="{{ route('admin.cinemas.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Cinemas</a>
                                <a href="{{ route('admin.cinema-halls.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Cinema Halls</a>
                                <a href="{{ route('admin.seat-types.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Seat Types</a>
                                <a href="{{ route('admin.seats.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Seats Layout</a>

                                <div class="border-t border-white/5 my-2 mx-2"></div>

                                <div class="px-3 pt-1 pb-1 text-[10px] font-black text-green-400 uppercase tracking-widest">Food & Snacks</div>
                                <a href="{{ route('admin.food-types.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Categories</a>
                                <a href="{{ route('admin.food-items.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Food Items</a>
                                <a href="{{ route('admin.cinema-items.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 hover:translate-x-1 transition-all">Cinema Menus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div x-data="{ adminProfile: false }" class="relative" @click.away="adminProfile = false">
                        <button @click="adminProfile = !adminProfile" class="flex items-center gap-2 bg-[#111] hover:bg-[#222] border border-gray-700 hover:border-gray-500 text-white font-bold text-sm px-3 py-1.5 rounded-full transition-all focus:outline-none">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-xs text-white shadow-inner">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="ml-1 hidden sm:block">{{ Auth::user()->name }}</span>
                            <svg :class="{'rotate-180': adminProfile}" class="w-4 h-4 text-gray-400 transition-transform duration-300 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="adminProfile" x-cloak
                             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="absolute right-0 mt-3 w-48 bg-[#111]/95 backdrop-blur-2xl border border-white/10 rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.8)] py-2 z-50 overflow-hidden">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-300 hover:text-white hover:bg-white/5 transition-colors group">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Profile Settings
                            </a>
                            <div class="border-t border-white/5 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-red-400 hover:text-red-300 hover:bg-red-500/10 transition-colors group">
                                    <svg class="w-4 h-4 text-red-500/70 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>

                    <button @click="open = ! open" class="sm:hidden inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 border border-transparent transition-all focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
             class="sm:hidden bg-[#0a0a0a]/95 backdrop-blur-2xl border-b border-gray-800 shadow-2xl absolute w-full left-0">
            <div class="px-4 pt-4 pb-6 space-y-1">
                <a href="{{ $dashboardRoute }}" class="block px-4 py-3 rounded-xl font-bold text-base transition-colors {{ $isDashboardActive ? 'bg-indigo-500/20 text-indigo-400' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    Dashboard
                </a>

                <a href="{{ route('my-tickets') }}" class="block px-4 py-3 rounded-xl font-bold text-base transition-colors {{ request()->routeIs('my-tickets') ? 'bg-indigo-500/20 text-indigo-400' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    My Tickets
                </a>

                <a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 rounded-xl font-bold text-base transition-colors {{ request()->routeIs('admin.reports.index') ? 'bg-[#df1873]/20 text-[#df1873]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
                    Reports
                </a>
                
                <div class="pt-4 pb-2">
                    <div class="px-2 text-[10px] font-black text-gray-500 uppercase tracking-widest">Operations</div>
                </div>
                <a href="{{ route('admin.pos') }}" class="block px-4 py-2.5 rounded-xl font-bold text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">POS / Booking</a>
                <a href="{{ route('admin.payments.index') }}" class="block px-4 py-2.5 rounded-xl font-bold text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">Payment Verification</a>
                <a href="{{ route('admin.scanner') }}" class="block px-4 py-2.5 rounded-xl font-bold text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">QR Scanner</a>
                <a href="{{ route('admin.contacts.index') }}" class="block px-4 py-2.5 rounded-xl font-bold text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">Customer Messages</a>

                <div class="pt-4 pb-2">
                    <div class="px-2 text-[10px] font-black text-gray-500 uppercase tracking-widest">System Setup</div>
                </div>
                <a href="{{ route('admin.movies.index') }}" class="block px-4 py-2.5 rounded-xl font-bold text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">Movies & Showtimes</a>
                <a href="{{ route('admin.cinemas.index') }}" class="block px-4 py-2.5 rounded-xl font-bold text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">Cinema Layout</a>
                <a href="{{ route('admin.food-items.index') }}" class="block px-4 py-2.5 rounded-xl font-bold text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-colors">Food & Snacks</a>
            </div>

            <div class="border-t border-white/5 px-4 py-4 bg-white/5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-bold text-white shadow-inner">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-black text-white text-base">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-xs text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <a href="{{ route('profile.edit') }}" class="block text-center border border-gray-700 hover:border-gray-500 text-white px-3 py-2.5 rounded-xl font-bold text-sm transition-colors">Profile Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-center bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 px-3 py-2.5 rounded-xl font-bold text-sm transition-colors">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
@endif