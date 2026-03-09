<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 group">
            <div class="relative">
                <div class="absolute inset-0 bg-indigo-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-indigo-500/20 rounded-xl group-hover:border-indigo-500/50 transition-colors duration-300">
                    <svg class="w-6 h-6 text-indigo-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                </div>
            </div>
            <div>
                <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                    Generate Seats
                </h2>
                <p class="text-xs font-bold text-indigo-500 uppercase tracking-widest mt-0.5">Auto-build Hall Layouts</p>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-[calc(100vh-140px)] py-10 relative overflow-hidden">
        
        <div class="absolute top-[-10%] right-[-10%] w-[40rem] h-[40rem] bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="mb-8 bg-red-500/10 border border-red-500/30 backdrop-blur-md text-red-400 px-6 py-4 rounded-2xl relative shadow-[0_10px_30px_rgba(239,68,68,0.15)] flex items-start gap-4" role="alert">
                <div class="bg-red-500/20 rounded-xl p-2 shrink-0 text-red-400 mt-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <strong class="font-black text-lg tracking-wide block text-white">Action Failed!</strong>
                    <span class="block text-sm font-medium opacity-90 mt-1">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="absolute top-4 right-4 text-red-500/50 hover:text-red-400 transition-colors p-1.5 hover:bg-red-500/20 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            @endif

            <div class="bg-[#111]/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-800/60 p-6 sm:p-10">
                
                <div class="mb-8 bg-indigo-500/10 border border-indigo-500/20 p-5 rounded-2xl flex items-start gap-4 shadow-inner">
                    <div class="bg-indigo-500/20 p-2.5 rounded-xl text-indigo-400 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-black text-indigo-400 uppercase tracking-widest mb-1.5">Seat Generator Tool</h3>
                        <p class="text-xs text-gray-400 font-medium leading-relaxed">
                            Select a hall, starting row, and number of seats. The system will automatically generate a grid of seats (e.g., A1, A2, B1, B2) based on your inputs.
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.seats.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-[#0a0a0a]/50 p-6 rounded-2xl border border-gray-800 mb-8">
                        <div>
                            <label for="cinema_hall_id" class="block text-[10px] font-black text-cyan-400 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                Target Cinema Hall <span class="text-red-500">*</span>
                            </label>
                            <select name="cinema_hall_id" id="cinema_hall_id" required 
                                    class="w-full bg-[#111] border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner appearance-none cursor-pointer">
                                <option value="">-- Choose a Hall --</option>
                                @foreach($halls as $hall)
                                    <option value="{{ $hall->id }}">{{ $hall->cinema->name }} - {{ $hall->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('cinema_hall_id')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="seat_type_id" class="block text-[10px] font-black text-amber-400 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                Default Seat Category <span class="text-red-500">*</span>
                            </label>
                            <select name="seat_type_id" id="seat_type_id" required 
                                    class="w-full bg-[#111] border border-gray-700 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner appearance-none cursor-pointer">
                                <option value="">-- Select Type --</option>
                                @foreach($seatTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }} ({{ number_format($type->price) }} Ks)</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('seat_type_id')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                        <div>
                            <label for="start_row" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Starting Row <span class="text-red-500">*</span></label>
                            <select name="start_row" id="start_row" required 
                                    class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner appearance-none cursor-pointer">
                                <option value="">-- Select Row --</option>
                                @foreach(range('A', 'Z') as $letter)
                                    <option value="{{ $letter }}">Row {{ $letter }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('start_row')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="row_count" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Rows to Generate <span class="text-red-500">*</span></label>
                            <input id="row_count" type="number" min="1" max="26" name="row_count" required placeholder="e.g. 5"
                                   class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                            <x-input-error :messages="$errors->get('row_count')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="seats_per_row" class="block text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2">Seats Per Row <span class="text-red-500">*</span></label>
                            <input id="seats_per_row" type="number" min="1" max="100" name="seats_per_row" required placeholder="e.g. 10"
                                   class="w-full bg-[#0a0a0a] border border-gray-800 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500/50 focus:ring-1 focus:ring-indigo-500/50 font-bold transition-colors shadow-inner placeholder-gray-700">
                            <x-input-error :messages="$errors->get('seats_per_row')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-gray-800/60">
                        <button type="button" onclick="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-white bg-transparent border border-gray-700 hover:border-gray-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-[0_0_20px_rgba(79,70,229,0.3)] transform hover:-translate-y-0.5 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Generate Layout
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hallSelect = document.getElementById('cinema_hall_id');
            const rowSelect = document.getElementById('start_row');
            
            const usedRowsData = @json($usedRowsByHall);

            hallSelect.addEventListener('change', function() {
                const hallId = this.value;
                const usedRows = usedRowsData[hallId] || []; 

                Array.from(rowSelect.options).forEach(option => {
                    if(option.value === '') return;

                    if(usedRows.includes(option.value)) {
                        option.disabled = true;
                        option.text = `Row ${option.value} (Already Used)`; 
                        // Updated to Dark Theme classes
                        option.classList.add('text-gray-600', 'bg-[#0a0a0a]');
                    } else {
                        option.disabled = false; 
                        option.text = `Row ${option.value}`;
                        option.classList.remove('text-gray-600', 'bg-[#0a0a0a]'); 
                    }
                });

                // Auto-reset if the selected row becomes disabled
                if (rowSelect.options[rowSelect.selectedIndex] && rowSelect.options[rowSelect.selectedIndex].disabled) {
                    rowSelect.value = '';
                }
            });
        });
    </script>
</x-app-layout>