<?php

namespace Database\Seeders;
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
            EventsSeeder::class,
            PenjadwalanSeeder::class,
=======
            BuatEventSeeder::class,
            // PenjadwalanSeeder::class,
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
        ]);
    }
}
