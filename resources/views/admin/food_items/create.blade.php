<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 group">
            <div class="relative">
                <div class="absolute inset-0 bg-orange-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-orange-500/20 rounded-xl group-hover:border-orange-500/50 transition-colors duration-300">
                    <svg class="w-6 h-6 text-orange-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
            </div>
            <div>
                <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    Add New Item
                </h2>
                <p class="text-xs font-bold text-orange-500 uppercase tracking-widest mt-0.5">Setup Food & Beverage</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] right-[-10%] w-[40rem] h-[40rem] bg-orange-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-800/60 p-6 sm:p-10">
                
                <form method="POST" action="{{ route('admin.food-items.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="food_type_id" class="block text-[10px] font-black text-orange-400 uppercase tracking-widest mb-2 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Select Category <span class="text-red-500">*</span>
                            </label>
                            <select name="food_type_id" id="food_type_id" required 
                                    class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 font-bold transition-colors shadow-inner appearance-none cursor-pointer">
                                <option value="">-- Choose Category --</option>
                                @foreach($foodTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('food_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('food_type_id')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="name" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Item Name <span class="text-red-500">*</span></label>
                            <input id="name" type="text" name="name" required value="{{ old('name') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. Caramel Popcorn (Large)">
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="price" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Price (Ks) <span class="text-red-500">*</span></label>
                            <input id="price" type="number" min="0" name="price" required value="{{ old('price') }}" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 font-bold transition-colors shadow-inner placeholder-gray-700" placeholder="e.g. 4500">
                            <x-input-error :messages="$errors->get('price')" class="mt-2 text-red-400 text-xs" />
                        </div>
                        
                        <div>
                            <label for="description" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Description (Optional)</label>
                            <textarea id="description" name="description" rows="1" 
                                class="w-full bg-[#0a0a0a] border border-gray-800 text-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500/50 focus:ring-1 focus:ring-orange-500/50 font-medium transition-colors shadow-inner placeholder-gray-700 resize-y" placeholder="Brief details...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="mb-6 p-6 border border-gray-800 rounded-2xl bg-[#0a0a0a]/50">
                        <label for="imagePath" class="block text-[10px] font-black text-cyan-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Item Image (Optional)
                        </label>
                        <input type="file" name="imagePath" id="imagePath" accept="image/*"
                            class="w-full text-sm text-gray-400 file:cursor-pointer file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 transition-colors" />
                        <x-input-error :messages="$errors->get('imagePath')" class="mt-2 text-red-400 text-xs" />
                    </div>

                    <div class="mb-6">
                        <label for="isActive" class="inline-flex items-center cursor-pointer group">
                            <div class="relative">
                                <input id="isActive" type="checkbox" class="sr-only peer" name="isActive" value="1" checked>
                                <div class="w-11 h-6 bg-gray-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-400 peer-checked:after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500 border border-gray-700 peer-checked:border-green-400 shadow-inner"></div>
                            </div>
                            <span class="ms-3 text-sm font-bold text-gray-300 group-hover:text-white transition-colors">In Stock (Available for order)</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-800/60">
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-orange-600 to-amber-500 hover:from-orange-500 hover:to-amber-400 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(249,115,22,0.3)] transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Save Item
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>