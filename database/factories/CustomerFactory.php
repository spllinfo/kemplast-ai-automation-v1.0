<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        $companyName = fake()->company();

        return [
            'customer_unique_code' => 'CUS' . str_pad(fake()->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'company_profile_picture' => null, // Will be handled separately if needed
            'company_name' => $companyName,
            'contact_person' => fake()->name(),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->numerify('+91##########'),
            'alt_phone' => fake()->optional(0.7)->numerify('+91##########'),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->randomElement(['India', 'United States', 'United Kingdom', 'Singapore', 'Australia']),
            'pincode' => fake()->postcode(),
            'gst_number' => fake()->optional(0.8)->regexify('[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}'),
            'pan_number' => fake()->optional(0.9)->regexify('[A-Z]{5}[0-9]{4}[A-Z]{1}'),
            'tin_number' => fake()->optional(0.6)->regexify('[A-Z]{2}[0-9]{10}'),
            'cst_number' => fake()->optional(0.6)->regexify('[A-Z]{2}[0-9]{10}'),
            'website' => fake()->optional(0.7)->url(),
            'credit_limit' => fake()->optional(0.8)->randomFloat(2, 10000, 1000000),
            'payment_terms' => fake()->randomElement(['advance', '15_days', '30_days', '45_days', '60_days']),
            'tax_registration_number' => fake()->optional(0.7)->numerify('TRN-####-####'),
            'tax_exemption_number' => fake()->optional(0.3)->numerify('TEN-####-####'),
            'business_type' => fake()->randomElement(['manufacturer', 'distributor', 'retailer', 'wholesaler', 'importer', 'exporter']),
            'industry_type' => fake()->randomElement([
                'Information Technology',
                'Manufacturing',
                'Healthcare',
                'Retail',
                'Professional Services',
                'Education',
                'Logistics',
                'Financial Services',
                'Construction',
                'Energy',
                'Agriculture',
                'Telecommunications'
            ]),
            'customer_group' => fake()->randomElement(['retail', 'wholesale', 'corporate', 'government']),
            'company_size' => fake()->randomElement(['Startup', 'Micro Business', 'Small Business', 'Medium Size', 'Corporate', 'Large Enterprise']),
            'status' => fake()->randomElement(['active', 'inactive', 'blacklisted']),
            'notes' => fake()->optional(0.7)->paragraph(),
            'documents' => json_encode([
                [
                    'name' => 'Business Registration',
                    'type' => 'pdf',
                    'url' => fake()->url(),
                    'uploaded_at' => fake()->dateTimeThisYear()->format('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Tax Certificate',
                    'type' => 'pdf',
                    'url' => fake()->url(),
                    'uploaded_at' => fake()->dateTimeThisYear()->format('Y-m-d H:i:s')
                ]
            ]),
            'bank_details' => json_encode([
                'bank_name' => fake()->company() . ' Bank',
                'account_number' => fake()->numerify('############'),
                'ifsc_code' => fake()->regexify('[A-Z]{4}[0-9]{7}'),
                'account_type' => fake()->randomElement(['Savings', 'Current']),
                'branch_name' => fake()->city() . ' Branch',
                'swift_code' => fake()->optional(0.5)->regexify('[A-Z]{6}[0-9]{2}[A-Z]{3}')
            ]),
            'preferences' => json_encode([
                'communication_preference' => fake()->randomElements(['email', 'phone', 'sms', 'whatsapp'], fake()->numberBetween(1, 4)),
                'payment_preference' => fake()->randomElement(['bank_transfer', 'cheque', 'cash', 'upi']),
                'delivery_preference' => fake()->randomElement(['standard', 'express', 'priority']),
                'notification_settings' => [
                    'order_updates' => fake()->boolean(80),
                    'promotional_emails' => fake()->boolean(60),
                    'invoice_emails' => fake()->boolean(90),
                    'payment_reminders' => fake()->boolean(85)
                ]
            ]),
            'metadata' => json_encode([
                'year_established' => fake()->year(),
                'employee_count' => fake()->numberBetween(10, 10000),
                'annual_revenue' => fake()->randomFloat(2, 1000000, 100000000),
                'market_segment' => fake()->randomElement(['Premium', 'Mid-Market', 'Economy']),
                'certifications' => fake()->randomElements(['ISO 9001', 'ISO 14001', 'OHSAS 18001', 'HACCP', 'GMP'], fake()->numberBetween(1, 3)),
                'social_media' => [
                    'linkedin' => fake()->optional(0.7)->url(),
                    'twitter' => fake()->optional(0.6)->url(),
                    'facebook' => fake()->optional(0.5)->url()
                ],
                'last_order_date' => fake()->boolean(80) ? fake()->dateTimeThisYear()->format('Y-m-d') : null,
                'total_orders' => fake()->numberBetween(0, 100),
                'total_spent' => fake()->randomFloat(2, 0, 1000000)
            ]),
            'sales_person_id' => User::where('designation', 'Sales Executive')->inRandomOrder()->first()?->id,
            'branch_id' => Branch::inRandomOrder()->first()?->id,
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at'], 'now');
            }
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active'
            ];
        });
    }

    public function premium()
    {
        return $this->state(function (array $attributes) {
            return [
                'customer_group' => 'premium',
                'credit_limit' => fake()->randomFloat(2, 500000, 2000000)
            ];
        });
    }
}
