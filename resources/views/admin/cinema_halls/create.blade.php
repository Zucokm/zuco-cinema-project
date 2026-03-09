<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 group">
            <div class="relative">
                <div class="absolute inset-0 bg-purple-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-purple-500/20 rounded-xl group-hover:border-purple-500/50 transition-colors duration-300">
                    <svg class="w-6 h-6 text-purple-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
            <div>
                <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    Add New Cinema Hall
                </h2>
                <p class="text-xs font-bold text-purple-500 uppercase tracking-widest mt-0.5">Setup a new screen</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] right-[-10%] w-[40rem] h-[40rem] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-800/60 p-6 sm:p-10">
                
                <form method="POST" action="{{ route('admin.cinema-halls.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="bg-[#0a0a0a]/50 p-6 rounded-2xl border border-gray-800 mb-8">
                        <label for="cinema_id" class="block text-[10px] font-black text-cyan-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Select Cinema Location <span class="text-red-500">*</span>
                        </label>
                        <select name="cinema_id" id="cinema_id" required 
                                class="w-full bg-[#111] border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50 font-bold transition-colors shadow-inner appearance-none cursor-pointer">
                            <option value="">-- Choose a Cinema --</option>
                            @foreach($cinemas as $cinema)
                                <option value="{{ $cinema->id }}">{{ $cinema->name }} ({{ $cinema->township }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('cinema_id')" class="mt-2 text-red-400 text-xs" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Hall Name <span class="text-red-500">*</span></label>
                            <input id="name" type="text" name="name" required value="{{ old('name') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. IMAX Hall 1">
                        </div>
                        <div>
                            <label for="totalSeats" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Total Seats <span class="text-red-500">*</span></label>
                            <input id="totalSeats" type="number" name="totalSeats" required value="{{ old('totalSeats') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. 150">
                        </div>
                    </div>

                    <div class="mb-8">
                        <label for="floor" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Floor / Level (Optional)</label>
                        <input id="floor" type="text" name="floor" value="{{ old('floor') }}" 
                            class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-purple-500/50 focus:ring-1 focus:ring-purple-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. 3rd Floor">
                    </div>

                    <div class="p-6 border border-gray-800 rounded-2xl bg-[#0a0a0a]">
                        <label for="photo" class="block text-[10px] font-black text-purple-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Hall Photo Upload (Optional)
                        </label>
                        <input type="file" name="photo" id="photo"
                            class="w-full text-sm text-gray-400 file:cursor-pointer file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-purple-500/10 file:text-purple-400 hover:file:bg-purple-500/20 transition-colors" />
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-800/60">
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-500 hover:from-purple-500 hover:to-indigo-400 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(168,85,247,0.3)] transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Save Hall
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>