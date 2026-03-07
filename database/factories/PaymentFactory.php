<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'success', 'failed']);
        
        return [
            'booking_id' => \App\Models\Booking::factory(),
            'payment_method' => fake()->randomElement(['kpay', 'wavepay', 'cbpay']),
            // transaction_id ကို အမြဲတမ်း generate လုပ်မယ်
            'transaction_id' => 'TXN-' . strtoupper(Str::random(10)),
            'amount' => fake()->randomFloat(2, 5000, 50000),
            'status' => $status,
            // paid_at နဲ့ screenshot_path ကို null မပေးတော့ဘဲ အမြဲတမ်း တန်ဖိုးတစ်ခု ထည့်ထားမယ်
            'paid_at' => now(), 
            'screenshot_path' => 'payment_screenshots/fake_receipt_' . rand(1, 5) . '.jpg', 
        ];
    }
}