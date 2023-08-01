<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 3; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('events')->insert(
                [
                    'nama' => 'EVENT ' . $faker->randomElement(
                        $array = array(
                            'BKM', 'SEMARAK', 'WEBINAR', 'KULINER', 'KONSER', 'FESTIVAL', 'PAMERAN', 'PENTAS', 'KARNAVAL', 'KOMUNITAS', 'UKM'
                        )
                    ),
                    'user_id' => 1,
                    'start_date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
                    'end_date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
                    'type' => $faker->randomElement(
                        $array = array(
                            'gratis', 'berbayar'
                        )
                    ),
                    'organizer' => $faker->company,
                    'location' => $faker->address,
                    'status' => $faker->randomElement(
                        $array = array(
                            'berjalan', 'aktif', 'selesai'
                        )
                    ),
                    'image' => 'https://source.unsplash.com/random/200x200/?/event',
                    'kategori' => $faker->randomElement(
                        $array = array(
                            'akademik', 'non-akademik'
                        )
                    ),
                    'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                    'price' => $faker->randomElement(
                        $array = array(
                            '0', '10000', '20000', '30000', '40000', '50000', '60000', '70000', '80000', '90000', '100000'
                        )
                    ),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
