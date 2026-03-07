<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Showtime;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\Ticket;
use App\Models\FoodItem;
use App\Models\FoodOrder;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Str;

class MassiveBookingSeeder extends Seeder
{
    public function run(): void
    {
        // Data အရမ်းများတဲ့အတွက် Memory Limit ကို Unlimited ပေးထားမယ်
        ini_set('memory_limit', '-1'); 

        $this->command->info('Fetching existing Users & Data...');
        
        // User ထပ်မဆောက်တော့ဘဲ UserSeeder က ဆောက်ထားတဲ့ User တွေကိုပဲ ပြန်ခေါ်သုံးမယ်
        $users = User::where('role', 'user')->get();

        // လိုအပ်တဲ့ Data တွေကို ကြိုယူထားမယ်
        $showtimes = Showtime::all();
        $foodItems = FoodItem::where('isActive', true)->get();
        // Hall တစ်ခုချင်းစီရဲ့ ခုံတွေကို Group ဖွဲ့ထားမယ်
        $allSeats = Seat::with('seatType')->get()->groupBy('cinema_hall_id');

        if ($users->isEmpty() || $showtimes->isEmpty() || $foodItems->isEmpty() || $allSeats->isEmpty()) {
            $this->command->error('Users, Showtimes, FoodItems, or Seats are missing! Please run their seeders first.');
            return;
        }

        $this->command->info('Generating Bookings, Tickets, Food Orders, and Payments...');

        $bookingsToInsert = [];
        $ticketsToInsert = [];
        $foodOrdersToInsert = [];
        $orderItemsToInsert = [];
        $paymentsToInsert = [];

        // ID တွေကို အစဉ်လိုက်ဖြစ်အောင် Manual Tracking လုပ်မယ်
        $bookingIdCounter = Booking::max('id') + 1 ?? 1;
        $foodOrderIdCounter = FoodOrder::max('id') + 1 ?? 1;

        foreach ($showtimes as $showtime) {
            $hallSeats = $allSeats[$showtime->cinema_hall_id] ?? collect();
            if ($hallSeats->isEmpty()) continue;

            // ခုံတွေကို Random ဖြစ်အောင် မွှေလိုက်မယ်
            $availableSeats = $hallSeats->shuffle();
            
            // ပွဲစဉ်တစ်ခုကို Booking ၅ ခုကနေ ၁၅ ခု ကြား ကျပန်းလုပ်မယ်
            $numberOfBookings = rand(5, 15); 

            for ($b = 0; $b < $numberOfBookings; $b++) {
                // ခုံအလုံအလောက် မရှိတော့ရင် ရပ်မယ်
                if ($availableSeats->count() < 4) break; 

                $user = $users->random();
                $numSeats = rand(1, 4); // လက်မှတ် ၁ စောင်ကနေ ၄ စောင်
                // Available ခုံတွေထဲကနေ လိုချင်သလောက် ယူပြီး ဖယ်ထုတ်မယ် (Double Book မဖြစ်အောင်)
                $selectedSeats = $availableSeats->splice(0, $numSeats);

                $seatTotal = 0;
                foreach ($selectedSeats as $seat) {
                    $seatPrice = $seat->seatType ? $seat->seatType->price : 5000;
                    $seatTotal += $seatPrice;
                    
                    $ticketsToInsert[] = [
                        'booking_id' => $bookingIdCounter,
                        'seat_id' => $seat->id,
                        'price' => $seatPrice,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                $foodTotal = 0;
                $totalFoodQty = 0;
                
                // ၈၀% သောသူတွေက အစားအသောက်ပါ ဝယ်မယ်
                if (rand(1, 10) <= 8) {
                    $numFoodItems = rand(1, 3);
                    $selectedFood = $foodItems->random($numFoodItems);

                    foreach ($selectedFood as $food) {
                        $qty = rand(1, 2);
                        $subtotal = $food->price * $qty;
                        $foodTotal += $subtotal;
                        $totalFoodQty += $qty;

                        $orderItemsToInsert[] = [
                            'food_order_id' => $foodOrderIdCounter,
                            'food_item_id' => $food->id,
                            'price' => $food->price,
                            'quantity' => $qty,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    $foodOrdersToInsert[] = [
                        'id' => $foodOrderIdCounter,
                        'booking_id' => $bookingIdCounter,
                        'total_amount' => $foodTotal,
                        'status' => 'confirmed',
                        'total_items' => $totalFoodQty,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $foodOrderIdCounter++;
                }

                $grandTotal = $seatTotal + $foodTotal;
                
                // Booking Status သတ်မှတ်ခြင်း
                $bookingStatus = fake()->randomElement(['confirmed', 'confirmed', 'checked-in', 'pending', 'cancelled']); 
                
                // Payment Status သတ်မှတ်ခြင်း
                $paymentStatus = ($bookingStatus === 'cancelled') ? 'failed' : (($bookingStatus === 'pending') ? 'pending' : 'success');

                $bookingsToInsert[] = [
                    'id' => $bookingIdCounter,
                    'user_id' => $user->id,
                    'showtime_id' => $showtime->id,
                    'booking_reference' => 'ZUCO-' . strtoupper(Str::random(8)),
                    'total_amount' => $grandTotal,
                    'status' => $bookingStatus,
                    'created_at' => $showtime->date, 
                    'updated_at' => $showtime->date,
                ];

                // Payment Data
                $paymentsToInsert[] = [
                    'booking_id' => $bookingIdCounter,
                    'payment_method' => fake()->randomElement(['kpay', 'wavepay']),
                    'transaction_id' => 'TXN-' . strtoupper(Str::random(10)),
                    'amount' => $grandTotal,
                    'status' => $paymentStatus,
                    'paid_at' => $showtime->date, 
                    'screenshot_path' => 'payment_screenshots/fake_receipt_' . rand(1, 5) . '.jpg', 
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $bookingIdCounter++;
            }
        }

        // ၅။ Bulk Insert အပိုင်း
        DB::transaction(function () use ($bookingsToInsert, $ticketsToInsert, $foodOrdersToInsert, $orderItemsToInsert, $paymentsToInsert) {
            $this->command->info('Inserting Bookings...');
            foreach (array_chunk($bookingsToInsert, 1000) as $chunk) Booking::insert($chunk);
            
            $this->command->info('Inserting Tickets...');
            foreach (array_chunk($ticketsToInsert, 1000) as $chunk) Ticket::insert($chunk);
            
            $this->command->info('Inserting Food Orders & Items...');
            foreach (array_chunk($foodOrdersToInsert, 1000) as $chunk) FoodOrder::insert($chunk);
            foreach (array_chunk($orderItemsToInsert, 1000) as $chunk) OrderItem::insert($chunk);
            
            $this->command->info('Inserting Payments...');
            foreach (array_chunk($paymentsToInsert, 1000) as $chunk) Payment::insert($chunk);
        });

        $this->command->info('✅ Massive Seeding Completed Successfully! 🎉');
    }
}