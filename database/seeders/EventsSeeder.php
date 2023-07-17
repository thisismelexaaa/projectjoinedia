<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


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
                    'eventname' => 'EVENT ' . $faker->randomElement(
                        $array = array(
                            'BKM', 'SEMARAK', 'WEBINAR', 'KULINER', 'KONSER', 'FESTIVAL', 'PAMERAN', 'PENTAS', 'KARNAVAL', 'KOMUNITAS', 'UKM'
                        )
                    ),
                    'user_id' => 1,
                    'eventdate' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = 'Asia/Jakarta'),
                    'eventtype' => $faker->randomElement(
                        $array = array(
                            'gratis', 'berbayar'
                        )
                    ),
                    'eventorganizer' => $faker->company,
                    'eventlocation' => $faker->address,
                    'eventstatus' => $faker->randomElement(
                        $array = array(
                            'berjalan', 'aktif', 'selesai'
                        )
                    ),
                    'eventimage' => 'https://source.unsplash.com/random/200x200/?event',
                    'eventkategori' => $faker->randomElement(
                        $array = array(
                            'akademik', 'non-akademik'
                        )
                    ),
                    'eventdescription' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                    'eventprice' => $faker->randomElement(
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
