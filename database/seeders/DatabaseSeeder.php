<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'admin@zuco.com'],
            [
                'name' => 'ZUCO Admin',
                'password' => 'password123', 
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@zuco.com'],
            [
                'name' => 'Test Customer',
                'password' => 'password123',
                'role' => 'user',
            ]
        );
    }
}