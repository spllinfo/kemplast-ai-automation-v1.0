<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Branch;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Create some test users if they don't exist
        if (User::count() === 0) {
            User::factory(3)->create();
        }

        // Create some test branches if they don't exist
        if (Branch::count() === 0) {
            Branch::factory(2)->create();
        }

        // Create some test suppliers if they don't exist
        if (Supplier::count() === 0) {
            Supplier::factory(5)->create();
        }

        // Create a diverse set of materials
        // For each material type, create multiple materials
        $materialTypes = ['LD', 'LLD', 'HD', 'RD', 'MB', 'OTHER'];

        foreach ($materialTypes as $type) {
            // Create 5 materials of each type
            Material::factory(5)
                ->state(function (array $attributes) use ($type) {
                    return [
                        'material_type' => $type,
                        // Ensure at least one material of each type is active
                        'status' => $attributes['status'] === 'active' ? 'active' : $attributes['status'],
                        'is_active' => $attributes['is_active'] || rand(0, 4) === 0,
                    ];
                })
                ->create();
        }

        // Create some special case materials
        // 1. High-value materials
        Material::factory(3)
            ->state(function (array $attributes) {
                return [
                    'unit_price' => rand(800, 1500),
                    'material_category' => 'Raw Material',
                    'requires_coa' => true,
                    'requires_inspection' => true,
                    'quality_grade' => 'Premium',
                ];
            })
            ->create();

        // 2. Low stock materials
        Material::factory(3)
            ->state(function (array $attributes) {
                $minStock = $attributes['minimum_stock_level'];
                return [
                    'quantity' => rand($minStock * 0.5, $minStock * 0.9),
                    'status' => 'out_of_stock',
                ];
            })
            ->create();

        // 3. Expired materials
        Material::factory(2)
            ->state(function (array $attributes) {
                return [
                    'manufacture_date' => now()->subMonths(14),
                    'expiry_date' => now()->subMonths(2),
                    'status' => 'expired',
                    'is_active' => false,
                ];
            })
            ->create();

        // 4. Pending approval materials
        Material::factory(2)
            ->state(function (array $attributes) {
                return [
                    'status' => 'pending_approval',
                    'is_active' => false,
                    'requires_inspection' => true,
                ];
            })
            ->create();
    }
}
