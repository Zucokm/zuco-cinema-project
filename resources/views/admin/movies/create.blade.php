<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 group">
            <div class="relative">
                <div class="absolute inset-0 bg-indigo-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-indigo-500/20 rounded-xl group-hover:border-indigo-500/50 transition-colors duration-300">
                    <svg class="w-6 h-6 text-indigo-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
            </div>
            <div>
                <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    Add New Movie
                </h2>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Setup Movie Details</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-800/60 p-6 sm:p-10">
                <form method="POST" action="{{ route('admin.movies.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Movie Title <span class="text-red-500">*</span></label>
                            <input id="title" type="text" name="title" required value="{{ old('title') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. Inception">
                            <x-input-error :messages="$errors->get('title')" class="mt-2 text-red-400 text-xs" />
                        </div>
                        <div>
                            <label for="director" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Director</label>
                            <input id="director" type="text" name="director" value="{{ old('director') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. Christopher Nolan">
                            <x-input-error :messages="$errors->get('director')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <label for="genre" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Genre</label>
                            <input id="genre" type="text" name="genre" value="{{ old('genre') }}" placeholder="Action, Sci-Fi..." 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        </div>
                        <div>
                            <label for="language" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Language</label>
                            <input id="language" type="text" name="language" value="English" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        </div>
                        <div>
                            <label for="rating" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Rating (0.0 - 10.0)</label>
                            <input id="rating" type="number" step="0.1" name="rating" value="0.0" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="duration" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Duration (Minutes) <span class="text-red-500">*</span></label>
                            <input id="duration" type="number" name="duration" required value="{{ old('duration') }}" placeholder="120"
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        </div>
                        <div>
                            <label for="releaseDate" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Release Date <span class="text-red-500">*</span></label>
                            <input id="releaseDate" type="date" name="releaseDate" required value="{{ old('releaseDate') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner [color-scheme:dark]">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="trailerLink" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Trailer Link (YouTube URL)</label>
                        <input id="trailerLink" type="url" name="trailerLink" value="{{ old('trailerLink') }}" placeholder="https://www.youtube.com/watch?v=..."
                            class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Synopsis / Description</label>
                        <textarea id="description" name="description" rows="4" 
                            class="w-full bg-[#0a0a0a] border border-gray-800 text-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-medium transition-colors shadow-inner placeholder-gray-700 resize-y" placeholder="Write a brief synopsis of the movie...">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 p-6 bg-[#0a0a0a]/50 border border-gray-800/80 rounded-2xl">
                        <div>
                            <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Movie Poster (Vertical)</label>
                            <input type="file" id="image" name="image" 
                                class="w-full text-sm text-gray-400 file:cursor-pointer file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-500/10 file:text-indigo-400 hover:file:bg-indigo-500/20 file:transition-colors transition-colors" />
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-purple-400 uppercase tracking-widest mb-3">Background Image (Horizontal)</label>
                            <input type="file" id="bg_image" name="bg_image" 
                                class="w-full text-sm text-gray-400 file:cursor-pointer file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-purple-500/10 file:text-purple-400 hover:file:bg-purple-500/20 file:transition-colors transition-colors" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-gray-800/60">
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-400 hover:to-purple-500 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(79,70,229,0.3)] transform hover:-translate-y-0.5">
                            Save Movie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>