<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\SeatType;
use App\Models\Cinema;
use App\Models\CinemaHall;
use App\Models\Movie;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'admin@zuco.com'], 
            [
                'name' => 'Zuco Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );


        SeatType::firstOrCreate(['name' => 'Standard'], ['price' => 5000, 'description' => 'Normal comfortable seat']);
        SeatType::firstOrCreate(['name' => 'VIP'], ['price' => 10000, 'description' => 'Premium seat with more legroom']);
        SeatType::firstOrCreate(['name' => 'Couple'], ['price' => 15000, 'description' => 'Sofa style seat for two']);


        $cinema = Cinema::firstOrCreate(
            ['name' => 'ZUCO Junction City'],
            [
                'address' => 'Bogyoke Aung San Road',
                'township' => 'Pabedan',
                'city' => 'Yangon',
                'phone' => '09123456789',
            ]
        );

        CinemaHall::firstOrCreate(
            ['cinema_id' => $cinema->id, 'name' => 'Hall 1'],
            ['totalSeats' => 0, 'floor' => '5th Floor']
        );
        CinemaHall::firstOrCreate(
            ['cinema_id' => $cinema->id, 'name' => 'VIP Hall'],
            ['totalSeats' => 0, 'floor' => '5th Floor']
        );


        Movie::firstOrCreate(
            ['title' => 'Inception'],
            [
                'director' => 'Christopher Nolan',
                'genre' => 'Sci-Fi, Action',
                'language' => 'English',
                'duration' => 148,
                'releaseDate' => '2010-07-16',
                'rating' => 8.8,
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
            ]
        );

        Movie::firstOrCreate(
            ['title' => 'Oppenheimer'],
            [
                'director' => 'Christopher Nolan',
                'genre' => 'Biography, Drama, History',
                'language' => 'English',
                'duration' => 180,
                'releaseDate' => '2023-07-21',
                'rating' => 8.3,
                'description' => 'The story of American scientist J. Robert Oppenheimer and his role in the development of the atomic bomb.',
            ]
        );

        $this->command->info('Database seeded successfully with Admin, Seat Types, Cinema, Halls, and Movies!');
    }
}
