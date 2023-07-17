<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laravolt\Avatar\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserWithRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = new User;
        $admin->name = 'Super Admin';
        $admin->username = 'superadmin';
        $admin->email = 'super@app.test';
        $admin->email_verified_at = date('Y-m-d H:i:s');
        $admin->password = bcrypt('password');
        $admin->role = 'superadmin';
        $admin->bio = 'Aku Adalah Super Admin';
        // $admin->photo = Avatar::create($admin->name)->getImageObject()->encode('png');
        $admin->save();
    }
}
