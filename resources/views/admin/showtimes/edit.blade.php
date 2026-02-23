<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Showtime') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('admin.showtimes.update', $showtime->id) }}" 
                      x-data="showtimeCalculator('{{ old('movie_id', $showtime->movie_id) }}', '{{ old('start_time', \Carbon\Carbon::parse($showtime->start_time)->format('H:i')) }}')" 
                      x-init="movies = @js($movies)">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="movie_id" :value="__('Select Movie')" />
                            <select name="movie_id" id="movie_id" x-model="selectedMovieId" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Choose a Movie --</option>
                                <template x-for="movie in movies" :key="movie.id">
                                    <option :value="movie.id" x-text="`${movie.title} (${movie.duration} mins)`" :selected="movie.id == selectedMovieId"></option>
                                </template>
                            </select>
                            <x-input-error :messages="$errors->get('movie_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="cinema_hall_id" :value="__('Select Cinema Hall')" />
                            <select name="cinema_hall_id" id="cinema_hall_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Choose a Hall --</option>
                                @foreach($halls as $hall)
                                    <option value="{{ $hall->id }}" {{ (old('cinema_hall_id', $showtime->cinema_hall_id) == $hall->id) ? 'selected' : '' }}>
                                        {{ $hall->cinema->name }} - {{ $hall->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('cinema_hall_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <x-input-label for="date" :value="__('Show Date')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ old('date', $showtime->date) }}" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="start_time" :value="__('Start Time')" />
                            <x-text-input id="start_time" x-model="startTime" class="block mt-1 w-full" type="time" name="start_time" required />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="end_time" :value="__('End Time (Auto)')" />
                            <x-text-input id="end_time" x-bind:value="calculatedEndTime" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700 text-gray-500 cursor-not-allowed" type="time" disabled />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t pt-4">
                        <x-secondary-button onclick="window.history.back()" class="me-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Update Showtime') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function showtimeCalculator(initialMovieId = '', initialStartTime = '') {
            return {
                movies: [],
                selectedMovieId: initialMovieId,
                startTime: initialStartTime,
                
                get calculatedEndTime() {
                    if (!this.selectedMovieId || !this.startTime) return '';
                    
                    let movie = this.movies.find(m => m.id == this.selectedMovieId);
                    if (!movie) return '';
                    
                    let timeParts = this.startTime.split(':');
                    let hours = parseInt(timeParts[0]);
                    let minutes = parseInt(timeParts[1]);
                    
                    let date = new Date();
                    date.setHours(hours);
                    date.setMinutes(minutes + movie.duration); 
                    
                    let endHours = String(date.getHours()).padStart(2, '0');
                    let endMinutes = String(date.getMinutes()).padStart(2, '0');
                    
                    return `${endHours}:${endMinutes}`;
                }
            }
        }
    </script>
</x-app-layout>