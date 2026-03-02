<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Movie;
use App\Models\Cinema;
use App\Models\CinemaHall;
use App\Models\SeatType;
use App\Models\Seat;
use App\Models\Showtime;
use App\Models\FoodType;
use App\Models\FoodItem;
use App\Models\Booking;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        ini_set('memory_limit', '-1');

        $this->command->info('Seeding started. Please wait, this might take a few minutes for massive data...');

        // ၁။ User များ
        User::factory()->admin()->create(['email' => 'admin@gmail.com', 'password' => bcrypt('password')]);
        $users = User::factory(500)->create();
        $this->command->info('Users seeded.');

        // ၂။ Movie နဲ့ Basic Data များ
        $movies = Movie::factory(30)->create();
        $seatTypes = SeatType::factory(3)->create();
        FoodType::factory(5)->create();
        FoodItem::factory(20)->create();
        $this->command->info('Movies and Basic data seeded.');

        // ၃။ Cinema, Hall နဲ့ Seat များ
        $cinemas = Cinema::factory(4)->create();
        $seatsToInsert = [];
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J']; 

        foreach ($cinemas as $cinema) {
            $halls = CinemaHall::factory(4)->create(['cinema_id' => $cinema->id]);
            
            foreach ($halls as $hall) {
                foreach ($rows as $row) {
                    for ($number = 1; $number <= 10; $number++) { 
                        $seatsToInsert[] = [
                            'cinema_hall_id' => $hall->id,
                            'seat_type_id' => $seatTypes->random()->id,
                            'row' => $row,
                            'number' => $number,
                            'seat_code' => $row . '-' . $number,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
        }
       
        foreach (array_chunk($seatsToInsert, 500) as $chunk) {
            Seat::insert($chunk);
        }
        $this->command->info('Cinemas, Halls, and Seats seeded.');

        // ၄။ Showtime များ (၄ လစာ)
        $startDate = Carbon::now()->subMonths(2);
        $totalDays = 120; 
        $halls = CinemaHall::all();
        $showtimesToInsert = [];

        for ($day = 0; $day < $totalDays; $day++) {
            $currentDate = $startDate->copy()->addDays($day)->format('Y-m-d');

            foreach ($halls as $hall) {
                for ($show = 1; $show <= 2; $show++) {
                    $movieId = $movies->random()->id;
                    $showtimesToInsert[] = [
                        'movie_id' => $movieId,
                        'cinema_hall_id' => $hall->id,
                        'date' => $currentDate,
                        'start_time' => ($show == 1) ? '10:00:00' : '14:00:00',
                        'end_time' => ($show == 1) ? '12:30:00' : '16:30:00',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        foreach (array_chunk($showtimesToInsert, 1000) as $chunk) {
            Showtime::insert($chunk);
        }
        $this->command->info('Showtimes seeded.');

        // ၅။ Booking များ 
        $showtimes = Showtime::all();
        $statuses = ['pending', 'confirmed', 'confirmed', 'confirmed', 'cancelled']; 
        $bookingsToInsert = [];

        foreach ($showtimes as $showtime) {
            $numberOfBookings = rand(5, 15); 

            for ($b = 0; $b < $numberOfBookings; $b++) {
                $status = $statuses[array_rand($statuses)];
                $ticketCount = rand(1, 4); 
                
                $bookingsToInsert[] = [
                    'user_id' => $users->random()->id,
                    'showtime_id' => $showtime->id,
                    'booking_reference' => 'BK-' . strtoupper(Str::random(8)),
                    'total_amount' => $ticketCount * 5000,
                    'status' => $status,
                    'created_at' => $showtime->date, 
                    'updated_at' => $showtime->date,
                ];
            }
        }

        foreach (array_chunk($bookingsToInsert, 1000) as $chunk) {
            Booking::insert($chunk);
        }
        $this->command->info('Bookings seeded.');

        // ၆။ Ticket များ ဖန်တီးခြင်း (Booking ID များကို အခြေခံ၍)
        $this->command->info('Generating Tickets... This might take a bit longer.');
        
        $allSeats = Seat::all()->groupBy('cinema_hall_id'); // Hall အလိုက် ခုံများကို စုထားမယ်
        $showtimesById = Showtime::all()->keyBy('id'); // ID နဲ့ အမြန်ရှာနိုင်အောင်

        // Booking တွေကို ၂၀၀၀ စီခွဲပြီး Memory မပြည့်အောင် Run မယ်
        Booking::chunk(2000, function ($bookings) use ($showtimesById, $allSeats) {
            $ticketsToInsert = [];

            foreach ($bookings as $booking) {
                $showtime = $showtimesById[$booking->showtime_id];
                $hallSeats = $allSeats[$showtime->cinema_hall_id];

                // Booking ရဲ့ amount ကိုကြည့်ပြီး လက်မှတ်ဘယ်နှစ်စောင်လဲ တွက်မယ်
                $ticketCount = max(1, (int)($booking->total_amount / 5000));
                
                // Hall ထဲက ခုံတွေကို ကျပန်းရွေးမယ်
                $selectedSeats = $hallSeats->random($ticketCount);

                foreach ($selectedSeats as $seat) {
                    $ticketsToInsert[] = [
                        'booking_id' => $booking->id,
                        'seat_id' => $seat->id,
                        'price' => 5000,
                        'created_at' => $booking->created_at,
                        'updated_at' => $booking->updated_at,
                    ];
                }
            }

            // Ticket တွေကို Bulk Insert လုပ်မယ်
            foreach (array_chunk($ticketsToInsert, 1000) as $ticketChunk) {
                Ticket::insert($ticketChunk);
            }
        });

        $this->command->info('Tickets seeded.');
        $this->command->info('All Massive Data Seeding Completed Successfully! 🎉');
    }
}