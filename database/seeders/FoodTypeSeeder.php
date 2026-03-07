<?php

namespace Database\Seeders;

use App\Models\FoodType;
use Illuminate\Database\Seeder;

class FoodTypeSeeder extends Seeder
{
    public function run(): void
    {
        $foodTypes = [
            [
                'id' => 1,
                'name' => 'Popcorn',
                'imagePath' => 'food_types/o2EnogK1BGeLltymcoCRNwSpeMP5QowCXDvScfp1.webp',
                'isActive' => true,
            ],
            [
                'id' => 2,
                'name' => 'Beverages',
                'imagePath' => 'food_types/titcLJpy3BMbmr8mbsbMRJNUmVySsitwKOBrvXiD.webp',
                'isActive' => true,
            ],
            [
                'id' => 3,
                'name' => 'Combos',
                'imagePath' => 'food_types/NwnYcKG1lrtM3TaswfFlPxJznJjUAFXGmnGpBlAp.jpg',
                'isActive' => true,
            ],
            [
                'id' => 4,
                'name' => 'Snacks',
                'imagePath' => 'food_types/NMF3yIY05ehocCpWKVydUmuzhn5l01TrU7IAgmtf.jpg',
                'isActive' => true,
            ],
            [
                'id' => 5,
                'name' => 'Hot Food',
                'imagePath' => 'food_types/JqaHtjudvWcw6tToFkxDl2nifO4WGeorU4knQqCF.jpg',
                'isActive' => true,
            ],
            [
                'id' => 6,
                'name' => 'Desserts',
                'imagePath' => 'food_types/kcFbU9SVLtiD2AL3KiJKtnaS19y2mN8PXFhnkjoS.webp',
                'isActive' => true,
            ],
        ];

        foreach ($foodTypes as $type) {
            FoodType::updateOrCreate(
                ['id' => $type['id']],
                $type
            );
        }

        $this->command->info('Food Types seeded with exact images!');
    }
}