<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Insert an example admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'type' => 'Admin',
            'password' => Hash::make('password123'), // You should hash your passwords
        ]);

        // Insert an example moderator user
        User::create([
            'name' => 'Moderator User',
            'email' => 'moderator@example.com',
            'email_verified_at' => now(),
            'type' => 'Moderator',
            'password' => Hash::make('password123'),
        ]);

        // Insert an example employee user
        User::create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
            'email_verified_at' => now(),
            'type' => 'Employee',
            'password' => Hash::make('password123'),
        ]);

        // You can add more users as needed
    }
}
