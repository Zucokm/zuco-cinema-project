<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Data သောင်းနဲ့ချီ သွင်းမှာဖြစ်လို့ Memory Limit ကို Unlimited ထားပါမယ်
        ini_set('memory_limit', '-1');
        
        $this->command->info('Starting Master Seeder for Massive Data...');

        // မှတ်ချက်။ ။ Foreign Key အချိတ်အဆက်များအရ အောက်ပါ အစီအစဉ်အတိုင်း တိတိကျကျ Run ရပါမည်။
        $this->call([
            UserSeeder::class,           // ၁။ Users ဖန်တီးမယ် (Admin + Normal Users)
            MovieSeeder::class,          // ၂။ TMDB API ကနေ ရုပ်ရှင်တွေ ယူမယ်
            
            CinemaSeeder::class,         // ၃။ ရုပ်ရှင်ရုံနဲ့ Hall တွေ ထည့်မယ်
            SeatTypeSeeder::class,       // ၄။ ခုံအမျိုးအစားနဲ့ ဈေးနှုန်းတွေ သတ်မှတ်မယ်
            SeatSeeder::class,           // ၅။ Hall အလိုက် ခုံ Layout တွေ ချမယ်
            
            FoodTypeSeeder::class,       // ၆။ အစားအသောက် အမျိုးအစားတွေ ထည့်မယ်
            FoodItemSeeder::class,       // ၇။ အစားအသောက် Item နဲ့ ဈေးနှုန်းတွေ ထည့်မယ်
            
            ShowtimeSeeder::class,       // ၈။ ရက်ပေါင်း ၁၂၀ စာ ပွဲစဉ်တွေ ဆွဲမယ်
            
            MassiveBookingSeeder::class, // ၉။ အပေါ်က Data တွေ အကုန်သုံးပြီး Booking (Ticket, Food, Payment) အများကြီး လုပ်မယ်
        ]);

        $this->command->info('All Massive Seeding Completed Successfully! 🎉');
    }
}