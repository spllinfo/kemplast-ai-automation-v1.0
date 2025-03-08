<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        $businessTypes = ['manufacturer', 'distributor', 'wholesaler', 'retailer', 'importer', 'other'];
        $industryTypes = ['plastic', 'chemical', 'packaging', 'recycling', 'polymer'];
        $supplierGroups = ['premium', 'standard', 'economy'];

        return [
            // Basic Information
            'supplier_code' => 'SUP' . $this->faker->unique()->numberBetween(1000, 9999),
            'company_name' => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'email' => $this->faker->companyEmail(),
            'phone' => $this->faker->numerify('##########'),
            'alt_phone' => $this->faker->optional(0.7)->numerify('##########'),

            // Address Information
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'country' => 'India',
            'pincode' => $this->faker->numerify('######'),

            // Tax Information
            'gst_number' => $this->faker->numerify('##AAAAA####A#Z#'),
            'pan_number' => $this->faker->regexify('[A-Z]{5}[0-9]{4}[A-Z]{1}'),
            'tin_number' => $this->faker->numerify('##########'),
            'cst_number' => $this->faker->numerify('##########'),

            // Additional Information
            'website' => $this->faker->optional(0.6)->url(),
            'credit_limit' => $this->faker->optional(0.8)->randomFloat(2, 100000, 1000000),
            'payment_terms' => $this->faker->randomElement(['30_days', '45_days', '60_days', '90_days', 'immediate']),
            'tax_registration_number' => $this->faker->optional(0.7)->numerify('TRN##########'),
            'tax_exemption_number' => $this->faker->optional(0.3)->numerify('TEN##########'),

            // Classification
            'business_type' => $this->faker->randomElement($businessTypes),
            'industry_type' => $this->faker->randomElement($industryTypes),
            'supplier_group' => $this->faker->randomElement($supplierGroups),

            // Status and Notes
            'status' => $this->faker->randomElement(['active', 'active', 'active', 'inactive', 'blacklisted', 'pending']),
            'notes' => $this->faker->optional(0.7)->paragraph(),

            // JSON Fields
            'documents' => [
                'gst_certificate' => $this->faker->optional(0.8)->url(),
                'pan_card' => $this->faker->optional(0.8)->url(),
                'trade_license' => $this->faker->optional(0.6)->url(),
                'msme_registration' => $this->faker->optional(0.5)->url(),
            ],

            'bank_details' => [
                'bank_name' => $this->faker->company(),
                'account_number' => $this->faker->numerify('############'),
                'ifsc_code' => $this->faker->regexify('[A-Z]{4}0[A-Z0-9]{6}'),
                'account_type' => $this->faker->randomElement(['current', 'savings'])
            ],

            'preferences' => [
                'communication_preference' => $this->faker->randomElements(['email', 'sms', 'phone', 'whatsapp'], 2),
                'invoice_format' => $this->faker->randomElement(['pdf', 'excel', 'both']),
                'language' => $this->faker->randomElement(['en', 'hi', 'mr', 'gu']),
                'timezone' => $this->faker->timezone()
            ],

            'metadata' => [
                'first_supply_date' => $this->faker->optional(0.8)->dateTimeThisDecade(),
                'last_supply_date' => $this->faker->optional(0.7)->dateTimeThisYear(),
                'total_supplies' => $this->faker->numberBetween(0, 100),
                'total_purchases' => $this->faker->randomFloat(2, 0, 1000000)
            ],

            // Tracking
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Supplier $supplier) {
            //
        })->afterCreating(function (Supplier $supplier) {
            //
        });
    }
}
