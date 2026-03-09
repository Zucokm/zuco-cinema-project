<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 group">
            <div class="relative">
                <div class="absolute inset-0 bg-orange-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-orange-500/20 rounded-xl group-hover:border-orange-500/50 transition-colors duration-300">
                    <svg class="w-6 h-6 text-orange-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            </div>
            <div>
                <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    Manage Cinema Menus
                </h2>
                <p class="text-xs font-bold text-orange-500 uppercase tracking-widest mt-0.5">Assign Food Items to Locations</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[20%] w-[40rem] h-[40rem] bg-orange-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="mb-8 bg-green-500/10 border border-green-500/30 backdrop-blur-md text-green-400 px-6 py-4 rounded-2xl relative shadow-[0_10px_30px_rgba(34,197,94,0.1)] flex items-start gap-4" role="alert">
                <div class="bg-green-500/20 rounded-xl p-2 shrink-0 text-green-400 mt-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <strong class="font-black text-lg tracking-wide block text-white">Update Successful!</strong>
                    <span class="block text-sm font-medium opacity-80 mt-1">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="absolute top-4 right-4 text-green-500/50 hover:text-green-400 transition-colors p-1.5 hover:bg-green-500/20 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            @endif

            <div class="mb-10 text-center sm:text-left bg-[#111]/60 backdrop-blur-md p-6 rounded-[1.5rem] border border-gray-800 shadow-lg">
                <p class="text-gray-400 font-medium">
                    Select a cinema location below to customize its specific food and beverage menu. Items enabled here will be available for POS and online booking at that branch.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @forelse($cinemas as $cinema)
                    <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 hover:border-orange-500/50 rounded-[1.5rem] p-6 shadow-xl hover:shadow-[0_10px_30px_rgba(249,115,22,0.15)] transition-all duration-300 group flex flex-col h-full relative overflow-hidden">
                        
                        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/10 blur-3xl rounded-full group-hover:bg-orange-500/20 transition-colors"></div>

                        <div class="flex items-start gap-4 mb-4 relative z-10">
                            <div class="bg-[#0a0a0a] border border-gray-700 p-3 rounded-2xl text-orange-500 group-hover:text-orange-400 group-hover:scale-110 transition-all">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-black text-xl text-white tracking-wide mb-1">{{ $cinema->name }}</h3>
                                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest flex items-center gap-1">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    {{ $cinema->township }}
                                </p>
                            </div>
                        </div>
                        
                        <p class="text-sm text-gray-400 mb-8 flex-1 relative z-10 font-medium">
                            {{ Str::limit($cinema->address, 60) }}
                        </p>
                        
                        <a href="{{ route('admin.cinema-items.manage', $cinema->id) }}" class="relative z-10 block w-full text-center px-4 py-3 bg-[#0a0a0a] group-hover:bg-gradient-to-r group-hover:from-orange-600 group-hover:to-amber-500 border border-gray-700 group-hover:border-transparent rounded-xl font-black text-xs text-gray-300 group-hover:text-white uppercase tracking-widest transition-all duration-300 transform group-hover:-translate-y-1 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Manage Menu
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-[#111]/80 backdrop-blur-xl border border-gray-800 rounded-[1.5rem]">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <h3 class="text-xl font-black text-white mb-2">No Cinemas Available</h3>
                        <p class="text-gray-500 font-medium">Please add a cinema location first before managing menus.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>