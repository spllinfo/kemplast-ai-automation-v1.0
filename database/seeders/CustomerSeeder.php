<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        // Create sales persons if they don't exist (using staff role)
        if (User::where('designation', 'Sales Executive')->count() === 0) {
            for ($i = 1; $i <= 5; $i++) {
                User::create([
                    'name' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'password' => Hash::make('password'),
                    'mobile' => fake()->numerify('+91##########'),
                    'role' => 'staff',
                    'designation' => 'Sales Executive',
                    'status' => 'active'
                ]);
            }
        }

        // Create branches if they don't exist
        if (Branch::count() === 0) {
            $cities = ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Hyderabad'];
            foreach ($cities as $city) {
                Branch::create([
                    'name' => $city . ' Branch',
                    'code' => strtoupper(substr($city, 0, 3)) . fake()->unique()->numerify('###'),
                    'address' => fake()->address(),
                    'city' => $city,
                    'state' => fake()->state(),
                    'country' => 'India',
                    'pincode' => fake()->postcode(),
                    'phone' => fake()->numerify('+91##########'),
                    'email' => strtolower($city) . '.branch@' . fake()->domainName(),
                    'status' => 'active'
                ]);
            }
        }

        // Ensure storage directory exists for company logos
        Storage::makeDirectory('public/company-logos');

        // Create a mix of customers
        // 40% Premium Corporate
        Customer::factory()
            ->count(20)
            ->premium()
            ->state(function (array $attributes) {
                return [
                    'customer_group' => 'corporate',
                    'business_type' => fake()->randomElement(['manufacturer', 'wholesaler']),
                    'company_size' => fake()->randomElement(['Corporate', 'Large Enterprise']),
                    'status' => 'active'
                ];
            })
            ->create();

        // 30% Regular Wholesale
        Customer::factory()
            ->count(15)
            ->state(function (array $attributes) {
                return [
                    'customer_group' => 'wholesale',
                    'business_type' => fake()->randomElement(['distributor', 'wholesaler']),
                    'company_size' => fake()->randomElement(['Medium Size', 'Corporate']),
                    'credit_limit' => fake()->randomFloat(2, 100000, 500000),
                    'status' => 'active'
                ];
            })
            ->create();

        // 20% Regular Retail
        Customer::factory()
            ->count(10)
            ->state(function (array $attributes) {
                return [
                    'customer_group' => 'retail',
                    'business_type' => 'retailer',
                    'company_size' => fake()->randomElement(['Startup', 'Micro Business', 'Small Business']),
                    'credit_limit' => fake()->randomFloat(2, 10000, 100000),
                    'status' => fake()->randomElement(['active', 'inactive'])
                ];
            })
            ->create();

        // 10% Government/Special
        Customer::factory()
            ->count(5)
            ->state(function (array $attributes) {
                return [
                    'customer_group' => 'government',
                    'business_type' => fake()->randomElement(['manufacturer', 'distributor']),
                    'company_size' => 'Large Enterprise',
                    'credit_limit' => fake()->randomFloat(2, 1000000, 5000000),
                    'payment_terms' => '60_days',
                    'status' => 'active'
                ];
            })
            ->create();
    }
}
