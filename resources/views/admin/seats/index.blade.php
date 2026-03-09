<x-app-layout>
    <style>
        /* Hide Scrollbar but keep functionality */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* 3D Cinematic Screen Effects */
        .perspective-3d {
            transform: perspective(1000px) rotateX(-15deg) scale(0.9);
            box-shadow: 0 25px 50px -12px rgba(255, 255, 255, 0.15);
        }
        .screen-glow {
            background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 100%);
        }
        
        /* Seat Effects */
        .seat-shadow {
            box-shadow: 0 1px 2px rgba(0,0,0,0.5), inset 0 1px 1px rgba(255,255,255,0.1);
        }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-indigo-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-indigo-500/20 rounded-xl group-hover:border-indigo-500/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-indigo-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Cinema Seating Layouts
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Manage Screen Topologies</p>
                </div>
            </div>
            
            <a href="{{ route('admin.seats.create') }}" class="relative inline-flex group">
                <div class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-indigo-500 to-blue-600 rounded-xl blur-md group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200"></div>
                <div class="relative inline-flex items-center gap-2 bg-[#111] border border-indigo-500/50 group-hover:border-transparent text-white font-bold py-2.5 px-6 rounded-xl transition-all duration-300 shadow-[0_0_20px_rgba(99,102,241,0.2)] text-sm">
                    <svg class="w-4 h-4 text-indigo-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Generate Seats</span>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[40rem] h-[40rem] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

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

            @forelse ($halls as $hall)
            <div x-data="{ expanded: false }" class="mb-8 bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[1.5rem] border border-gray-800/60 group">

                <div @click="expanded = !expanded" class="cursor-pointer px-6 py-5 bg-[#0a0a0a]/80 flex justify-between items-center hover:bg-[#111] transition-colors border-b border-gray-800/50">
                    <div class="flex items-center gap-5">
                        <div class="bg-indigo-500/20 p-2 rounded-xl text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                            <svg :class="{'rotate-180': expanded}" class="w-5 h-5 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-black text-white tracking-wide select-none">
                                {{ $hall->cinema->name }} <span class="text-indigo-400 mx-1">&bull;</span> {{ $hall->name }}
                            </h3>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-1">
                                Total Seats: <span class="text-gray-300">{{ $hall->seats->count() }}</span>
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('admin.seats.clear', $hall->id) }}" method="POST" @click.stop onsubmit="return confirm('Are you sure you want to delete ALL SEATS in this hall? This action cannot be undone.');" class="shrink-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500/10 border border-red-500/20 hover:bg-red-600 hover:border-red-500 text-red-500 hover:text-white px-4 py-2 text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-sm">
                            Clear Layout
                        </button>
                    </form>
                </div>

                <div x-show="expanded" 
                     x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
                     class="p-8 overflow-x-auto bg-[#0a0a0a]/50 border-t border-gray-800/50 no-scrollbar select-none" style="display: none;">

                    <div class="mb-20 relative flex justify-center min-w-[600px]">
                        <div class="w-full max-w-3xl">
                            <div class="h-16 w-full screen-glow rounded-[50%] perspective-3d border-t-4 border-indigo-500/50"></div>
                            <div class="text-center mt-8">
                                <p class="text-gray-500 text-[10px] font-black tracking-[0.6em] uppercase text-shadow-sm">SCREEN</p>
                            </div>
                        </div>
                    </div>

                    <div class="min-w-max mx-auto flex flex-col gap-3 md:gap-4 pb-6">
                        @foreach ($hall->seats->groupBy('row') as $rowLetter => $rowSeats)
                        <div class="flex items-center justify-center gap-6 md:gap-10">
                            <span class="w-6 text-right text-gray-600 font-black text-xs md:text-sm uppercase">{{ $rowLetter }}</span>

                            <div class="flex gap-1.5 md:gap-3">
                                @foreach ($rowSeats as $seat)
                                    @php
                                        $typeName = $seat->seatType->name ?? 'Standard';
                                        
                                        // Color mapping based on User Side UI logic
                                        $colorClasses = match($typeName) {
                                            'VIP' => 'bg-gradient-to-b from-yellow-500 to-yellow-600 border-b-4 border-yellow-800 text-black',
                                            'Couple' => 'bg-gradient-to-b from-pink-500 to-pink-600 border-b-4 border-pink-800 text-white',
                                            'Premium' => 'bg-gradient-to-b from-purple-500 to-purple-600 border-b-4 border-purple-800 text-white',
                                            'Good' => 'bg-gradient-to-b from-green-500 to-green-600 border-b-4 border-green-800 text-white',
                                            default => 'bg-gradient-to-b from-indigo-500 to-indigo-600 border-b-4 border-indigo-800 text-white',
                                        };
                                        
                                        $sizeClasses = ($typeName == 'Couple') ? 'w-16 md:w-20 h-10 md:h-12' : 'w-8 md:w-10 h-8 md:h-10';
                                    @endphp

                                    <div title="Type: {{ $typeName }} | Price: {{ number_format($seat->seatType->price ?? 0) }} Ks"
                                         class="relative flex items-center justify-center rounded-t-lg rounded-b-md transition-all duration-300 transform hover:-translate-y-1 seat-shadow cursor-help {{ $sizeClasses }} {{ $colorClasses }}">
                                        
                                        <span class="text-[10px] md:text-xs font-bold">
                                            {{ $seat->number }}
                                            @if($typeName == 'Couple') ♥ @endif
                                        </span>
                                        
                                        <div class="absolute -bottom-1 -left-1 w-1 h-4 bg-black/30 rounded-full"></div>
                                        <div class="absolute -bottom-1 -right-1 w-1 h-4 bg-black/30 rounded-full"></div>
                                    </div>
                                @endforeach
                            </div>

                            <span class="w-6 text-left text-gray-600 font-black text-xs md:text-sm uppercase">{{ $rowLetter }}</span>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            @empty
                <div class="py-24 text-center flex flex-col items-center bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-2xl rounded-[1.5rem]">
                    <div class="relative w-24 h-24 mb-6">
                        <div class="absolute inset-0 bg-indigo-600 blur-xl opacity-20 rounded-full"></div>
                        <div class="relative w-full h-full bg-[#0a0a0a] rounded-full border border-gray-800 flex items-center justify-center shadow-inner">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-black text-white mb-2">No Seating Layouts Found</h3>
                    <p class="text-gray-500 font-medium max-w-md mx-auto mb-8">You haven't generated any seat maps for your cinema halls yet.</p>
                    <a href="{{ route('admin.seats.create') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3.5 rounded-xl font-bold transition shadow-[0_0_15px_rgba(79,70,229,0.3)]">
                        + Generate First Layout
                    </a>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>