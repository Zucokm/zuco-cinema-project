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
                    Edit Category
                </h2>
                <p class="text-xs font-bold text-yellow-500 uppercase tracking-widest mt-0.5">{{ $foodType->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[40rem] h-[40rem] bg-yellow-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-800/60 p-6 sm:p-10">
                
                <form method="POST" action="{{ route('admin.food-types.update', $foodType->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-6">
                        <label for="name" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Category Name <span class="text-red-500">*</span></label>
                        <input id="name" type="text" name="name" required value="{{ old('name', $foodType->name) }}" 
                            class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-yellow-500/50 focus:ring-1 focus:ring-yellow-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-xs" />
                    </div>

                    <div class="mb-6 p-5 border border-gray-800 rounded-2xl bg-[#0a0a0a]/50 flex flex-col sm:flex-row items-center gap-6">
                        @if($foodType->imagePath)
                            <div class="shrink-0 text-center">
                                <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Current Image</label>
                                <div class="w-24 h-24 rounded-xl overflow-hidden border border-gray-700 shadow-lg bg-[#0a0a0a]">
                                    <img src="{{ asset('storage/' . $foodType->imagePath) }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endif

                        <div class="flex-1 w-full">
                            <label for="imagePath" class="block text-[10px] font-black text-yellow-500 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Replace Image (Optional)
                            </label>
                            <input type="file" name="imagePath" id="imagePath" accept="image/*"
                                class="w-full text-sm text-gray-400 file:cursor-pointer file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-yellow-500/10 file:text-yellow-500 hover:file:bg-yellow-500/20 transition-colors" />
                            <x-input-error :messages="$errors->get('imagePath')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="isActive" class="inline-flex items-center cursor-pointer group">
                            <div class="relative">
                                <input id="isActive" type="checkbox" class="sr-only peer" name="isActive" value="1" {{ old('isActive', $foodType->isActive) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-400 peer-checked:after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500 border border-gray-700 peer-checked:border-yellow-400 shadow-inner"></div>
                            </div>
                            <span class="ms-3 text-sm font-bold text-gray-300 group-hover:text-white transition-colors">Active (Visible to customers)</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-800/60">
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-yellow-600 to-orange-500 hover:from-yellow-500 hover:to-orange-400 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(202,138,4,0.3)] transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Update Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>