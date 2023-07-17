<?php

namespace Database\Seeders;
<<<<<<< HEAD
=======

>>>>>>> f89a811 (First Commit : Progress 80%)
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserWithRoleSeeder::class,
<<<<<<< HEAD
            BuatEventSeeder::class,
            // PenjadwalanSeeder::class,
=======
            EventsSeeder::class,
>>>>>>> f89a811 (First Commit : Progress 80%)
        ]);
    }
}
