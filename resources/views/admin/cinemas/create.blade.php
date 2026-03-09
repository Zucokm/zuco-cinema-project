<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 group">
            <div class="relative">
                <div class="absolute inset-0 bg-cyan-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-cyan-500/20 rounded-xl group-hover:border-cyan-500/50 transition-colors duration-300">
                    <svg class="w-6 h-6 text-cyan-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
            </div>
            <div>
                <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    Add New Cinema
                </h2>
                <p class="text-xs font-bold text-cyan-500 uppercase tracking-widest mt-0.5">Setup a new branch</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] right-[-10%] w-[40rem] h-[40rem] bg-cyan-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-800/60 p-6 sm:p-10">
                
                <form method="POST" action="{{ route('admin.cinemas.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Cinema Name <span class="text-red-500">*</span></label>
                            <input id="name" type="text" name="name" required value="{{ old('name') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-cyan-500/50 focus:ring-1 focus:ring-cyan-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. ZUCO Junction Square">
                        </div>
                        <div>
                            <label for="phone" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Phone Number <span class="text-red-500">*</span></label>
                            <input id="phone" type="text" name="phone" required value="{{ old('phone') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-cyan-500/50 focus:ring-1 focus:ring-cyan-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. 09 123 456 789">
                        </div>
                    </div>

                    <div class="bg-[#0a0a0a]/50 p-6 rounded-2xl border border-gray-800 mb-8">
                        <h4 class="text-[10px] font-black text-cyan-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Location Information
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label for="township" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Township <span class="text-red-500">*</span></label>
                                <input id="township" type="text" name="township" required value="{{ old('township') }}" 
                                    class="w-full bg-[#111] border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-cyan-500/50 focus:ring-1 focus:ring-cyan-500/50 font-bold transition-colors shadow-inner" placeholder="e.g. Kamayut">
                            </div>
                            <div>
                                <label for="city" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">City <span class="text-red-500">*</span></label>
                                <input id="city" type="text" name="city" required value="{{ old('city') }}" 
                                    class="w-full bg-[#111] border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-cyan-500/50 focus:ring-1 focus:ring-cyan-500/50 font-bold transition-colors shadow-inner" placeholder="e.g. Yangon">
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Full Address <span class="text-red-500">*</span></label>
                            <input id="address" type="text" name="address" required value="{{ old('address') }}" 
                                class="w-full bg-[#111] border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-cyan-500/50 focus:ring-1 focus:ring-cyan-500/50 font-bold transition-colors shadow-inner" placeholder="e.g. Level 4, Junction Square">
                        </div>
                    </div>

                    <div class="p-6 border border-gray-800 rounded-2xl bg-[#0a0a0a]">
                        <label for="photo" class="block text-[10px] font-black text-cyan-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Cinema Photo Upload
                        </label>
                        <input type="file" name="photo" id="photo"
                            class="w-full text-sm text-gray-400 file:cursor-pointer file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 transition-colors" />
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-800/60">
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-cyan-600 to-blue-500 hover:from-cyan-500 hover:to-blue-400 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(6,182,212,0.3)] transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Save Cinema
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>