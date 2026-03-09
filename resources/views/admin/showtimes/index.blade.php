<x-app-layout>
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #10b981; border-radius: 10px; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-emerald-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-emerald-500/20 rounded-xl group-hover:border-emerald-500/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-emerald-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Showtimes Schedule
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Manage Movie Screenings</p>
                </div>
            </div>
            
            <a href="{{ route('admin.showtimes.create') }}" class="relative inline-flex group">
                <div class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl blur-md group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200"></div>
                <div class="relative inline-flex items-center gap-2 bg-[#111] border border-emerald-500/50 group-hover:border-transparent text-white font-bold py-2.5 px-6 rounded-xl transition-all duration-300 shadow-[0_0_20px_rgba(16,185,129,0.2)] text-sm">
                    <svg class="w-4 h-4 text-emerald-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Schedule Movie</span>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] right-[-10%] w-[40rem] h-[40rem] bg-emerald-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="mb-8 bg-green-500/10 border border-green-500/30 backdrop-blur-md text-green-400 px-6 py-4 rounded-2xl relative shadow-[0_10px_30px_rgba(34,197,94,0.1)] flex items-start gap-4" role="alert">
                <div class="bg-green-500/20 rounded-xl p-2 shrink-0 text-green-400 mt-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <strong class="font-black text-lg tracking-wide block text-white">Action Successful!</strong>
                    <span class="block text-sm font-medium opacity-80 mt-1">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="absolute top-4 right-4 text-green-500/50 hover:text-green-400 transition-colors p-1.5 hover:bg-green-500/20 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            @endif

            {{-- Glassmorphic Filter Section --}}
            <div class="mb-10 bg-[#111]/80 backdrop-blur-xl p-5 sm:p-6 rounded-[1.5rem] border border-gray-800/60 shadow-xl">
                <form method="GET" action="{{ route('admin.showtimes.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
                    
                    <div class="w-full md:w-1/4">
                        <label for="date" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Filter by Date</label>
                        <input type="date" name="date" value="{{ request('date') }}" class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 font-medium text-sm transition-colors shadow-inner [color-scheme:dark]">
                    </div>

                    <div class="w-full md:w-1/4">
                        <label for="movie_id" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Select Movie</label>
                        <select name="movie_id" class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 font-medium text-sm transition-colors shadow-inner appearance-none cursor-pointer">
                            <option value="">All Movies</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}" {{ request('movie_id') == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-1/4">
                        <label for="cinema_id" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Select Cinema</label>
                        <select name="cinema_id" class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 font-medium text-sm transition-colors shadow-inner appearance-none cursor-pointer">
                            <option value="">All Cinemas</option>
                            @foreach($cinemas as $cinema)
                                <option value="{{ $cinema->id }}" {{ request('cinema_id') == $cinema->id ? 'selected' : '' }}>{{ $cinema->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-auto flex gap-3 h-[46px]">
                        <button type="submit" class="flex-1 md:flex-none bg-emerald-600 hover:bg-emerald-500 text-white px-8 rounded-xl font-bold transition-all shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] flex items-center justify-center">
                            Filter
                        </button>
                        
                        @if(request('date') || request('movie_id') || request('cinema_id'))
                            <a href="{{ route('admin.showtimes.index') }}" class="flex-1 md:flex-none bg-gray-800 hover:bg-gray-700 border border-gray-700 text-white px-6 rounded-xl font-bold transition-all flex items-center justify-center text-sm">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Main Content (Grouped by Date) --}}
            @forelse ($showtimes->groupBy('date') as $date => $dailyShows)
            <div class="mb-10 bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-2xl rounded-[1.5rem] overflow-hidden group">

                <div class="px-6 py-4 bg-[#0a0a0a]/80 border-b border-gray-800/80 flex items-center justify-between">
                    <h3 class="text-lg font-black text-white flex items-center gap-3">
                        <div class="bg-emerald-500/20 p-2 rounded-lg text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                    </h3>
                    <span class="text-[10px] bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-black px-3 py-1.5 rounded-full uppercase tracking-widest">
                        {{ $dailyShows->count() }} Shows
                    </span>
                </div>

                <div class="overflow-x-auto custom-scrollbar">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead class="bg-[#0a0a0a]/30 border-b border-gray-800/50">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest w-1/3">Movie Details</th>
                                <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Location (Hall)</th>
                                <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest text-center">Time Window</th>
                                <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/60">
                            @foreach ($dailyShows as $show)
                            <tr class="hover:bg-gray-800/30 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-16 rounded-lg overflow-hidden border border-gray-700 bg-[#0a0a0a] shadow-md shrink-0">
                                            @if($show->movie->imagePath)
                                                <img src="{{ str_starts_with($show->movie->imagePath, 'http') ? $show->movie->imagePath : asset('storage/' . $show->movie->imagePath) }}" alt="Poster" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[8px] text-gray-600 font-bold uppercase">No Img</div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-black text-white text-base mb-1">{{ $show->movie->title }}</p>
                                            <p class="text-xs text-gray-500 font-medium flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ $show->movie->duration }} mins
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5">
                                    <p class="font-bold text-gray-300 text-sm mb-1">{{ $show->cinemaHall->cinema->name }}</p>
                                    <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest bg-emerald-500/10 px-2 py-0.5 rounded inline-block border border-emerald-500/20">
                                        Hall: {{ $show->cinemaHall->name }}
                                    </p>
                                </td>

                                <td class="px-6 py-5 text-center">
                                    <div class="inline-flex items-center gap-3 bg-[#0a0a0a] border border-gray-800 px-4 py-2 rounded-xl shadow-inner">
                                        <div class="flex flex-col text-right">
                                            <span class="text-[9px] text-gray-500 font-black uppercase tracking-widest">Start</span>
                                            <span class="font-black text-green-400">{{ \Carbon\Carbon::parse($show->start_time)->format('h:i A') }}</span>
                                        </div>
                                        <div class="h-6 w-px bg-gray-700 mx-1"></div>
                                        <div class="flex flex-col text-left">
                                            <span class="text-[9px] text-gray-500 font-black uppercase tracking-widest">End</span>
                                            <span class="font-black text-gray-300">{{ \Carbon\Carbon::parse($show->end_time)->format('h:i A') }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.showtimes.edit', $show->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a0a0a] border border-gray-700 hover:border-emerald-500 text-gray-400 hover:text-emerald-400 hover:bg-emerald-500/10 transition-all duration-300" title="Edit Showtime">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <form action="{{ route('admin.showtimes.destroy', $show->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this showtime?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a0a0a] border border-gray-700 hover:border-red-500 text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-all duration-300" title="Delete Showtime">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @empty
                <div class="py-24 text-center flex flex-col items-center">
                    <div class="relative w-24 h-24 mb-6">
                        <div class="absolute inset-0 bg-emerald-600 blur-xl opacity-20 rounded-full"></div>
                        <div class="relative w-full h-full bg-[#111] rounded-full border border-gray-800 flex items-center justify-center shadow-inner">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">No Showtimes Scheduled</h3>
                    <p class="text-gray-500 font-medium max-w-md mx-auto mb-8">You haven't added any movie screenings yet, or none match your current filters.</p>
                    <a href="{{ route('admin.showtimes.create') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white px-8 py-3.5 rounded-xl font-bold transition shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                        + Schedule a Movie
                    </a>
                </div>
            @endforelse
            
            {{-- Pagination --}}
            @if($showtimes->hasPages())
            <div class="mt-8 bg-[#111]/80 backdrop-blur-md p-4 rounded-[1.5rem] border border-gray-800 shadow-xl">
                {{ $showtimes->links() }}
            </div>
            @endif

        </div>
    </div>
</x-app-layout>