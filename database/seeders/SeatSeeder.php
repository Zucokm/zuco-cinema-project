<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CinemaHall;
use App\Models\Seat;
use App\Models\SeatType;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        // အရင်ဆုံး Seat Type IDs တွေကို ယူထားမယ်
        $types = SeatType::pluck('id', 'name')->toArray();
        $halls = CinemaHall::all();

        foreach ($halls as $hall) {
            $seatsData = [];
            
            // Layout Configuration (ပုံထဲကအတိုင်း Row အလိုက် ခုံအရေအတွက်နဲ့ Type သတ်မှတ်ချက်)
            $layout = [
                ['rows' => ['A', 'B'], 'count' => 12, 'type' => $types['Standard']],
                ['rows' => ['C', 'D'], 'count' => 14, 'type' => $types['Standard']],
                ['rows' => ['E', 'F'], 'count' => 15, 'type' => $types['Good']],
                ['rows' => ['G'], 'count' => 16, 'type' => $types['Good']],
                ['rows' => ['H', 'I'], 'count' => 17, 'type' => $types['Premium']],
                ['rows' => ['J', 'K'], 'count' => 18, 'type' => $types['VIP']],
                ['rows' => ['L', 'M'], 'count' => 9, 'type' => $types['Couple']], // Couple က ခုံကျယ်လို့ ၉ ခုံပဲထားမယ်
            ];

            foreach ($layout as $config) {
                foreach ($config['rows'] as $rowLetter) {
                    for ($number = 1; $number <= $config['count']; $number++) {
                        $seatsData[] = [
                            'cinema_hall_id' => $hall->id,
                            'seat_type_id' => $config['type'],
                            'row' => $rowLetter,
                            'number' => $number,
                            'seat_code' => $rowLetter . $number,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }

            // Database ထဲကို Bulk Insert လုပ်မယ်
            DB::beginTransaction();
            try {
                Seat::insert($seatsData);
                
                // Hall ရဲ့ Total Seats ကို Update ပြန်လုပ်ပေးမယ်
                $hall->update(['totalSeats' => count($seatsData)]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                // Error တက်ရင် ကျော်သွားမယ် (ဥပမာ- data ရှိပြီးသားဖြစ်နေရင်)
                continue;
            }
        }
    }
}