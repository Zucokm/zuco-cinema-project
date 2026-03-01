<x-app-layout>
    <!-- Cinema Header -->
    <div class="relative h-[40vh] w-full overflow-hidden">
        <!-- Background Image -->
        @if($cinema->photoPath)
            <img src="{{ asset('storage/' . $cinema->photoPath) }}" class="w-full h-full object-cover opacity-40">
        @else
            <div class="w-full h-full bg-gray-800 opacity-40"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/60 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 w-full p-8 md:p-12">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-2">{{ $cinema->name }}</h1>
                <p class="text-gray-300 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $cinema->address }}, {{ $cinema->township }}, {{ $cinema->city }}
                </p>
                <p class="text-[#df1873] font-bold mt-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 12.284 3 6V5z"></path></svg>
                    {{ $cinema->phone }}
                </p>
            </div>
        </div>
    </div>

    <!-- Movies List -->
    <div class="bg-[#0a0a0a] min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-white mb-8 border-l-4 border-[#df1873] pl-4">Now Showing</h2>

            @if($movies->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg">No movies currently scheduled for this cinema.</p>
                </div>
            @else
                <div class="space-y-12">
                    @foreach($movies as $movie)
                        <!-- Movie Card -->
                        <div class="bg-[#111] rounded-2xl p-6 border border-gray-800 flex flex-col md:flex-row gap-8 shadow-lg hover:border-gray-700 transition-colors">
                            <!-- Poster -->
                            <div class="w-full md:w-48 shrink-0">
                                @if($movie->imagePath)
                                    <img src="{{ asset('storage/' . $movie->imagePath) }}" class="rounded-lg w-full shadow-lg object-cover aspect-[2/3]">
                                @else
                                    <div class="w-full aspect-[2/3] bg-gray-800 rounded-lg flex items-center justify-center text-gray-600">No Image</div>
                                @endif
                            </div>
                            
                            <!-- Details & Showtimes -->
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-white mb-2">{{ $movie->title }}</h3>
                                <div class="flex flex-wrap gap-4 text-sm text-gray-400 mb-6">
                                    <span class="bg-gray-800 px-2 py-1 rounded">{{ $movie->duration }} mins</span>
                                    <span class="bg-gray-800 px-2 py-1 rounded">{{ $movie->genre }}</span>
                                    <span class="bg-gray-800 px-2 py-1 rounded">{{ $movie->language }}</span>
                                </div>

                                <!-- Showtimes Grouped by Date -->
                                @php
                                    $showtimesByDate = $movie->showtimes->groupBy('date');
                                @endphp

                                <div class="space-y-4">
                                    @foreach($showtimesByDate as $date => $showtimes)
                                        <div class="flex flex-col sm:flex-row sm:items-start gap-4 border-b border-gray-800 pb-4 last:border-0 last:pb-0">
                                            <div class="w-32 shrink-0 pt-1">
                                                <span class="text-[#df1873] font-bold block">{{ \Carbon\Carbon::parse($date)->format('D, d M') }}</span>
                                            </div>
                                            <div class="flex flex-wrap gap-3">
                                                @foreach($showtimes as $showtime)
                                                    <a href="{{ route('book.seats', $showtime->id) }}" 
                                                       class="group flex flex-col items-center justify-center px-4 py-2 bg-gray-800 hover:bg-[#df1873] text-white rounded-lg transition-all border border-gray-700 hover:border-[#df1873] min-w-[100px]">
                                                        <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($showtime->start_time)->format('h:i A') }}</span>
                                                        <span class="text-[10px] font-normal text-gray-400 group-hover:text-white/80">{{ $showtime->cinemaHall->name }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>