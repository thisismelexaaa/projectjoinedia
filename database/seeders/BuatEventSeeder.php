<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BuatEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $events = [
            ['name' => 'SEDINA NING UCIC #11', 'level' => 'Fakultas'],
            ['name' => 'SEDINA NING UCIC #9', 'level' => 'Fakultas'],
            ['name' => 'SEDINA NING UCIC #8', 'level' => 'Fakultas'],
            ['name' => 'SEDINA NING UCIC #7', 'level' => 'Fakultas'],
            ['name' => 'SEDINA NING UCIC #6', 'level' => 'Fakultas'],
            ['name' => 'SEDINA NING UCIC #5', 'level' => 'Fakultas'],
            ['name' => 'SEDINA NING UCIC #4', 'level' => 'Fakultas'],
            ['name' => 'SEDINA NING UCIC #3', 'level' => 'Fakultas'],
            ['name' => 'IT FEST 2023', 'level' => 'Fakultas'],
            ['name' => 'SEMINAR LITERASI DIGITAL “Energi Terbarukan Apakah Sebuah Tantangan Atau Peluang Pada Ekonomi Digital”', 'level' => 'Fakultas'],
            ['name' => 'YUDISIUM 2022/2023', 'level' => 'HIMASI'],
            ['name' => 'HIFEST 2022', 'level' => 'HIMASI'],
            ['name' => 'MUBES & SERTIJAB HIMATIF UCIC', 'level' => 'HIMATIF'],
            ['name' => 'YUDISIUM 2022/2023', 'level' => 'HIMATIF'],
            ['name' => 'DOLAN #4', 'level' => 'HIMADKV'],
            ['name' => 'OPEN HOUSE DKV 2024', 'level' => 'HIMADKV'],
            ['name' => 'YUDISIUM', 'level' => 'HIMAMI'],
            ['name' => 'HIMAMI MOVIE', 'level' => 'HIMAMI'],
            ['name' => 'YUDISIUM 2022/2023', 'level' => 'HIMAKA'],
            ['name' => 'SERTIJAB HIMAKA 2023-2024 UCIC', 'level' => 'HIMAKA'],
        ];

        foreach ($events as $event) {
            $datetime = now();
            $end_date = $datetime->copy()->addDays($faker->numberBetween(0, 30));

            DB::table('buat_events')->insert(
                [
                    'nama' => $event['name'],
                    'user_id' => 1,
                    'hari' => $faker->numberBetween(1, 7),
                    'start_date' => null,
                    'end_date' => null,
                    'type' => $faker->randomElement(['gratis', 'berbayar']),
                    'organizer' => $faker->company,
                    'location' => 'Auditorium Universitas Catur Insan Cendekia',
                    'status' => 'aktif',
                    'image' => 'https://source.unsplash.com/random/200x200/?/event',
                    'kategori' => $faker->randomElement(['akademik', 'non-akademik']),
                    'description' => $faker->realText(200, 2),
                    'level' => $event['level'],
                    'price' => $faker->randomElement(
                        ['0', '10000', '20000', '30000', '40000', '50000', '60000', '70000', '80000', '90000', '100000']
                    ),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
