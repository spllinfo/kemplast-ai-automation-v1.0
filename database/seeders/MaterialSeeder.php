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
        $branches = Branch::all();
        $suppliers = Supplier::all();
        $admin = User::where('role', 'admin')->first();

        $materialTypes = ['LD', 'LLD', 'HD', 'RD', 'MB', 'OTHER'];
        $materialCategories = ['Raw Material', 'Finished Good', 'Semi-Finished', 'Packaging'];
        $colors = ['Natural', 'White', 'Black', 'Blue', 'Red', 'Green', 'Yellow', 'Custom'];

        foreach ($branches as $branch) {
            // Create 5 materials of each type for each branch
            foreach ($materialTypes as $type) {
                for ($i = 1; $i <= 5; $i++) {
                    Material::create([
                        'material_code' => $type . str_pad(fake()->unique()->numberBetween(1000, 9999), 4, '0', STR_PAD_LEFT),
                        'material_name' => $type . ' Grade ' . fake()->bothify('???-###'),
                        'material_type' => $type,
                        'material_grade' => fake()->bothify('Grade-???##'),
                        'material_category' => fake()->randomElement($materialCategories),
                        'material_color' => fake()->randomElement($colors),

                        // Stock Information
                        'opening_balance' => fake()->numberBetween(1000, 5000),
                        'quantity' => fake()->numberBetween(500, 2000),
                        'uom' => fake()->randomElement(['KG', 'MT', 'PCS']),
                        'minimum_stock_level' => fake()->numberBetween(100, 500),
                        'maximum_stock_level' => fake()->numberBetween(5000, 10000),
                        'reorder_point' => fake()->numberBetween(200, 1000),
                        'safety_stock' => fake()->numberBetween(300, 800),

                        // Pricing
                        'unit_price' => fake()->randomFloat(2, 50, 500),
                        'last_purchase_price' => fake()->randomFloat(2, 45, 480),
                        'currency' => 'INR',
                        'tax_rate' => fake()->randomFloat(2, 5, 28),
                        'hsn_code' => fake()->numerify('39######'),

                        // Physical Properties
                        'density' => fake()->randomFloat(3, 0.9, 1.5),
                        'melt_flow_index' => fake()->randomFloat(3, 0.5, 25),
                        'technical_properties' => json_encode([
                            'tensile_strength' => fake()->numberBetween(20, 50) . ' MPa',
                            'elongation' => fake()->numberBetween(100, 800) . '%',
                            'impact_strength' => fake()->numberBetween(2, 20) . ' kJ/m²'
                        ]),
                        'standard_weight' => fake()->randomFloat(3, 20, 25),
                        'standard_length' => fake()->randomFloat(3, 100, 1000),
                        'standard_width' => fake()->randomFloat(3, 100, 1000),

                        // Storage
                        'warehouse_location' => 'ZONE-' . fake()->randomLetter() . fake()->numberBetween(1, 5),
                        'bin_location' => 'BIN-' . fake()->bothify('??-##'),
                        'storage_conditions' => json_encode([
                            'temperature' => '15-35°C',
                            'humidity' => '45-65%',
                            'stacking' => 'Max 5 bags'
                        ]),
                        'shelf_life_days' => fake()->numberBetween(180, 730),

                        // Quality
                        'quality_grade' => fake()->randomElement(['A', 'B', 'C', 'Premium']),
                        'quality_parameters' => json_encode([
                            'moisture' => '< 0.1%',
                            'contamination' => '< 0.05%',
                            'bulk_density' => '0.50-0.56 g/cm³'
                        ]),
                        'manufacture_date' => fake()->dateTimeBetween('-6 months', 'now'),
                        'expiry_date' => fake()->dateTimeBetween('now', '+2 years'),
                        'requires_inspection' => fake()->boolean(70),
                        'inspection_interval_days' => fake()->numberBetween(30, 90),

                        // Supplier Info
                        'primary_supplier_id' => $suppliers->random()->id,
                        'alternative_suppliers' => json_encode($suppliers->random(2)->pluck('id')->toArray()),
                        'manufacturer_name' => fake()->company(),
                        'brand_name' => fake()->company() . ' Polymers',
                        'lead_time_days' => fake()->numberBetween(7, 45),
                        'minimum_order_quantity' => fake()->numberBetween(500, 2000),

                        // Status and Control
                        'status' => fake()->randomElement(['active', 'active', 'active', 'inactive', 'out_of_stock']),
                        'is_active' => true,
                        'is_returnable' => fake()->boolean(30),
                        'is_batch_tracked' => true,
                        'requires_coa' => fake()->boolean(60),

                        // Tracking
                        'created_by' => $admin->id,
                        'updated_by' => $admin->id,
                        'branch_id' => $branch->id,
                        'last_stock_update' => now(),
                        'last_price_update' => fake()->dateTimeBetween('-3 months', 'now'),

                        // Notes
                        'notes' => fake()->paragraph()
                    ]);
                }
            }
        }
    }
}
