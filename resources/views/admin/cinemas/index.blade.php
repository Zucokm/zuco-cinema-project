<x-app-layout>
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #06b6d4; border-radius: 10px; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-cyan-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-cyan-500/20 rounded-xl group-hover:border-cyan-500/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-cyan-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        All Cinemas
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Manage Cinema Locations</p>
                </div>
            </div>
            
            <a href="{{ route('admin.cinemas.create') }}" class="relative inline-flex group">
                <div class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-cyan-500 to-blue-600 rounded-xl blur-md group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200"></div>
                <div class="relative inline-flex items-center gap-2 bg-[#111] border border-cyan-500/50 group-hover:border-transparent text-white font-bold py-2.5 px-6 rounded-xl transition-all duration-300 shadow-[0_0_20px_rgba(6,182,212,0.2)] text-sm">
                    <svg class="w-4 h-4 text-cyan-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Add New Cinema</span>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[40rem] h-[40rem] bg-cyan-600/10 rounded-full blur-[120px] pointer-events-none"></div>

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

            <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-2xl rounded-[1.5rem] overflow-hidden">
                
                @if($cinemas->isEmpty())
                    <div class="py-24 text-center flex flex-col items-center">
                        <div class="relative w-24 h-24 mb-6">
                            <div class="absolute inset-0 bg-cyan-600 blur-xl opacity-20 rounded-full"></div>
                            <div class="relative w-full h-full bg-[#0a0a0a] rounded-full border border-gray-800 flex items-center justify-center shadow-inner">
                                <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">No Cinemas Found</h3>
                        <p class="text-gray-500 font-medium max-w-md mx-auto mb-8">You haven't added any cinema locations yet. Setup your first branch now.</p>
                        <a href="{{ route('admin.cinemas.create') }}" class="bg-cyan-600 hover:bg-cyan-500 text-white px-8 py-3.5 rounded-xl font-bold transition shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                            + Setup First Cinema
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-[#0a0a0a]/50 border-b border-gray-800">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest w-24">Location Photo</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Cinema Details</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Address</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Contact Info</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800/60">
                                @foreach ($cinemas as $cinema)
                                <tr class="hover:bg-gray-800/30 transition-colors group">
                                    
                                    <td class="px-6 py-4">
                                        <div class="w-24 h-16 rounded-lg overflow-hidden border border-gray-700 bg-[#0a0a0a] shadow-md group-hover:border-cyan-500/50 transition-colors relative">
                                            @if($cinema->photoPath)
                                                <img src="{{ asset('storage/' . $cinema->photoPath) }}" alt="Cinema" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center flex-col text-gray-600">
                                                    <svg class="w-4 h-4 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    <span class="text-[8px] font-black uppercase tracking-widest">No Pic</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="text-base font-black text-white mb-1 group-hover:text-cyan-400 transition-colors">{{ $cinema->name }}</div>
                                        <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_5px_#22c55e]"></span> Active Branch
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-300 flex items-center gap-1.5 mb-1">
                                            <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $cinema->township }}, {{ $cinema->city }}
                                        </div>
                                        <div class="text-[10px] text-gray-500 uppercase tracking-widest bg-[#0a0a0a] px-2 py-1 rounded-md inline-block border border-gray-800">
                                            {{ Str::limit($cinema->address, 30) }}
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="inline-flex items-center gap-2 bg-cyan-500/10 border border-cyan-500/20 px-3 py-1.5 rounded-lg text-cyan-400 font-bold text-xs tracking-wider">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path></svg>
                                            {{ $cinema->phone }}
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.cinemas.edit', $cinema->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a0a0a] border border-gray-700 hover:border-cyan-500 text-gray-400 hover:text-cyan-400 hover:bg-cyan-500/10 transition-all duration-300" title="Edit Cinema">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            
                                            <form action="{{ route('admin.cinemas.destroy', $cinema->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this cinema?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a0a0a] border border-gray-700 hover:border-red-500 text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-all duration-300" title="Delete Cinema">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>