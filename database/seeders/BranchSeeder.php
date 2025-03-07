<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        // Create branch manager users first
        $branchManagers = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'mobile' => fake()->phoneNumber(),
                'role' => 'manager',
                'status' => 'active'
            ]);
            $branchManagers[] = $user->id;
        }

        // Create headquarters branch first
        $firstManager = array_shift($branchManagers);
        $headquarters = Branch::create([
            'name' => 'Kemplast Headquarters',
            'code' => 'BR001',
            'type' => 'headquarters',
            'status' => 'active',
            'address' => fake()->address(),
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'country' => 'India',
            'pincode' => '400001',
            'phone' => '+91' . fake()->numerify('##########'),
            'email' => 'hq@kemplast.com',
            'website' => 'https://kemplast.com',
            'gst_number' => '27AAAAA0000A1Z5',
            'pan_number' => 'AAAAA0000A',
            'tin_number' => 'MH01234567890',
            'cst_number' => 'MH01234567890',
            'contact_person' => fake()->name(),
            'contact_phone' => '+91' . fake()->numerify('##########'),
            'contact_email' => 'contact@kemplast.com',
            'operating_hours' => json_encode([
                'monday' => ['start' => '09:00', 'end' => '18:00'],
                'tuesday' => ['start' => '09:00', 'end' => '18:00'],
                'wednesday' => ['start' => '09:00', 'end' => '18:00'],
                'thursday' => ['start' => '09:00', 'end' => '18:00'],
                'friday' => ['start' => '09:00', 'end' => '18:00'],
                'saturday' => ['start' => '09:00', 'end' => '13:00'],
                'sunday' => null
            ]),
            'facilities' => json_encode([
                'warehouse' => true,
                'production' => true,
                'office' => true,
                'parking' => true,
                'cafeteria' => true,
                'security' => true
            ]),
            'settings' => json_encode([
                'timezone' => 'Asia/Kolkata',
                'currency' => 'INR',
                'language' => 'en',
                'date_format' => 'Y-m-d',
                'time_format' => '24h'
            ]),
            'metadata' => json_encode([
                'established_date' => '2020-01-01',
                'last_renovation' => '2023-01-01',
                'floor_area' => 10000,
                'employee_count' => 500
            ]),
            'manager_id' => $firstManager
        ]);

        // Create other branches
        foreach ($branchManagers as $managerId) {
            Branch::create([
                'name' => fake()->company() . ' Branch',
                'code' => 'BR' . str_pad(fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
                'type' => fake()->randomElement(['manufacturing', 'warehouse', 'distribution', 'retail']),
                'status' => 'active',
                'address' => fake()->address(),
                'city' => fake()->city(),
                'state' => fake()->state(),
                'country' => 'India',
                'pincode' => fake()->numerify('######'),
                'phone' => '+91' . fake()->numerify('##########'),
                'email' => fake()->companyEmail(),
                'website' => fake()->url(),
                'gst_number' => '27' . strtoupper(fake()->lexify('?????')) . '0000A1Z5',
                'pan_number' => strtoupper(fake()->lexify('?????')) . '0000A',
                'tin_number' => fake()->state() . fake()->numerify('##########'),
                'cst_number' => fake()->state() . fake()->numerify('##########'),
                'contact_person' => fake()->name(),
                'contact_phone' => '+91' . fake()->numerify('##########'),
                'contact_email' => fake()->email(),
                'operating_hours' => json_encode([
                    'monday' => ['start' => '09:00', 'end' => '18:00'],
                    'tuesday' => ['start' => '09:00', 'end' => '18:00'],
                    'wednesday' => ['start' => '09:00', 'end' => '18:00'],
                    'thursday' => ['start' => '09:00', 'end' => '18:00'],
                    'friday' => ['start' => '09:00', 'end' => '18:00'],
                    'saturday' => ['start' => '09:00', 'end' => '13:00'],
                    'sunday' => null
                ]),
                'facilities' => json_encode([
                    'warehouse' => true,
                    'production' => true,
                    'office' => true,
                    'parking' => true
                ]),
                'settings' => json_encode([
                    'timezone' => 'Asia/Kolkata',
                    'currency' => 'INR',
                    'language' => 'en'
                ]),
                'metadata' => json_encode([
                    'established_date' => fake()->date(),
                    'floor_area' => fake()->numberBetween(1000, 5000),
                    'employee_count' => fake()->numberBetween(10, 100)
                ]),
                'max_capacity' => fake()->numberBetween(50, 500),
                'current_employees' => fake()->numberBetween(10, 100),
                'manager_id' => $managerId,
                'parent_branch_id' => $headquarters->id
            ]);
        }
    }
}
