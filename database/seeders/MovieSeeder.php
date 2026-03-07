<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TMDB API Key (ဒီနေရာမှာ မင်းရဲ့ API Key ထည့်ပါ)
        $apiKey = 'c8b1f5c0d59aa57c84a6d4dbf337f5bf';

        // ၁။ အခုလက်ရှိ ရုံတင်နေတဲ့ ရုပ်ရှင်တွေကို ဆွဲယူမယ် (Page 1)
        $response = Http::get("https://api.themoviedb.org/3/movie/now_playing", [
            'api_key' => $apiKey,
            'language' => 'en-US',
            'page' => 1,
        ]);

        if ($response->successful()) {
            $movies = $response->json()['results'];

            foreach ($movies as $movie) {
                // ၂။ တစ်ကားချင်းစီရဲ့ အသေးစိတ် (Duration, Genre, Director, Trailer) အတွက် API ထပ်ခေါ်မယ်
                $detailResponse = Http::get("https://api.themoviedb.org/3/movie/{$movie['id']}", [
                    'api_key' => $apiKey,
                    'append_to_response' => 'videos,credits', 
                ]);

                if ($detailResponse->successful()) {
                    $details = $detailResponse->json();

                    // Director နာမည် ရှာဖွေခြင်း
                    $director = collect($details['credits']['crew'])->firstWhere('job', 'Director')['name'] ?? 'Unknown Director';

                    // YouTube Trailer Link ရှာဖွေခြင်း
                    $trailerKey = collect($details['videos']['results'])->firstWhere('type', 'Trailer')['key'] ?? null;
                    $trailerUrl = $trailerKey ? "https://www.youtube.com/watch?v={$trailerKey}" : null;

                    // Genre (ပထမဆုံး တစ်ခုတည်းကိုပဲ ယူမယ်)
                    $mainGenre = collect($details['genres'])->first()['name'] ?? 'Action';

                    // ၃။ Database ထဲသို့ ထည့်သွင်းခြင်း
                    Movie::updateOrCreate(
                        ['title' => $details['title']], // Title တူရင် update ပဲလုပ်မယ်
                        [
                            'description'  => $details['overview'],
                            'imagePath'    => 'https://image.tmdb.org/t/p/w500' . $details['poster_path'],
                            'bgImagePath'  => 'https://image.tmdb.org/t/p/original' . $details['backdrop_path'],
                            'duration'     => $details['runtime'] ?? 120, // minutes
                            'releaseDate'  => $details['release_date'] ?? now()->format('Y-m-d'),
                            'director'     => $director,
                            'genre'        => $mainGenre,
                            'trailerLink'  => $trailerUrl,
                            'rating'       => $details['vote_average'],
                            'language'     => $details['spoken_languages'][0]['english_name'] ?? 'English',
                            'likeCount'    => $details['vote_count'] ?? 0,
                        ]
                    );
                }
            }
            
            $this->command->info('Movies seeded successfully with real-world data!');
        } else {
            $this->command->error('Failed to fetch data from TMDB.');
        }
    }
}