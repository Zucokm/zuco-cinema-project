<x-app-layout>
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f59e0b; border-radius: 10px; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-amber-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-amber-500/20 rounded-xl group-hover:border-amber-500/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-amber-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Seat Categories
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Manage Ticket Pricing</p>
                </div>
            </div>
            
            <a href="{{ route('admin.seat-types.create') }}" class="relative inline-flex group">
                <div class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-amber-500 to-orange-600 rounded-xl blur-md group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200"></div>
                <div class="relative inline-flex items-center gap-2 bg-[#111] border border-amber-500/50 group-hover:border-transparent text-white font-bold py-2.5 px-6 rounded-xl transition-all duration-300 shadow-[0_0_20px_rgba(245,158,11,0.2)] text-sm">
                    <svg class="w-4 h-4 text-amber-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Add New Category</span>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[40rem] h-[40rem] bg-amber-600/10 rounded-full blur-[120px] pointer-events-none"></div>

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
                
                @if($seatTypes->isEmpty())
                    <div class="py-24 text-center flex flex-col items-center">
                        <div class="relative w-24 h-24 mb-6">
                            <div class="absolute inset-0 bg-amber-600 blur-xl opacity-20 rounded-full"></div>
                            <div class="relative w-full h-full bg-[#0a0a0a] rounded-full border border-gray-800 flex items-center justify-center shadow-inner">
                                <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">No Seat Types Found</h3>
                        <p class="text-gray-500 font-medium max-w-md mx-auto mb-8">You haven't added any seat categories yet. Set up pricing tiers like VIP or Standard.</p>
                        <a href="{{ route('admin.seat-types.create') }}" class="bg-amber-600 hover:bg-amber-500 text-white px-8 py-3.5 rounded-xl font-bold transition shadow-[0_0_15px_rgba(245,158,11,0.3)]">
                            + Add Seat Type
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-[#0a0a0a]/50 border-b border-gray-800">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Category Name</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Base Price</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest w-1/3">Description</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800/60">
                                @foreach ($seatTypes as $type)
                                <tr class="hover:bg-gray-800/30 transition-colors group">
                                    
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-[#0a0a0a] border border-gray-700 flex items-center justify-center text-amber-500 shadow-inner group-hover:border-amber-500/50 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                            </div>
                                            <span class="text-base font-black text-white group-hover:text-amber-400 transition-colors">{{ $type->name }}</span>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5">
                                        <div class="inline-flex items-center gap-2 bg-amber-500/10 border border-amber-500/20 px-3 py-1.5 rounded-lg text-amber-400 font-black text-sm tracking-wider">
                                            {{ number_format($type->price) }} <span class="text-[10px] text-amber-500/70 uppercase">Ks</span>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5 text-sm text-gray-400 font-medium whitespace-normal">
                                        {{ $type->description ?? 'No specific details provided.' }}
                                    </td>
                                    
                                    <td class="px-6 py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.seat-types.edit', $type->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a0a0a] border border-gray-700 hover:border-amber-500 text-gray-400 hover:text-amber-400 hover:bg-amber-500/10 transition-all duration-300" title="Edit Type">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            
                                            <form action="{{ route('admin.seat-types.destroy', $type->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this seat type?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[#0a0a0a] border border-gray-700 hover:border-red-500 text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-all duration-300" title="Delete Type">
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