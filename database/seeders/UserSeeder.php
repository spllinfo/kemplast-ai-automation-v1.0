<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Prepare a common password for all users
        $commonPassword = Hash::make('password');

        // Create the admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@kemplast.net'],
            [
                'name' => 'Admin User',
                'password' => $commonPassword,
                'mobile' => '+91' . fake()->numerify('##########'),
                'alt_mobile' => '+91' . fake()->numerify('##########'),
                'designation' => 'Administrator',
                'address' => fake()->address(),
                'status' => 'active',
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Create manager users (these will be linked to Staff manager records)
        $managerCount = 5;
        for ($i = 0; $i < $managerCount; $i++) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => $commonPassword,
                'mobile' => '+91' . fake()->numerify('##########'),
                'alt_mobile' => '+91' . fake()->numerify('##########'),
                'designation' => 'Department Manager',
                'address' => fake()->address(),
                'status' => 'active',
                'role' => 'manager',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }

        // Create regular staff users (will be linked to Staff records)
        $staffCount = 20;
        for ($i = 0; $i < $staffCount; $i++) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => $commonPassword,
                'mobile' => '+91' . fake()->numerify('##########'),
                'alt_mobile' => '+91' . fake()->numerify('##########'),
                'designation' => fake()->jobTitle(),
                'address' => fake()->address(),
                'status' => 'active',
                'role' => fake()->randomElement(['staff', 'operator', 'quality_inspector', 'maintenance']),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }

        // Create specific role users
        $roles = ['operator', 'quality_inspector', 'maintenance', 'supervisor'];
        foreach ($roles as $role) {
            for ($i = 0; $i < 3; $i++) {
                User::create([
                    'name' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'password' => $commonPassword,
                    'mobile' => '+91' . fake()->numerify('##########'),
                    'alt_mobile' => '+91' . fake()->numerify('##########'),
                    'designation' => ucfirst($role),
                    'address' => fake()->address(),
                    'status' => 'active',
                    'role' => $role,
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]);
            }
        }

        // Log completion for debugging
        info('UserSeeder: Created users with specific roles');
    }
}
