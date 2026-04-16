<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'admin@zuco.com')->exists()) {
            User::factory()->admin()->create([
                'name' => 'Admin',
                'email' => 'admin@zuco.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}