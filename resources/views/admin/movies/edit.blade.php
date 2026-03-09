<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 group">
            <div class="relative">
                <div class="absolute inset-0 bg-yellow-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-yellow-500/20 rounded-xl group-hover:border-yellow-500/50 transition-colors duration-300">
                    <svg class="w-6 h-6 text-yellow-500 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
            </div>
            <div>
                <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    Edit Movie
                </h2>
                <p class="text-xs font-bold text-yellow-500 uppercase tracking-widest mt-0.5">{{ $movie->title }}</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] bg-yellow-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-800/60 p-6 sm:p-10">
                <form method="POST" action="{{ route('admin.movies.update', $movie->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Movie Title <span class="text-red-500">*</span></label>
                            <input id="title" type="text" name="title" required value="{{ old('title', $movie->title) }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        </div>
                        <div>
                            <label for="director" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Director</label>
                            <input id="director" type="text" name="director" value="{{ old('director', $movie->director) }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <label for="genre" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Genre</label>
                            <input id="genre" type="text" name="genre" value="{{ old('genre', $movie->genre) }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        </div>
                        <div>
                            <label for="language" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Language</label>
                            <input id="language" type="text" name="language" value="{{ old('language', $movie->language) }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        </div>
                        <div>
                            <label for="rating" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Rating</label>
                            <input id="rating" type="number" step="0.1" name="rating" value="{{ old('rating', $movie->rating) }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-bold transition-colors shadow-inner">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="duration" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Duration (Minutes) <span class="text-red-500">*</span></label>
                            <input id="duration" type="number" name="duration" required value="{{ old('duration', $movie->duration) }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        </div>
                        <div>
                            <label for="releaseDate" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Release Date <span class="text-red-500">*</span></label>
                            <input id="releaseDate" type="date" name="releaseDate" required value="{{ old('releaseDate', $movie->releaseDate) }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-bold transition-colors shadow-inner [color-scheme:dark]">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Synopsis / Description</label>
                        <textarea id="description" name="description" rows="4" 
                            class="w-full bg-[#0a0a0a] border border-gray-800 text-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-medium transition-colors shadow-inner placeholder-gray-700 resize-y">{{ old('description', $movie->description) }}</textarea>
                    </div>

                    <div class="mt-8 bg-[#0a0a0a]/50 border border-gray-800/80 rounded-2xl p-6">
                        <h4 class="text-xs font-black text-white uppercase tracking-widest mb-4 border-b border-gray-800 pb-2">Media Assets</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Current Poster</label>
                                </div>
                                @if($movie->imagePath)
                                    <div class="w-28 h-40 rounded-xl overflow-hidden border border-gray-700 shadow-lg mb-4">
                                        <img src="{{ str_starts_with($movie->imagePath, 'http') ? $movie->imagePath : asset('storage/'.$movie->imagePath) }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-28 h-40 rounded-xl border border-dashed border-gray-700 bg-[#111] flex items-center justify-center text-xs text-gray-500 mb-4">No Poster</div>
                                @endif
                                <label class="block text-[10px] font-bold text-gray-500 mb-1">Replace Poster (Optional)</label>
                                <input type="file" name="image" 
                                    class="w-full text-sm text-gray-400 file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-500/10 file:text-indigo-400 hover:file:bg-indigo-500/20 transition-colors" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <label class="block text-[10px] font-black text-purple-400 uppercase tracking-widest">Current Background</label>
                                </div>
                                @if($movie->bgImagePath)
                                    <div class="w-full max-w-[240px] h-32 rounded-xl overflow-hidden border border-gray-700 shadow-lg mb-4 relative">
                                        <img src="{{ str_starts_with($movie->bgImagePath, 'http') ? $movie->bgImagePath : asset('storage/'.$movie->bgImagePath) }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-full max-w-[240px] h-32 rounded-xl border border-dashed border-gray-700 bg-[#111] flex items-center justify-center text-xs text-gray-500 mb-4">No Background</div>
                                @endif
                                <label class="block text-[10px] font-bold text-gray-500 mb-1">Replace Background (Optional)</label>
                                <input type="file" name="bg_image" 
                                    class="w-full text-sm text-gray-400 file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-purple-500/10 file:text-purple-400 hover:file:bg-purple-500/20 transition-colors" />
                            </div>

                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-800/60">
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-yellow-600 to-orange-500 hover:from-yellow-500 hover:to-orange-400 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(202,138,4,0.3)] transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Update Movie
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>