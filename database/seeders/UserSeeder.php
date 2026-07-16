<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@trakio.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'reset_token' => null,
            'reset_token_expiry' => null,
            'is_first_login' => false,
        ]);

        User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@trakio.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'reset_token' => null,
            'reset_token_expiry' => null,
            'is_first_login' => true,
        ]);

        User::create([
            'name' => 'Student User',
            'email' => 'student@trakio.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'student',
            'reset_token' => null,
            'reset_token_expiry' => null,
            'is_first_login' => true,
        ]);
    }
}
