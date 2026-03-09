<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-[#df1873] blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-[#df1873]/20 rounded-xl group-hover:border-[#df1873]/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-[#df1873] transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Point of Sale (POS)
                    </h2>
                    <p class="text-xs font-bold text-[#df1873] uppercase tracking-widest mt-0.5">Quick Booking System</p>
                </div>
            </div>
            
            <div class="bg-[#111] border border-gray-800 px-4 py-2 rounded-xl flex items-center gap-2 shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-xs font-bold text-gray-300 uppercase tracking-widest">System Online</span>
            </div>
        </div>
    </x-slot>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #df1873; border-radius: 10px; }
        /* Clean input date picker icon for dark mode */
        ::-webkit-calendar-picker-indicator { filter: invert(1); opacity: 0.5; cursor: pointer; }
        ::-webkit-calendar-picker-indicator:hover { opacity: 1; }
    </style>

    <div class="bg-[#0a0a0a] min-h-screen py-10 relative overflow-hidden">
        
        <div class="absolute top-[-5%] left-[-10%] w-[40rem] h-[40rem] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[30rem] h-[30rem] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/30 backdrop-blur-md rounded-2xl p-6 mb-8 flex flex-col lg:flex-row justify-between items-center gap-6 shadow-[0_10px_30px_rgba(34,197,94,0.15)] animate-fade-in-down">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-500/20 p-3 rounded-xl text-green-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="font-black text-xl text-white tracking-wide">Booking Confirmed!</p>
                            <p class="text-gray-400 font-medium mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                    
                    @if(session('last_booking_id'))
                    <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                        <a href="{{ route('booking.ticket', session('last_booking_id')) }}" target="_blank" class="flex-1 lg:flex-none flex items-center justify-center gap-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-400 hover:to-emerald-500 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-[0_0_20px_rgba(34,197,94,0.3)] transform hover:-translate-y-0.5 whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Print Ticket
                        </a>
                        <a href="{{ route('admin.pos') }}" class="flex-1 lg:flex-none flex items-center justify-center gap-2 bg-[#111] hover:bg-gray-800 border border-gray-700 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg transform hover:-translate-y-0.5 whitespace-nowrap">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            New Booking
                        </a>
                    </div>
                    @endif
                </div>
            @endif

            <div class="mb-10 bg-[#111]/80 backdrop-blur-xl p-5 rounded-[1.5rem] shadow-xl border border-gray-800/60">
                <form action="{{ route('admin.pos') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    
                    <div class="w-full md:w-1/4">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Select Date</label>
                        <input type="date" name="date" value="{{ $selectedDate }}" class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors shadow-inner">
                    </div>

                    <div class="w-full md:w-1/4">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Cinema Location</label>
                        <select name="cinema_id" class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors shadow-inner appearance-none cursor-pointer">
                            <option value="">All Cinemas (Network)</option>
                            @foreach($cinemas as $cinema)
                                <option value="{{ $cinema->id }}" {{ $selectedCinema == $cinema->id ? 'selected' : '' }}>{{ $cinema->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-2/4">
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Search Movie</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter movie title..." class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl pl-12 pr-4 py-3 focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors shadow-inner">
                        </div>
                    </div>

                    <div class="w-full md:w-auto flex gap-3 h-[46px]">
                        <button type="submit" class="flex-1 md:flex-none bg-[#df1873] hover:bg-[#c21463] text-white px-8 rounded-xl font-bold transition-all shadow-[0_0_15px_rgba(223,24,115,0.3)] hover:shadow-[0_0_20px_rgba(223,24,115,0.5)] flex items-center justify-center">
                            Search
                        </button>
                        
                        @if(request('search') || request('cinema_id') || request('date') != \Carbon\Carbon::today()->format('Y-m-d'))
                            <a href="{{ route('admin.pos') }}" class="flex-1 md:flex-none bg-gray-800 hover:bg-gray-700 border border-gray-700 text-white px-6 rounded-xl font-bold transition-all flex items-center justify-center text-sm">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($movies as $movie)
                <div class="bg-[#111]/80 backdrop-blur-xl rounded-[2rem] border border-gray-800/60 overflow-hidden hover:border-[#df1873]/50 transition-all duration-300 group flex flex-col h-full shadow-2xl">
                    
                    <div class="relative h-64 overflow-hidden shrink-0">
                        @if($movie->imagePath)
                            <img src="{{ str_starts_with($movie->imagePath, 'http') ? $movie->imagePath : asset('storage/' . $movie->imagePath) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-[#0a0a0a] flex items-center justify-center flex-col gap-2 border-b border-gray-800">
                                <svg class="w-10 h-10 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>
                                <span class="text-gray-600 text-[10px] font-black uppercase tracking-widest">No Poster</span>
                            </div>
                        @endif
                        
                        <div class="absolute top-4 right-4 bg-[#0a0a0a]/80 backdrop-blur-md border border-gray-700 text-white text-[10px] font-black tracking-widest uppercase px-3 py-1.5 rounded-lg">
                            {{ $movie->duration }} mins
                        </div>
                        
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/80 to-transparent p-5 pt-16">
                            <h3 class="text-xl font-black text-white truncate drop-shadow-md" title="{{ $movie->title }}">{{ $movie->title }}</h3>
                            <div class="flex items-center gap-2 mt-1.5">
                                <span class="text-xs font-bold text-[#df1873] uppercase tracking-wider">{{ $movie->language }}</span>
                                <span class="w-1 h-1 bg-gray-500 rounded-full"></span>
                                <span class="text-xs font-medium text-gray-400 truncate">{{ $movie->genre ?? 'Genre N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-5 flex-1 flex flex-col bg-[#0a0a0a]/30">
                        <div class="flex items-center gap-2 mb-4 border-b border-gray-800 pb-3">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Select Showtime</span>
                        </div>

                        <div class="flex-1 overflow-y-auto custom-scrollbar pr-2 space-y-4 max-h-[220px]">
                            @forelse($movie->showtimes->groupBy('date')->sortKeys() as $date => $showtimes)
                                <div>
                                    <p class="text-gray-500 font-bold text-[10px] mb-2.5 uppercase tracking-widest">
                                        {{ \Carbon\Carbon::parse($date)->format('D, M d') }}
                                    </p>
                                    <div class="grid grid-cols-2 gap-2.5">
                                        @foreach($showtimes->sortBy('start_time') as $showtime)
                                            <a href="{{ route('book.seats', $showtime->id) }}" class="group/btn flex flex-col items-center justify-center bg-[#111] hover:bg-[#df1873] border border-gray-700 hover:border-[#df1873] rounded-xl p-2.5 transition-all duration-300 text-center cursor-pointer shadow-sm hover:shadow-[0_0_15px_rgba(223,24,115,0.4)]">
                                                <span class="text-sm font-black text-white group-hover/btn:text-white">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                                <span class="text-[9px] font-bold text-gray-500 group-hover/btn:text-pink-100 uppercase tracking-wider truncate w-full mt-0.5">{{ $showtime->cinemaHall->name }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="h-full flex flex-col items-center justify-center text-center py-6">
                                    <div class="w-10 h-10 bg-[#111] rounded-full flex items-center justify-center mb-2">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">No Shows Today</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($movies->isEmpty())
                <div class="bg-[#111]/80 backdrop-blur-xl rounded-[2rem] border border-gray-800 shadow-2xl p-16 flex flex-col items-center justify-center text-center mt-4">
                    <div class="w-24 h-24 bg-[#0a0a0a] rounded-full border border-gray-800 flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">No Movies Found</h3>
                    <p class="text-gray-500 font-medium max-w-sm">There are no active showtimes matching your current filters. Try selecting a different date or cinema.</p>
                    <a href="{{ route('admin.pos') }}" class="mt-8 bg-[#111] hover:bg-gray-800 border border-gray-700 text-white font-bold py-3 px-8 rounded-xl transition-colors text-sm">
                        Clear Filters
                    </a>
                </div>
            @endif

            <div class="mt-10 bg-[#111]/60 backdrop-blur-md p-4 rounded-2xl border border-gray-800">
                {{ $movies->links() }}
            </div>

        </div>
    </div>
</x-app-layout>