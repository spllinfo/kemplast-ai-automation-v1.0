<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        // Create supplier users first
        $supplierUsers = [];
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => fake()->company(),
                'email' => fake()->unique()->companyEmail(),
                'password' => Hash::make('password'),
                'mobile' => fake()->phoneNumber(),
                'role' => 'staff',
                'status' => 'active'
            ]);
            $supplierUsers[] = $user->id;
        }

        // Create suppliers with relationship to users
        foreach ($supplierUsers as $userId) {
            Supplier::create([
                'supplier_unique_code' => 'SUP' . str_pad(fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
                'supplier_name' => fake()->company(),
                'supplier_mail' => fake()->companyEmail(),
                'supplier_phone' => fake()->phoneNumber(),
                'supplier_gst' => 'GST' . fake()->numerify('###########'),
                'key_contact' => fake()->name(),
                'supplier_business_type' => fake()->randomElement(['Manufacturer', 'Wholesaler', 'Distributor', 'Importer']),
                'supplier_delivery_terms' => fake()->randomElement(['FOB', 'CIF', 'EXW', 'DDP']),
                'supplier_payment_terms' => fake()->randomElement(['Net 30', 'Net 60', 'Immediate', 'COD']),
                'supplier_address' => fake()->address(),
                'supplier_website' => fake()->url(),
                'social_media_links' => json_encode([
                    'linkedin' => fake()->url(),
                    'twitter' => fake()->url(),
                    'facebook' => fake()->url()
                ]),
                'additional_notes' => fake()->text(),
                'user_id' => $userId
            ]);
        }
    }
}