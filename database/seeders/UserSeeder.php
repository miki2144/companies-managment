<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    public function run()
    {
        // Check if the user already exists
        if (!User::where('email', 'superadmin@gmail.com')->exists()) {
            User::create([
                'username' => 'superadmin',
                'full_name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('super@12'), // Make sure to use a secure password
                'role' => 'superadmin',
            ]);
        }
    }
}