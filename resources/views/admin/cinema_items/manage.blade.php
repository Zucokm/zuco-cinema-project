<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-orange-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-orange-500/20 rounded-xl group-hover:border-orange-500/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-orange-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Branch Menu Setup
                    </h2>
                    <p class="text-xs font-bold text-orange-500 uppercase tracking-widest mt-0.5">Location: <span class="text-white">{{ $cinema->name }}</span></p>
                </div>
            </div>
            
            <a href="{{ route('admin.cinema-items.index') }}" class="bg-[#111] hover:bg-gray-800 border border-gray-700 text-white font-bold py-2 px-5 rounded-xl transition-all shadow-lg text-sm flex items-center gap-2 w-max">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Cinemas
            </a>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-screen py-10 relative overflow-hidden pb-32">
        
        <div class="absolute top-[20%] right-[-10%] w-[40rem] h-[40rem] bg-orange-600/10 rounded-full blur-[120px] pointer-events-none fixed"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <form action="{{ route('admin.cinema-items.store', $cinema->id) }}" method="POST" id="menuForm">
                @csrf

                <div class="space-y-10">
                    @foreach($foodTypes as $type)
                        @if($type->foodItems->count() > 0)
                            <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-2xl rounded-[2rem] overflow-hidden">
                                
                                <div class="px-6 py-5 bg-[#0a0a0a]/80 border-b border-gray-800/80 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        @if($type->imagePath)
                                            <img src="{{ asset('storage/' . $type->imagePath) }}" class="w-10 h-10 rounded-full object-cover border-2 border-gray-700 shadow-inner">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gray-800 border-2 border-gray-700 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        <h3 class="text-xl font-black text-white tracking-wide">{{ $type->name }}</h3>
                                    </div>
                                    <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest bg-gray-900 px-3 py-1 rounded-lg border border-gray-800">
                                        {{ $type->foodItems->count() }} Items
                                    </span>
                                </div>
                                
                                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 bg-[#0a0a0a]/30">
                                    @foreach($type->foodItems as $item)
                                        <label class="group relative flex items-center gap-4 p-4 rounded-2xl border-2 cursor-pointer transition-all duration-300 {{ in_array($item->id, $availableItemIds) ? 'bg-orange-500/10 border-orange-500 shadow-[0_0_15px_rgba(249,115,22,0.15)]' : 'bg-[#0a0a0a] border-gray-800 hover:border-gray-600 hover:bg-[#111]' }}">
                                            
                                            <input type="checkbox" name="food_items[]" value="{{ $item->id }}" 
                                                class="peer sr-only"
                                                {{ in_array($item->id, $availableItemIds) ? 'checked' : '' }}
                                                onchange="this.closest('label').className = this.checked ? 'group relative flex items-center gap-4 p-4 rounded-2xl border-2 cursor-pointer transition-all duration-300 bg-orange-500/10 border-orange-500 shadow-[0_0_15px_rgba(249,115,22,0.15)]' : 'group relative flex items-center gap-4 p-4 rounded-2xl border-2 cursor-pointer transition-all duration-300 bg-[#0a0a0a] border-gray-800 hover:border-gray-600 hover:bg-[#111]'">
                                            
                                            <div class="shrink-0 w-6 h-6 rounded-md border-2 flex items-center justify-center transition-all duration-300 {{ in_array($item->id, $availableItemIds) ? 'bg-orange-500 border-orange-500 text-white' : 'bg-transparent border-gray-600 text-transparent group-hover:border-gray-400' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>

                                            <div class="flex-1">
                                                <p class="font-bold text-base transition-colors {{ in_array($item->id, $availableItemIds) ? 'text-white' : 'text-gray-300 group-hover:text-white' }}">{{ $item->name }}</p>
                                                <p class="text-sm font-black mt-0.5 transition-colors {{ in_array($item->id, $availableItemIds) ? 'text-orange-400' : 'text-gray-500' }}">{{ number_format($item->price) }} Ks</p>
                                            </div>

                                            @if($item->imagePath)
                                                <div class="shrink-0 w-14 h-14 rounded-xl overflow-hidden border border-gray-700/50 shadow-inner bg-[#0a0a0a]">
                                                    <img src="{{ asset('storage/' . $item->imagePath) }}" class="w-full h-full object-cover">
                                                </div>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="fixed bottom-6 left-4 right-4 md:left-auto md:right-auto md:w-full md:max-w-7xl md:mx-auto z-50">
                    <div class="bg-[#111]/90 backdrop-blur-2xl p-4 sm:p-5 rounded-[1.5rem] border border-gray-700 shadow-[0_-10px_40px_rgba(0,0,0,0.6)] flex items-center justify-between sm:justify-end gap-4">
                        <div class="hidden sm:block mr-auto pl-2">
                            <p class="text-xs font-black text-gray-500 uppercase tracking-widest">Unsaved Changes will be lost</p>
                        </div>
                        
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors w-full sm:w-auto">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-orange-600 to-amber-500 hover:from-orange-500 hover:to-amber-400 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(249,115,22,0.4)] transform hover:-translate-y-0.5 flex items-center justify-center gap-2 w-full sm:w-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Save Availability
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>