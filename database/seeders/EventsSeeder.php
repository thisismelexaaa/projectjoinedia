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
        // date between 1 - 30 days from now
        $datetime = now();

<<<<<<< HEAD
        for ($i = 1; $i <= 5; $i++) {
=======
        for ($i = 1; $i <= 20; $i++) {
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
            // generate random end_date that is not earlier than start_date
            $end_date = $datetime->copy()->addDays($faker->numberBetween(0, 1)); // Adds 0 to 30 days to start_date

            // insert data ke table pegawai menggunakan Faker
<<<<<<< HEAD
            DB::table('events')->insert(
=======
            DB::table('buat_events')->insert(
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
                [
                    'nama' => 'EVENT ' . $faker->randomElement(
                        array(
                            'BKM', 'SEMARAK', 'WEBINAR', 'KULINER', 'KONSER', 'FESTIVAL', 'PAMERAN', 'PENTAS', 'KARNAVAL', 'KOMUNITAS', 'UKM'
                        )
                    ),
                    'user_id' => 1,
<<<<<<< HEAD
                    'start_date' => $datetime,
                    'end_date' => $end_date,
=======
                    'hari' => $faker->numberBetween(1, 7),
                    'start_date' => null,
                    'end_date' => null,
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
                    'type' => $faker->randomElement(
                        array(
                            'gratis', 'berbayar'
                        )
                    ),
                    'organizer' => $faker->company,
                    'location' => $faker->address,
<<<<<<< HEAD
                    'status' => $faker->randomElement(
                        array(
                            'berjalan', 'aktif', 'selesai'
                        )
                    ),
=======
                    'status' => 'aktif',
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
                    'image' => 'https://source.unsplash.com/random/200x200/?/event',
                    'kategori' => $faker->randomElement(
                        array(
                            'akademik', 'non-akademik'
                        )
                    ),
                    'description' => $faker->realText(200, 2),
                    'level' => $faker->randomElement(
                        array(
                            'Universitas', 'Fakultas', 'Prodi', 'Bkm', 'Hima', 'Ukm'
                        )
                    ),
                    'price' => $faker->randomElement(
                        array(
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
