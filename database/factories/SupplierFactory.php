<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'supplier_code' => 'SUP' . fake()->unique()->numberBetween(1000, 9999),
            'company_name' => fake()->company(),
            'contact_person' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'alt_phone' => fake()->optional()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'pincode' => fake()->postcode(),
            'gst_number' => fake()->optional()->regexify('[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}'),
            'pan_number' => fake()->regexify('[A-Z]{5}[0-9]{4}[A-Z]{1}'),
            'tin_number' => fake()->optional()->regexify('[A-Z]{2}[0-9]{10}'),
            'cst_number' => fake()->optional()->regexify('[A-Z]{2}[0-9]{10}'),
            'website' => fake()->optional()->url(),
            'credit_limit' => fake()->numberBetween(10000, 1000000),
            'payment_terms' => fake()->randomElement(['immediate', '15_days', '30_days', '45_days', '60_days']),
            'tax_registration_number' => fake()->optional()->numerify('TRN-####-####'),
            'tax_exemption_number' => fake()->optional()->numerify('TEN-####-####'),
            'business_type' => fake()->randomElement(['manufacturer', 'distributor', 'wholesaler', 'importer']),
            'industry_type' => fake()->randomElement(['plastic', 'chemical', 'packaging', 'raw_material']),
            'supplier_group' => fake()->randomElement(['premium', 'regular', 'wholesale']),
            'status' => fake()->randomElement(['active', 'inactive', 'suspended', 'blocked']),
            'notes' => fake()->optional()->paragraph(),
            'documents' => json_encode([
                'gst_certificate' => fake()->optional()->url(),
                'pan_card' => fake()->optional()->url(),
                'trade_license' => fake()->optional()->url(),
                'msme_registration' => fake()->optional()->url(),
            ]),
            'bank_details' => json_encode([
                'bank_name' => fake()->company(),
                'account_number' => fake()->numerify('############'),
                'ifsc_code' => fake()->regexify('[A-Z]{4}0[A-Z0-9]{6}'),
                'account_type' => fake()->randomElement(['current', 'savings']),
            ]),
            'preferences' => json_encode([
                'communication_preference' => fake()->randomElements(['email', 'sms', 'phone'], 2),
                'invoice_format' => fake()->randomElement(['pdf', 'excel', 'both']),
                'language' => fake()->randomElement(['en', 'hi', 'ta', 'te']),
                'timezone' => fake()->timezone(),
            ]),
            'metadata' => json_encode([
                'first_supply_date' => fake()->optional()->dateTimeBetween('-5 years', 'now'),
                'last_supply_date' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
                'total_supplies' => fake()->numberBetween(0, 100),
                'total_purchases' => fake()->numberBetween(0, 1000000),
            ])
        ];
    }
}
