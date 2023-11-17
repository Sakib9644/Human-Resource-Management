<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // // Insert an example admin user
        // $adminUser = User::create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'email_verified_at' => now(),
        //     'type' => 'Admin',
        //     'password' => Hash::make('password123'), // You should hash your passwords
        // ]);

        // // Insert an example moderator user
        // $moderatorUser = User::create([
        //     'name' => 'Moderator User',
        //     'email' => 'moderator@example.com',
        //     'email_verified_at' => now(),
        //     'type' => 'Moderator',
        //     'password' => Hash::make('password123'),
        // ]);

        // // Insert an example employee user
        // $employeeUser = User::create([
        //     'name' => 'Employee User',
        //     'email' => 'employee@example.com',
        //     'email_verified_at' => now(),
        //     'type' => 'Employee',
        //     'password' => Hash::make('password123'),
        // ]);

        // Create profiles for the users
        // Profile::create([
        //     'user_id' => $adminUser->id,
        //     'name' => $adminUser->name,
        //     'email' => $adminUser->email,
        //     // Add other fields as needed
        // ]);

        // Profile::create([
        //     'user_id' => $moderatorUser->id,
        //     'name' => $moderatorUser->name,
        //     'email' => $moderatorUser->email,
        //     // Add other fields as needed
        // ]);

        // Profile::create([
        //     'user_id' => $employeeUser->id,
        //     'name' => $employeeUser->name,
        //     'email' => $employeeUser->email,
        //     // Add other fields as needed
        // ]);

        // You can add more users and profiles as needed
    }
}
