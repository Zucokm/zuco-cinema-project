<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cinema Seating Layouts') }}
            </h2>
            <a href="{{ route('admin.seats.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                + Generate Seats
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
            @endif
            @forelse ($halls as $hall)
            <div x-data="{ expanded: false }" class="mb-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">

                <div @click="expanded = !expanded" class="cursor-pointer px-6 py-4 bg-gray-50 dark:bg-gray-900 flex justify-between items-center hover:bg-gray-100 dark:hover:bg-gray-800 transition">

                    <div class="flex items-center gap-4">
                        <svg :class="{'rotate-180': expanded}" class="w-5 h-5 text-gray-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 select-none">
                                🎬 {{ $hall->cinema->name }} - <span class="text-indigo-600 dark:text-indigo-400">{{ $hall->name }}</span>
                            </h3>
                            <p class="text-sm text-gray-500">Total Seats: <span class="font-bold">{{ $hall->seats->count() }}</span></p>
                        </div>
                    </div>

                    <form action="{{ route('admin.seats.clear', $hall->id) }}" method="POST" @click.stop onsubmit="return confirm('Are you sure you want to delete ALL SEATS in this hall? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-100 text-red-600 hover:bg-red-600 hover:text-white text-sm font-bold rounded-md transition shadow-sm">
                            Clear Seats
                        </button>
                    </form>
                </div>

                <div x-show="expanded" x-transition class="p-8 overflow-x-auto bg-gray-100 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">

                    <div class="mb-10 text-center">
                        <div class="w-2/3 mx-auto h-8 bg-gray-300 dark:bg-gray-700 rounded-t-3xl border-b-4 border-indigo-400 dark:border-indigo-600 flex items-center justify-center shadow-md">
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400 tracking-[0.3em]">SCREEN</span>
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        @foreach ($hall->seats->groupBy('row') as $rowLetter => $rowSeats)
                        <div class="flex items-center gap-4">
                            <div class="w-6 text-center font-bold text-gray-500 dark:text-gray-400">
                                {{ $rowLetter }}
                            </div>

                            <div class="flex gap-1.5">
                                @foreach ($rowSeats as $seat)
                                <div title="Type: {{ $seat->seatType->name }} | Price: {{ number_format($seat->seatType->price) }} Ks"
                                    class="h-8 flex items-center justify-center text-[10px] font-bold text-white rounded-t-md cursor-help shadow-sm transition-all
                                    @if($seat->seatType->name == 'Couple') 
                                            w-16 bg-pink-500 /* Couple  */
                                        @elseif($seat->seatType->name == 'VIP') 
                                            w-8 bg-yellow-500 /* VIP  */
                                        @else 
                                            w-8 bg-indigo-500 /* Standard  */
                                    @endif">

                                    @if($seat->seatType->name == 'Couple')
                                    {{ $seat->number }} ♥
                                    @else
                                    {{ $seat->number }}
                                    @endif
                                </div>
                                @endforeach
                            </div>

                            <div class="w-6 text-center font-bold text-gray-500 dark:text-gray-400">
                                {{ $rowLetter }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            @empty
            <div class="bg-white dark:bg-gray-800 p-10 text-center rounded-lg shadow-sm text-gray-500 italic">
                No seats have been generated yet. <a href="{{ route('admin.seats.create') }}" class="text-indigo-600 underline font-bold">Generate Seats Now</a>
            </div>
            @endforelse

        </div>
    </div>
</x-app-layout>