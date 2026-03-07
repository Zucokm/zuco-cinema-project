<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;
use App\Models\CinemaHall;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        // ၁။ Cinemas အတိအကျ ထည့်သွင်းခြင်း
        $cinemasData = [
            [
                'id' => 1,
                'name' => 'Myanmar Plaza',
                'address' => '192 Kabar Aye Pagoda Road',
                'township' => 'Bahan',
                'city' => 'Yangon',
                'phone' => '09767885673',
                'photoPath' => 'cinemas/3Nfq28s9i2ppdArkbsOyDuBEoIBuS1XujeTPNViA.jpg',
            ],
            [
                'id' => 2,
                'name' => 'Times City',
                'address' => 'No. 37, between Hantharwaddy and Kyun Taw Road',
                'township' => 'Kamayut',
                'city' => 'Yangon',
                'phone' => '09787446373',
                'photoPath' => 'cinemas/MlKf7nM55JNBh2uxe0P07tgbCuUkplFXliHSxij6.jpg',
            ],
            [
                'id' => 3,
                'name' => 'Junction City',
                'address' => 'Corner of Bogyoke Aung San Road & Shwedagon Pagoda Road',
                'township' => 'Pabedan',
                'city' => 'Yangon',
                'phone' => '09372883746',
                'photoPath' => 'cinemas/507frnE2Sj6FKZho365C4GUw58coET53p7V4mqsv.jpg',
            ],
            [
                'id' => 4,
                'name' => 'Junction Square',
                'address' => 'Situated between Pyay Road and Kyun Taw Road, near the Han Thar Waddy Circle',
                'township' => 'Kamaryut',
                'city' => 'Yangon',
                'phone' => '0936477384',
                'photoPath' => 'cinemas/hSR7pU4kusD4n9mchHG9uziwNYdDKkkCI9Vg3gCn.jpg',
            ]
        ];

        foreach ($cinemasData as $data) {
            Cinema::updateOrCreate(
                ['id' => $data['id']], // ID တူရင် Update ပဲလုပ်မယ် (Duplicate မဖြစ်အောင်)
                $data
            );
        }

        // ၂။ Cinema Halls အတိအကျ ထည့်သွင်းခြင်း
        $hallsData = [
            // Myanmar Plaza (Cinema ID: 1)
            ['cinema_id' => 1, 'name' => 'Zuco Hall 1', 'totalSeats' => 186, 'floor' => '3rd Floor', 'photoPath' => 'cinema_halls/5eQ8opXWlraQabxGmksMe3G7keeD0dQkOrW3Tney.jpg'],
            ['cinema_id' => 1, 'name' => 'Zuco Hall 2', 'totalSeats' => 186, 'floor' => '3rd Floor', 'photoPath' => 'cinema_halls/6vllqYpdbyn8Qu4FCZOZE5ZwjVhQtVYY2LD77mmI.jpg'],
            ['cinema_id' => 1, 'name' => 'Zuco Hall 3', 'totalSeats' => 186, 'floor' => '4th Floor', 'photoPath' => 'cinema_halls/cVhUZNdcCAWrwaJtPzxQVTVzyqSYpL0Ntd2teb8z.jpg'],
            ['cinema_id' => 1, 'name' => 'Zuco Hall 4', 'totalSeats' => 186, 'floor' => '4th Floor', 'photoPath' => 'cinema_halls/q0zT5b9nVwyol00Ek9u7DDbIhMi1weeQzOFjlMkB.jpg'],

            // Times City (Cinema ID: 2)
            ['cinema_id' => 2, 'name' => 'Zuco Hall 1', 'totalSeats' => 186, 'floor' => '8th Floor', 'photoPath' => 'cinema_halls/MrmM4vbDS5Dy7jTtJgD5TUcYffcNLROHWFzhsHUj.jpg'],
            ['cinema_id' => 2, 'name' => 'Zuco Hall 2', 'totalSeats' => 186, 'floor' => '8th Floor', 'photoPath' => 'cinema_halls/Mn0D6CduhbTjaNWcnDRcusGakBQAFZg8SHOJlIEz.jpg'],
            ['cinema_id' => 2, 'name' => 'Zuco Hall 3', 'totalSeats' => 186, 'floor' => '9th Floor', 'photoPath' => 'cinema_halls/sZQnL8cwFAL0ysgIG0qbeUfTPk1U62nK6kWiYUQn.jpg'],
            ['cinema_id' => 2, 'name' => 'Zuco Hall 4', 'totalSeats' => 186, 'floor' => '9th Floor', 'photoPath' => 'cinema_halls/caF54nNXlUxwcxVLNhcF91aPMmXtKPZ3JOkFfGED.jpg'],

            // Junction City (Cinema ID: 3)
            ['cinema_id' => 3, 'name' => 'Zuco Hall 1', 'totalSeats' => 186, 'floor' => '6th Floor', 'photoPath' => 'cinema_halls/Hk23gjn5a50oIGKPkfnWqYQGbBMhYvcP1G2devde.jpg'],
            ['cinema_id' => 3, 'name' => 'Zuco Hall 2', 'totalSeats' => 186, 'floor' => '6th Floor', 'photoPath' => 'cinema_halls/Bob2199k57eH5wOaqfeFm0x2rFdS0cdhVB17Smxj.jpg'],
            ['cinema_id' => 3, 'name' => 'Zuco Hall 3', 'totalSeats' => 186, 'floor' => '5th Floor', 'photoPath' => 'cinema_halls/4QEG1WFVfYqv2oVgeSsF2H6tfortaCPdhF5Z6s4I.jpg'],
            ['cinema_id' => 3, 'name' => 'Zuco Hall 4', 'totalSeats' => 186, 'floor' => '5th Floor', 'photoPath' => 'cinema_halls/avoFjKboQnpkJYDRt17OWN5Fo2XcXIkwCSdwHOG9.jpg'],

            // Junction Square (Cinema ID: 4)
            ['cinema_id' => 4, 'name' => 'Zuco Hall 1', 'totalSeats' => 186, 'floor' => '2nd Floor', 'photoPath' => 'cinema_halls/qTeZ43sheOpbao3CaJVqOhKVezbjlD06CfAMlNII.jpg'],
            ['cinema_id' => 4, 'name' => 'Zuco Hall 2', 'totalSeats' => 186, 'floor' => '3rd Floor', 'photoPath' => 'cinema_halls/kPkwXw2lwrNf26TNsc6OR7uFw1EIxak8PMxHh2Ib.jpg'],
            ['cinema_id' => 4, 'name' => 'Zuco Hall 3', 'totalSeats' => 186, 'floor' => '3rd Floor', 'photoPath' => 'cinema_halls/g8WOhv4TJMsyqbIs782Ulkf179f5NS7OovMcOWzg.jpg'],
            ['cinema_id' => 4, 'name' => 'Zuco Hall 4', 'totalSeats' => 186, 'floor' => '3rd Floor', 'photoPath' => 'cinema_halls/IDgdZp1nooZN9JXa3rBjLnWfiyDW0BcPo8P6Q4CU.jpg'],
        ];

        foreach ($hallsData as $hall) {
            CinemaHall::updateOrCreate(
                [
                    'cinema_id' => $hall['cinema_id'],
                    'name' => $hall['name']
                ], 
                $hall
            );
        }

        $this->command->info('Fixed Cinemas and Cinema Halls seeded successfully!');
    }
}