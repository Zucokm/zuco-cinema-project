<?php

namespace Database\Seeders;

use App\Models\FoodItem;
use Illuminate\Database\Seeder;

class FoodItemSeeder extends Seeder
{
    public function run(): void
    {
        $foodItems = [
            // Popcorn 
            ['id' => 1, 'food_type_id' => 1, 'name' => 'Caramel Popcorn (L)', 'description' => 'Large sweet caramel popcorn', 'price' => 5000, 'imagePath' => 'food_items/Hqy7Lp7ojgecU829kwxG6c0P2bolPrOK9a1D9KxT.jpg', 'isActive' => true],
            ['id' => 2, 'food_type_id' => 1, 'name' => 'Salted Popcorn (L)', 'description' => 'Large classic salted popcorn', 'price' => 4500, 'imagePath' => 'food_items/ZZ78iyvMPhTdl19JCEZfgoOpMdAEuSRsX6sWnUbT.jpg', 'isActive' => true],
            ['id' => 3, 'food_type_id' => 1, 'name' => 'Cheese Popcorn (L)', 'description' => 'Large cheesy popcorn', 'price' => 5500, 'imagePath' => 'food_items/3ddRQs1GIYzAGxW0jFPVCrEDUlQ48gFxl3FvvqZn.jpg', 'isActive' => true],

            // Beverages 
            ['id' => 4, 'food_type_id' => 2, 'name' => 'Coca Cola (L)', 'description' => 'Large cup of Coca Cola', 'price' => 2500, 'imagePath' => 'food_items/lDVeT4b68KRrU5stQc7SdWqFpCpcjZ5LnET8b6Nv.jpg', 'isActive' => true],
            ['id' => 5, 'food_type_id' => 2, 'name' => 'Sprite (L)', 'description' => 'Large cup of Sprite', 'price' => 2500, 'imagePath' => 'food_items/5vBFm0IURx22vyqxU9p1UOq0MTPTDuM1xL9DluMI.jpg', 'isActive' => true],
            ['id' => 6, 'food_type_id' => 2, 'name' => 'Iced Lemon Tea', 'description' => 'Refreshing iced lemon tea', 'price' => 3000, 'imagePath' => 'food_items/x2yGjkSztYGNLNei7DDBBYhhctYryUevbesVYeSP.jpg', 'isActive' => true],
            ['id' => 7, 'food_type_id' => 2, 'name' => 'Mineral Water', 'description' => 'Bottled mineral water', 'price' => 1000, 'imagePath' => 'food_items/mdVZwk1x8qSWFtxFYCEHA05MInNYwCo2Jj2Bpejm.webp', 'isActive' => true],

            // Combos 
            ['id' => 8, 'food_type_id' => 3, 'name' => 'Couple Combo', 'description' => '1 Large Caramel Popcorn + 2 Large Cokes', 'price' => 9000, 'imagePath' => 'food_items/WWDqxT3CTyoH4urB6biwPWkdV3X9sZIUG2k8HyvE.jpg', 'isActive' => true],
            ['id' => 9, 'food_type_id' => 3, 'name' => 'Solo Combo', 'description' => '1 Regular Popcorn + 1 Regular Coke', 'price' => 6000, 'imagePath' => 'food_items/9n3zyc4K8csfcikfhM6SDJ1724ju3cHj46hoXcAN.webp', 'isActive' => true],

            // Snacks 
            ['id' => 10, 'food_type_id' => 4, 'name' => 'Nachos with Cheese', 'description' => 'Crispy nachos with melted cheese dip', 'price' => 4500, 'imagePath' => 'food_items/mNaJJJLwvxgAejL4IP2euPtd57wzfDWLbEO8yrWT.jpg', 'isActive' => true],
            ['id' => 11, 'food_type_id' => 4, 'name' => 'Potato Chips', 'description' => 'Crunchy potato chips', 'price' => 2000, 'imagePath' => 'food_items/y2YSlFonqsBCO71e15YSjZmWoR3W3Ku6qhtjhMgX.jpg', 'isActive' => true],

            // Hot Food 
            ['id' => 12, 'food_type_id' => 5, 'name' => 'Classic Hotdog', 'description' => 'Beef hotdog with mustard and ketchup', 'price' => 3500, 'imagePath' => 'food_items/XZ76e2zd2HLetUwgAB0Zx7v84BNjoEfDHpRL6aTN.jpg', 'isActive' => true],
            ['id' => 13, 'food_type_id' => 5, 'name' => 'Chicken Nuggets (6 pcs)', 'description' => 'Crispy chicken nuggets', 'price' => 4000, 'imagePath' => 'food_items/vYMxxx638zcQpBtKvg3jgrMtpIZ4U4ep8dRfWCcj.jpg', 'isActive' => true],
            ['id' => 14, 'food_type_id' => 5, 'name' => 'French Fries', 'description' => 'Golden crispy french fries', 'price' => 3000, 'imagePath' => 'food_items/3blFMdFwB4XSgzkQpR9QjNXIeuVPSht8qRkCXEXr.webp', 'isActive' => true],

            // Desserts 
            ['id' => 15, 'food_type_id' => 6, 'name' => 'Chocolate Ice Cream', 'description' => 'Rich chocolate ice cream cup', 'price' => 2500, 'imagePath' => 'food_items/cyPzjfwaR9gvSqWxztarQgC6Sj7ndDeVmQ1oM3lO.jpg', 'isActive' => true],
            ['id' => 16, 'food_type_id' => 6, 'name' => 'Vanilla Ice Cream', 'description' => 'Classic vanilla ice cream cup', 'price' => 2500, 'imagePath' => 'food_items/4ddc5fqFUcMi2k1ZD2m7HlUC6kWyjHZJ1ACaoAnV.jpg', 'isActive' => true],
        ];

        foreach ($foodItems as $item) {
            FoodItem::updateOrCreate(
                ['id' => $item['id']], 
                $item
            );
        }

        $this->command->info('Food Items seeded with exact images and prices!');
    }
}