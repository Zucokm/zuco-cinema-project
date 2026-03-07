<?php

namespace Database\Seeders;

use App\Models\Showtime;
use App\Models\Movie;
use App\Models\CinemaHall;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShowtimeSeeder extends Seeder
{
    public function run(): void
    {
        $movies = Movie::all();
        $halls = CinemaHall::all();

        if ($movies->isEmpty() || $halls->isEmpty()) {
            $this->command->error('Please seed Movies and CinemaHalls first!');
            return;
        }

        $startDate = Carbon::now()->subMonths(2);
        $totalDays = 120; 
        $showtimesToInsert = [];

        for ($day = 0; $day < $totalDays; $day++) {
            $currentDate = $startDate->copy()->addDays($day);

            foreach ($halls as $hall) {
                // မနက် ၁၀ နာရီမှာ စတင်မယ်
                $currentTime = $currentDate->copy()->setTime(10, 0, 0);
                
                // ည ၁၁ နာရီမတိုင်ခင်အထိပဲ ပွဲစဉ်တွေထည့်မယ်
                // အကြိမ်ရေကို limit ထားလိုက်ခြင်းက infinite loop ကို ကာကွယ်ပေးပါတယ်
                for ($i = 0; $i < 10; $i++) { 
                    $movie = $movies->random();
                    $startTime = $currentTime->copy();
                    $endTime = $startTime->copy()->addMinutes($movie->duration);

                    // ည ၁၁ နာရီကျော်သွားရင် ဒီနေ့အတွက် ထပ်မထည့်တော့ဘူး
                    if ($endTime->hour >= 23 && $endTime->day == $currentDate->day) {
                        break;
                    }

                    $showtimesToInsert[] = [
                        'movie_id' => $movie->id,
                        'cinema_hall_id' => $hall->id,
                        'date' => $currentDate->format('Y-m-d'),
                        'start_time' => $startTime->format('H:i:s'),
                        'end_time' => $endTime->format('H:i:s'),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    // နောက်ပွဲစဉ်အတွက် ၃၀ မိနစ်နားမယ်
                    $currentTime = $endTime->copy()->addMinutes(30);

                    // ရက်ကျော်သွားရင် ရပ်မယ်
                    if ($currentTime->day != $currentDate->day) {
                        break;
                    }
                }
            }
        }

        $this->command->info('Inserting showtimes...');
        
        // Error တက်တာ သေချာအောင် insert မလုပ်ခင် table ကို အရင်ရှင်းထုတ်ရင် ပိုကောင်းပါတယ်
        // DB::table('showtimes')->truncate(); 

        foreach (array_chunk($showtimesToInsert, 1000) as $chunk) {
            Showtime::insert($chunk);
        }

        $this->command->info('Showtimes seeded successfully!');
    }
}