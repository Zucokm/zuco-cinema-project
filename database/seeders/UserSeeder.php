<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Creating Admin and 500 Users...');

        User::firstOrCreate(
            ['email' => 'admin@zuco.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@zuco.com'],
            [
                'name' => 'Customer User',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Chunk နဲ့ toArray() မလုပ်တော့ဘဲ create() နဲ့ပဲ တိုက်ရိုက်ဆောက်မယ် (Date Format Error မတက်အောင်)
        User::factory(499)->create();

        $this->command->info('Users seeded successfully.');
    }
}