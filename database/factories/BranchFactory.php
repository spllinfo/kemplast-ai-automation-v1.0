<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Branch',
            'code' => 'BR' . fake()->unique()->numberBetween(1000, 9999),
            'type' => fake()->randomElement(['headquarters', 'warehouse', 'production', 'office', 'retail']),
            'status' => fake()->randomElement(['active', 'inactive', 'maintenance']),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'pincode' => fake()->postcode(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'website' => fake()->optional()->url(),
            'gst_number' => fake()->optional()->regexify('[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}'),
            'pan_number' => fake()->regexify('[A-Z]{5}[0-9]{4}[A-Z]{1}'),
            'tin_number' => fake()->optional()->regexify('[A-Z]{2}[0-9]{10}'),
            'cst_number' => fake()->optional()->regexify('[A-Z]{2}[0-9]{10}'),
            'contact_person' => fake()->name(),
            'contact_phone' => fake()->phoneNumber(),
            'contact_email' => fake()->unique()->safeEmail(),
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
                'warehouse' => fake()->boolean(80),
                'production' => fake()->boolean(60),
                'office' => fake()->boolean(90),
                'parking' => fake()->boolean(90),
                'cafeteria' => fake()->boolean(70),
                'security' => fake()->boolean(90)
            ]),
            'settings' => json_encode([
                'timezone' => fake()->timezone(),
                'currency' => fake()->currencyCode(),
                'language' => fake()->randomElement(['en', 'hi', 'ta', 'te']),
                'date_format' => fake()->randomElement(['Y-m-d', 'd-m-Y', 'm-d-Y']),
                'time_format' => fake()->randomElement(['12h', '24h'])
            ]),
            'metadata' => json_encode([
                'established_date' => fake()->dateTimeBetween('-10 years', 'now'),
                'last_renovation' => fake()->optional()->dateTimeBetween('-5 years', 'now'),
                'floor_area' => fake()->numberBetween(1000, 10000),
                'employee_count' => fake()->numberBetween(10, 500)
            ])
        ];
    }
}
