<x-app-layout>
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #a855f7; border-radius: 10px; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-purple-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-purple-500/20 rounded-xl group-hover:border-purple-500/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-purple-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Cinema Halls
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Manage Screens by Location</p>
                </div>
            </div>
            
            <a href="{{ route('admin.cinema-halls.create') }}" class="relative inline-flex group">
                <div class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl blur-md group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200"></div>
                <div class="relative inline-flex items-center gap-2 bg-[#111] border border-purple-500/50 group-hover:border-transparent text-white font-bold py-2.5 px-6 rounded-xl transition-all duration-300 shadow-[0_0_20px_rgba(168,85,247,0.2)] text-sm">
                    <svg class="w-4 h-4 text-purple-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Add New Hall</span>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] right-[-10%] w-[40rem] h-[40rem] bg-purple-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[30rem] h-[30rem] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

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

            @forelse ($cinemas as $cinema)
                <div class="mb-10 bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-2xl rounded-[1.5rem] overflow-hidden group">
                    
                    <div class="px-6 py-5 bg-[#0a0a0a]/80 border-b border-gray-800/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="bg-purple-500/20 p-3 rounded-xl text-purple-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-white tracking-wide">
                                    {{ $cinema->name }}
                                </h3>
                                <div class="text-xs text-gray-500 font-bold mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    {{ $cinema->township }}, {{ $cinema->city }}
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <span class="text-[10px] bg-purple-500/10 border border-purple-500/20 text-purple-400 font-black px-4 py-2 rounded-xl uppercase tracking-widest inline-flex items-center gap-2 shadow-inner">
                                Total Halls: <span class="bg-purple-500 text-white px-2 py-0.5 rounded text-[11px]">{{ $cinema->halls->count() }}</span>
                            </span>
                        </div>
                    </div>

                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-[#0a0a0a]/30 border-b border-gray-800/50">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest w-24">Photo</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Hall Name</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Floor / Level</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Total Seats</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800/60">
                                @forelse ($cinema->halls as $hall)
                                    <tr class="hover:bg-gray-800/30 transition-colors">
                                        
                                        <td class="px-6 py-4">
                                            <div class="w-20 h-12 rounded-lg overflow-hidden border border-gray-700 bg-[#0a0a0a] shadow-md relative">
                                                @if($hall->photoPath)
                                                    <img src="{{ asset('storage/' . $hall->photoPath) }}" alt="Hall" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center flex-col text-gray-600">
                                                        <svg class="w-4 h-4 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="text-base font-black text-white">{{ $hall->name }}</div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            @if($hall->floor)
                                                <span class="inline-flex px-2.5 py-1 rounded-md bg-gray-800 border border-gray-700 text-gray-300 text-xs font-bold">
                                                    Level: {{ $hall->floor }}
                                                </span>
                                            @else
                                                <span class="text-gray-600 font-bold">-</span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="inline-flex items-center gap-1.5 bg-purple-500/10 border border-purple-500/20 px-3 py-1.5 rounded-lg text-purple-400 font-black text-xs tracking-wider">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                {{ $hall->totalSeats }} Seats
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.cinema-halls.edit', $hall->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a0a0a] border border-gray-700 hover:border-purple-500 text-gray-400 hover:text-purple-400 hover:bg-purple-500/10 transition-all duration-300" title="Edit Hall">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                
                                                <form action="{{ route('admin.cinema-halls.destroy', $hall->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this hall?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a0a0a] border border-gray-700 hover:border-red-500 text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-all duration-300" title="Delete Hall">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center bg-[#0a0a0a]/30">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                                <p class="text-gray-500 font-bold text-sm">No halls added to this cinema yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="py-24 text-center flex flex-col items-center bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-2xl rounded-[1.5rem]">
                    <div class="relative w-24 h-24 mb-6">
                        <div class="absolute inset-0 bg-purple-600 blur-xl opacity-20 rounded-full"></div>
                        <div class="relative w-full h-full bg-[#0a0a0a] rounded-full border border-gray-800 flex items-center justify-center shadow-inner">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">No Cinemas Available</h3>
                    <p class="text-gray-500 font-medium max-w-md mx-auto mb-8">Please set up a cinema location first before adding cinema halls.</p>
                    <a href="{{ route('admin.cinemas.create') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-8 py-3.5 rounded-xl font-bold transition border border-gray-700">
                        Create Cinema First
                    </a>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>