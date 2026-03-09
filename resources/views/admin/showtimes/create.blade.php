<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 group">
            <div class="relative">
                <div class="absolute inset-0 bg-emerald-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-emerald-500/20 rounded-xl group-hover:border-emerald-500/50 transition-colors duration-300">
                    <svg class="w-6 h-6 text-emerald-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
            </div>
            <div>
                <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    Add New Showtime
                </h2>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Schedule Movie Screening</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[40rem] h-[40rem] bg-emerald-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-800/60 p-6 sm:p-10">
                
                <form method="POST" action="{{ route('admin.showtimes.store') }}" 
                      x-data="showtimeCalculator()" 
                      x-init="movies = @js($movies)">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-[#0a0a0a]/50 p-6 rounded-2xl border border-gray-800 mb-8">
                        <div>
                            <label for="movie_id" class="block text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-2 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>
                                Select Movie <span class="text-red-500">*</span>
                            </label>
                            <select name="movie_id" id="movie_id" x-model="selectedMovieId" required
                                    class="w-full bg-[#111] border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 font-bold transition-colors shadow-inner appearance-none cursor-pointer">
                                <option value="">-- Choose a Movie --</option>
                                <template x-for="movie in movies" :key="movie.id">
                                    <option :value="movie.id" x-text="`${movie.title} (${movie.duration} mins)`"></option>
                                </template>
                            </select>
                            <x-input-error :messages="$errors->get('movie_id')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="cinema_hall_id" class="block text-[10px] font-black text-purple-400 uppercase tracking-widest mb-2 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                Select Cinema Hall <span class="text-red-500">*</span>
                            </label>
                            <select name="cinema_hall_id" id="cinema_hall_id" required
                                    class="w-full bg-[#111] border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 font-bold transition-colors shadow-inner appearance-none cursor-pointer">
                                <option value="">-- Choose a Hall --</option>
                                @foreach($halls as $hall)
                                    <option value="{{ $hall->id }}">{{ $hall->cinema->name }} - {{ $hall->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('cinema_hall_id')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-2">
                        <div>
                            <label for="date" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Show Date <span class="text-red-500">*</span></label>
                            <input type="date" name="date" id="date" required 
                                   class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 font-bold transition-colors shadow-inner [color-scheme:dark]" />
                            <x-input-error :messages="$errors->get('date')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="start_time" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Start Time <span class="text-red-500">*</span></label>
                            <input type="time" name="start_time" id="start_time" x-model="startTime" required 
                                   class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 font-bold transition-colors shadow-inner [color-scheme:dark]" />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="end_time" class="block text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2 flex items-center justify-between">
                                End Time 
                                <span class="bg-gray-800 text-[8px] px-1.5 py-0.5 rounded text-emerald-400">Auto Computed</span>
                            </label>
                            <input type="time" id="end_time" x-bind:value="calculatedEndTime" disabled 
                                   class="w-full bg-[#111] border border-gray-800/50 text-emerald-500 rounded-xl px-4 py-3 font-black cursor-not-allowed shadow-inner [color-scheme:dark]" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-gray-800/60">
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Save Showtime
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function showtimeCalculator() {
            return {
                movies: [],
                selectedMovieId: '',
                startTime: '',
                
                get calculatedEndTime() {
                    if (!this.selectedMovieId || !this.startTime) return '';
                    let movie = this.movies.find(m => m.id == this.selectedMovieId);
                    if (!movie) return '';
                    
                    let timeParts = this.startTime.split(':');
                    let hours = parseInt(timeParts[0]);
                    let minutes = parseInt(timeParts[1]);
                    
                    let date = new Date();
                    date.setHours(hours);
                    date.setMinutes(minutes + movie.duration); 
                    
                    let endHours = String(date.getHours()).padStart(2, '0');
                    let endMinutes = String(date.getMinutes()).padStart(2, '0');
                    
                    return `${endHours}:${endMinutes}`;
                }
            }
        }
    </script>
</x-app-layout>