@if((request()->routeIs('home', 'movie.*','profile.*','about', 'contact.*', 'movies.*', 'book.*', 'cinema.*', 'cinemas.*', 'login', 'my-tickets', 'register', 'password.*') && (!Auth::check() || Auth::user()->role !== 'admin')))
<nav x-data="{ mobileMenuOpen: false }" class="bg-[#0a0a0a]/90 backdrop-blur-md border-b border-gray-800 sticky top-0 z-[100] transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-[70px]">

            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <span class="text-2xl font-extrabold tracking-widest text-white group-hover:text-[#df1873] transition-colors">ZUCO</span>
                    <div class="flex flex-col ml-1 mt-1">
                        <span class="text-[9px] font-bold bg-red-600 text-white px-1 rounded-sm transform -rotate-6 mb-[2px] leading-tight">TICKET</span>
                        <span class="text-[9px] font-bold bg-blue-600 text-white px-1 rounded-sm transform rotate-6 leading-tight">FOOD</span>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex space-x-8 items-center justify-center flex-1">
                <a href="{{ route('movies.index') }}" class="text-white font-bold text-sm hover:text-[#df1873] transition-colors">Movies</a>
                <a href="{{ route('cinemas.index') }}" class="text-white font-bold text-sm hover:text-[#df1873] transition-colors">Cinemas</a>
                <a href="{{ route('contact.index') }}" class="text-white font-bold text-sm hover:text-[#df1873] transition-colors">Contact Us</a>
                <a href="{{ route('about') }}" class="text-white font-bold text-sm hover:text-[#df1873] transition-colors">About Us</a>
            </div>

            <div class="hidden md:flex items-center space-x-6 flex-shrink-0">
                @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.pos') }}" class="text-white font-bold text-sm hover:text-[#df1873] transition-colors">POS</a>
                    <a href="{{ route('my-tickets') }}" class="text-white font-bold text-sm hover:text-[#df1873] transition-colors">My Tickets</a>
                    <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-sm hover:text-[#df1873] transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('my-tickets') }}" class="text-white font-bold text-sm hover:text-[#df1873] transition-colors">My Tickets</a>
                @endif

                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-white font-bold text-sm hover:text-[#df1873] transition-colors focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-white font-bold text-sm hover:text-gray-300 transition-colors">Login</a>
                <a href="{{ route('register') }}" class="bg-[#df1873] hover:bg-[#c21463] text-white font-bold text-sm px-4 py-2 rounded-lg transition-all shadow-lg hover:shadow-pink-500/30">Register</a>
                @endauth
            </div>

            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-300 hover:text-white focus:outline-none p-2 rounded-md hover:bg-gray-800 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" x-show="!mobileMenuOpen"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" x-show="mobileMenuOpen" style="display: none;"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-[#0a0a0a] border-b border-gray-800 absolute w-full left-0 top-[70px] shadow-xl" style="display: none;">
        <div class="px-4 pt-4 pb-6 space-y-3">
            <a href="{{ route('movies.index') }}" class="block text-gray-300 hover:text-[#df1873] hover:bg-gray-900 px-3 py-2 rounded-lg font-bold text-base transition-colors">Movies</a>
            <a href="{{ route('cinemas.index') }}" class="block text-gray-300 hover:text-[#df1873] hover:bg-gray-900 px-3 py-2 rounded-lg font-bold text-base transition-colors">Cinemas</a>
            <a href="{{ route('contact.index') }}" class="block text-gray-300 hover:text-[#df1873] hover:bg-gray-900 px-3 py-2 rounded-lg font-bold text-base transition-colors">Contact Us</a>
            <a href="{{ route('about') }}" class="block text-gray-300 hover:text-[#df1873] hover:bg-gray-900 px-3 py-2 rounded-lg font-bold text-base transition-colors">About Us</a>
            
            <div class="border-t border-gray-800 my-2 pt-2"></div>

            @auth
                <div class="px-3 py-2">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <a href="{{ route('my-tickets') }}" class="block text-gray-300 hover:text-[#df1873] hover:bg-gray-900 px-3 py-2 rounded-lg font-bold text-base transition-colors">My Tickets</a>
                <a href="{{ route('profile.edit') }}" class="block text-gray-300 hover:text-[#df1873] hover:bg-gray-900 px-3 py-2 rounded-lg font-bold text-base transition-colors">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block text-gray-300 hover:text-[#df1873] hover:bg-gray-900 px-3 py-2 rounded-lg font-bold text-base transition-colors">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-gray-300 hover:text-white hover:bg-gray-900 px-3 py-2 rounded-lg font-bold text-base transition-colors">Login</a>
                <a href="{{ route('register') }}" class="block bg-[#df1873] hover:bg-[#c21463] text-white text-center px-3 py-3 rounded-xl font-bold text-base transition-all shadow-lg mt-4">Register Now</a>
            @endauth
        </div>
    </div>
</nav>
@else
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">

    @php
    $dashboardRoute = Auth::check() && Auth::user()->role === 'admin' ? route('admin.dashboard') : route('home');
    $isDashboardActive = Auth::check() && Auth::user()->role === 'admin' ? request()->routeIs('admin.dashboard') : request()->routeIs('home');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ $dashboardRoute }}" class="flex items-center group">
                        <span class="text-2xl font-extrabold tracking-widest text-indigo-600 dark:text-indigo-400 group-hover:text-indigo-500 transition-colors">ZUCO</span>
                        <div class="flex flex-col ml-1 mt-1">
                            <span class="text-[9px] font-bold bg-indigo-600 text-white px-1.5 py-0.5 rounded-sm transform -rotate-6 mb-[2px] leading-tight">ADMIN</span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="$dashboardRoute" :active="$isDashboardActive">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (Auth::check() && Auth::user()->role === 'admin')
                    <x-nav-link :href="route('admin.pos')" :active="request()->routeIs('admin.pos')">
                        {{ __('POS') }}
                    </x-nav-link>
                    <x-nav-link :href="route('my-tickets')" :active="request()->routeIs('my-tickets')">
                        {{ __('My Tickets') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>
                                    <div>Movies & Shows</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.movies.index')">
                                    {{ __('Movies List') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.showtimes.index')">
                                    {{ __('Showtimes') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    <div>Cinema Setup</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.cinemas.index')">
                                    {{ __('Cinemas') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.cinema-halls.index')">
                                    {{ __('Cinema Halls') }}
                                </x-dropdown-link>
                                <div class="border-t border-gray-100 dark:border-gray-700"></div>
                                <x-dropdown-link :href="route('admin.seat-types.index')">
                                    {{ __('Seat Types') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.seats.index')">
                                    {{ __('Seats Layout') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    <div>Food Setup</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.food-types.index')">
                                    {{ __('Food Categories') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.food-items.index')">
                                    {{ __('Food Items') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.cinema-items.index')">
                                    {{ __('Cinema Menus (Stock)') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.pos')">
                                    {{ __('POS / Booking') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 gap-2">
                            <div class="w-7 h-7 bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-400 rounded-full flex items-center justify-center font-bold text-xs">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile Settings') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="text-red-500">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="$dashboardRoute" :active="$isDashboardActive">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if (Auth::check() && Auth::user()->role === 'admin')
            <x-responsive-nav-link :href="route('admin.pos')" :active="request()->routeIs('admin.pos')">
                {{ __('POS') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('my-tickets')" :active="request()->routeIs('my-tickets')">
                {{ __('My Tickets') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.movies.index')">
                {{ __('Movies Management') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.cinemas.index')">
                {{ __('Cinema Setup') }}
            </x-responsive-nav-link>
            @endif
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="text-red-500">{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
@endif