<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Auto Generate Seats for Hall') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded shadow-sm">
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-indigo-600 dark:text-indigo-400">Seat Generator tool</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Select a hall, rows, and seats per row. The system will automatically generate seats like A1, A2... B1, B2...
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.seats.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="cinema_hall_id" :value="__('Select Cinema Hall')" />
                            <select name="cinema_hall_id" id="cinema_hall_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Choose a Hall --</option>
                                @foreach($halls as $hall)
                                <option value="{{ $hall->id }}">{{ $hall->cinema->name }} - {{ $hall->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('cinema_hall_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="seat_type_id" :value="__('Default Seat Type')" />
                            <select name="seat_type_id" id="seat_type_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Select Type --</option>
                                @foreach($seatTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }} ({{ number_format($type->price) }} Ks)</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('seat_type_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <x-input-label for="start_row" :value="__('Starting Row')" />
                            <select name="start_row" id="start_row" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Select Row --</option>
                                @foreach(range('A', 'Z') as $letter)
                                <option value="{{ $letter }}">Row {{ $letter }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('start_row')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="row_count" :value="__('Number of Rows to Add')" />
                            <x-text-input id="row_count" class="block mt-1 w-full" type="number" min="1" max="26" name="row_count" required />
                            <x-input-error :messages="$errors->get('row_count')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="seats_per_row" :value="__('Seats Per Row')" />
                            <x-text-input id="seats_per_row" class="block mt-1 w-full" type="number" min="1" max="100" name="seats_per_row" required />
                            <x-input-error :messages="$errors->get('seats_per_row')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t pt-4">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Generate Seats') }}
                        </x-primary-button>
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
                        option.classList.add('text-gray-400', 'bg-gray-100');
                    } else {
                        option.disabled = false; 
                        option.text = `Row ${option.value}`;
                        option.classList.remove('text-gray-400', 'bg-gray-100'); 
                    }
                });

                
                if (rowSelect.options[rowSelect.selectedIndex] && rowSelect.options[rowSelect.selectedIndex].disabled) {
                    rowSelect.value = '';
                }
            });
        });
    </script>
</x-app-layout>