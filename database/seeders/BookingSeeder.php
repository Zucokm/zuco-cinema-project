<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Showtime;
use App\Models\User;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\FoodItem;
use App\Models\FoodOrder;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        // မြန်မြန်ဆန်ဆန်ဖြစ်အောင် Random Showtime ၅၀ ခုကိုပဲ ရွေးမယ်
        $showtimes = Showtime::inRandomOrder()->limit(50)->get(); 
        $foodItems = FoodItem::where('isActive', true)->get();

        if ($users->isEmpty() || $showtimes->isEmpty() || $foodItems->isEmpty()) {
            $this->command->error('Users, Showtimes, or FoodItems are missing!');
            return;
        }

        $totalBookings = 0;

        foreach ($showtimes as $showtime) {
            // ဒီပွဲစဉ်ရဲ့ Hall ထဲက ခုံတွေကို ယူပြီး နေရာမွှေလိုက်မယ် (Shuffle)
            $availableSeats = Seat::where('cinema_hall_id', $showtime->cinema_hall_id)
                                  ->with('seatType')->get()->shuffle();

            if ($availableSeats->isEmpty()) continue;

            // တစ်ပွဲကို Booking ၃ ခု ကနေ ၇ ခု ကြား Random ဝင်မယ်
            $bookingsCount = rand(3, 7);

            for ($i = 0; $i < $bookingsCount; $i++) {
                // ခုံအလုံအလောက် မရှိတော့ရင် ဒီပွဲအတွက် Booking ထပ်မလုပ်တော့ဘူး
                if ($availableSeats->count() < 4) break; 

                $user = $users->random();
                $numSeats = rand(1, 4); // လက်မှတ် ၁ စောင်ကနေ ၄ စောင်အထိ ဝယ်မယ်
                
                // Available ခုံတွေထဲကနေ လိုချင်တဲ့ အရေအတွက်ကို ယူပြီး List ထဲကနေ ဖယ်ထုတ်မယ် (Double book မဖြစ်အောင်)
                $selectedSeats = $availableSeats->splice(0, $numSeats); 

                $seatTotal = 0;
                foreach ($selectedSeats as $seat) {
                    $seatTotal += $seat->seatType ? $seat->seatType->price : 5000;
                }

                // ၈၀% သော လူတွေက အစားအသောက်ပါ ဝယ်မယ်လို့ သတ်မှတ်မယ်
                $foodTotal = 0;
                $orderItemsData = [];
                $totalFoodQty = 0;

                if (rand(1, 10) <= 8) {
                    $numFoodItems = rand(1, 3); // Food Item ၁ မျိုးကနေ ၃ မျိုးအထိ ရွေးမယ်
                    $selectedFood = $foodItems->random($numFoodItems);

                    foreach ($selectedFood as $food) {
                        $qty = rand(1, 2); // တစ်မျိုးကို ၁ ခု သို့မဟုတ် ၂ ခု
                        $subtotal = $food->price * $qty;
                        $foodTotal += $subtotal;
                        $totalFoodQty += $qty;

                        $orderItemsData[] = [
                            'food_item_id' => $food->id,
                            'price' => $food->price,
                            'quantity' => $qty,
                        ];
                    }
                }

                $grandTotal = $seatTotal + $foodTotal;
                $status = fake()->randomElement(['confirmed', 'confirmed', 'checked-in', 'pending']); 
                
                DB::beginTransaction();
                try {
                    // ၁။ Booking Record ဆောက်မယ်
                    $booking = Booking::create([
                        'user_id' => $user->id,
                        'showtime_id' => $showtime->id,
                        'booking_reference' => 'ZUCO-' . strtoupper(Str::random(8)),
                        'total_amount' => $grandTotal,
                        'status' => $status,
                    ]);

                    // ၂။ Ticket တွေ ဆောက်မယ်
                    foreach ($selectedSeats as $seat) {
                        Ticket::create([
                            'booking_id' => $booking->id,
                            'seat_id' => $seat->id,
                            'price' => $seat->seatType ? $seat->seatType->price : 5000,
                        ]);
                    }

                    // ၃။ အစားအသောက်ပါရင် Food Order ဆောက်မယ်
                    if ($foodTotal > 0) {
                        $foodOrder = FoodOrder::create([
                            'booking_id' => $booking->id,
                            'total_amount' => $foodTotal,
                            'status' => 'confirmed',
                            'total_items' => $totalFoodQty,
                        ]);

                        foreach ($orderItemsData as $itemData) {
                            OrderItem::create([
                                'food_order_id' => $foodOrder->id,
                                'food_item_id' => $itemData['food_item_id'],
                                'price' => $itemData['price'],
                                'quantity' => $itemData['quantity'],
                            ]);
                        }
                    }

                    // ၄။ Payment ဆောက်မယ်
                    Payment::create([
                        'booking_id' => $booking->id,
                        'payment_method' => fake()->randomElement(['kpay', 'wavepay', 'cbpay']),
                        'amount' => $grandTotal,
                        'status' => $status === 'pending' ? 'pending' : 'success',
                        'paid_at' => $status === 'pending' ? null : now(),
                        'transaction_id' => 'TXN-' . strtoupper(Str::random(10)),
                    ]);

                    DB::commit();
                    $totalBookings++;
                } catch (\Exception $e) {
                    DB::rollBack();
                }
            }
        }

        $this->command->info("$totalBookings Realistic Bookings (with Tickets & Food Orders) seeded successfully!");
    }
}