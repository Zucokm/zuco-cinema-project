<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeatType;

class SeatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Standard',
                'price' => 5000,
                'description' => 'Standard comfortable seating.',
            ],
            [
                'name' => 'Good',
                'price' => 7000,
                'description' => 'Better viewing angle with extra comfort.',
            ],
            [
                'name' => 'Premium',
                'price' => 9000,
                'description' => 'Premium seats with extra legroom and prime view.',
            ],
            [
                'name' => 'VIP',
                'price' => 12000,
                'description' => 'Luxury experience with the best view in the house.',
            ],
            [
                'name' => 'Couple',
                'price' => 20000,
                'description' => 'Double seat designed for couples.',
            ],
        ];

        foreach ($types as $type) {
            SeatType::firstOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}