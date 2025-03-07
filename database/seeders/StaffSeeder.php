<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        // Get the admin user (ID 1) from UserSeeder
        $adminUser = User::where('email', 'admin@kemplast.net')->first();

        // Create admin staff record if it doesn't exist
        Staff::firstOrCreate(
            ['staff_code' => 'ADM001'],
            [
                'user_id' => $adminUser->id,
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => $adminUser->email,
                'phone' => $adminUser->mobile,
                'designation' => 'Administrator',
                'department' => 'Administration',
                'status' => 'active',
                // Required fields
                'joining_date' => Carbon::now()->subYears(2),
                'address' => fake()->address(),
                'city' => fake()->city(),
                'state' => fake()->state(),
                'country' => 'India',
                'pincode' => fake()->numerify('######'),
                'basic_salary' => 100000,
                // Optional but commonly used fields
                'date_of_birth' => Carbon::now()->subYears(30)->subDays(rand(0, 365)),
                'gender' => fake()->randomElement(['male', 'female']),
                'marital_status' => fake()->randomElement(['single', 'married']),
                'employee_type' => 'permanent',
                'work_shift' => 'general',
            ]
        );

        // Get all manager users (created by UserSeeder)
        $managerUsers = User::where('role', 'manager')->get();
        $managerStaffIds = [];

        // Create staff records for managers
        foreach ($managerUsers as $index => $user) {
            $staffCode = 'MGR' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);

            $managerStaff = Staff::firstOrCreate(
                ['staff_code' => $staffCode],
                [
                    'user_id' => $user->id,
                    'first_name' => explode(' ', $user->name)[0] ?? 'Manager',
                    'last_name' => explode(' ', $user->name)[1] ?? 'User' . ($index + 1),
                    'email' => $user->email,
                    'phone' => $user->mobile,
                    'designation' => 'designation',
                    'department' => fake()->randomElement(['Production', 'Quality', 'Maintenance', 'Administration', 'HR']),
                    'status' => 'active',
                    'reporting_to' => Staff::where('staff_code', 'ADM001')->first()->id,
                    // Required fields
                    'joining_date' => Carbon::now()->subMonths(rand(1, 24)),
                    'address' => fake()->address(),
                    'city' => fake()->city(),
                    'state' => fake()->state(),
                    'country' => 'India',
                    'pincode' => fake()->numerify('######'),
                    'basic_salary' => fake()->numberBetween(50000, 100000),
                    // Optional but commonly used fields
                    'date_of_birth' => Carbon::now()->subYears(rand(25, 45))->subDays(rand(0, 365)),
                    'gender' => fake()->randomElement(['male', 'female']),
                    'marital_status' => fake()->randomElement(['single', 'married']),
                    'employee_type' => 'permanent',
                    'work_shift' => fake()->randomElement(['morning', 'general', 'night']),
                ]
            );

            $managerStaffIds[] = $managerStaff->id;
        }

        // Get all staff users (created by UserSeeder)
        $staffUsers = User::where('role', 'staff')->get();

        // Create staff records for regular staff
        foreach ($staffUsers as $index => $user) {
            $staffCode = 'EMP' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);

            Staff::firstOrCreate(
                ['staff_code' => $staffCode],
                [
                    'user_id' => $user->id,
                    'first_name' => explode(' ', $user->name)[0] ?? 'Staff',
                    'last_name' => explode(' ', $user->name)[1] ?? 'User' . ($index + 1),
                    'email' => $user->email,
                    'phone' => $user->mobile,
                    'designation' => $user->designation ?? fake()->randomElement(['Operator', 'Technician', 'Supervisor', 'Quality Inspector', 'Helper']),
                    'department' => fake()->randomElement(['Production', 'Quality', 'Maintenance', 'Warehouse', 'Packaging']),
                    'status' => fake()->randomElement(['active', 'active', 'active', 'on_leave']),
                    'reporting_to' => fake()->randomElement($managerStaffIds),
                    // Required fields
                    'joining_date' => Carbon::now()->subMonths(rand(1, 12)),
                    'address' => fake()->address(),
                    'city' => fake()->city(),
                    'state' => fake()->state(),
                    'country' => 'India',
                    'pincode' => fake()->numerify('######'),
                    'basic_salary' => fake()->numberBetween(15000, 45000),
                    // Optional but commonly used fields
                    'date_of_birth' => Carbon::now()->subYears(rand(20, 40))->subDays(rand(0, 365)),
                    'gender' => fake()->randomElement(['male', 'female']),
                    'marital_status' => fake()->randomElement(['single', 'married']),
                    'employee_type' => fake()->randomElement(['permanent', 'contract', 'trainee']),
                    'work_shift' => fake()->randomElement(['morning', 'general', 'night']),
                ]
            );
        }

        info('StaffSeeder: Created staff records for ' . (1 + $managerUsers->count() + $staffUsers->count()) . ' users');
    }
}
