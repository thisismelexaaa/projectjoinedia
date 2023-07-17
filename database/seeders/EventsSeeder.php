<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
=======
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> f89a811 (First Commit : Progress 80%)


class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
<<<<<<< HEAD
        // date between 1 - 30 days from now
        $datetime = now();

        for ($i = 1; $i <= 20; $i++) {
            // generate random end_date that is not earlier than start_date
            $end_date = $datetime->copy()->addDays($faker->numberBetween(0, 1)); // Adds 0 to 30 days to start_date

            // insert data ke table pegawai menggunakan Faker
            DB::table('buat_events')->insert(
                [
                    'nama' => 'EVENT ' . $faker->randomElement(
                        array(
=======
        for ($i = 1; $i <= 3; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('events')->insert(
                [
                    'eventname' => 'EVENT ' . $faker->randomElement(
                        $array = array(
>>>>>>> f89a811 (First Commit : Progress 80%)
                            'BKM', 'SEMARAK', 'WEBINAR', 'KULINER', 'KONSER', 'FESTIVAL', 'PAMERAN', 'PENTAS', 'KARNAVAL', 'KOMUNITAS', 'UKM'
                        )
                    ),
                    'user_id' => 1,
<<<<<<< HEAD
                    'hari' => $faker->numberBetween(1, 7),
                    'start_date' => null,
                    'end_date' => null,
                    'type' => $faker->randomElement(
                        array(
                            'gratis', 'berbayar'
                        )
                    ),
                    'organizer' => $faker->company,
                    'location' => $faker->address,
                    'status' => 'aktif',
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
=======
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
>>>>>>> f89a811 (First Commit : Progress 80%)
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
