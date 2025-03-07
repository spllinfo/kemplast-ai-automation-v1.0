<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $customers = Customer::all();
        $admin = User::where('role', 'admin')->first();

        $partCategories = ['Bags', 'Rolls', 'Sheets', 'Pouches', 'Covers'];
        $sealingTypes = ['Bottom Seal', 'Side Seal', 'Three Side Seal', 'Four Side Seal', 'None'];
        $printingColors = ['Single Color', 'Two Color', 'Three Color', 'Four Color', 'None'];
        $reelSizes = ['12"', '14"', '16"', '18"', '20"', '22"', '24"'];

        foreach ($branches as $branch) {
            // Create 10 parts for each branch
            for ($i = 1; $i <= 10; $i++) {
                $isPrinting = fake()->boolean(70);
                $partCategory = fake()->randomElement($partCategories);

                Part::create([
                    'part_unique_code' => 'P' . $branch->id . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                    'part_name' => $partCategory . ' - ' . fake()->bothify('???-###'),
                    'part_category' => $partCategory,
                    'part_model' => fake()->bothify('MOD-???##'),
                    'hsn_no' => fake()->numerify('39######'),
                    'reel_size' => fake()->randomElement($reelSizes),

                    // Dimensions
                    'part_length' => fake()->randomFloat(3, 100, 1000),
                    'part_width' => fake()->randomFloat(3, 100, 1000),
                    'part_height' => fake()->randomFloat(3, 0.1, 5),
                    'part_thickness' => fake()->randomFloat(3, 0.01, 0.2),

                    // Material Ratios
                    'part_ld_ratio' => fake()->randomFloat(3, 0, 100),
                    'part_lld_ratio' => fake()->randomFloat(3, 0, 100),
                    'part_hd_ratio' => fake()->randomFloat(3, 0, 100),
                    'part_rd_ratio' => fake()->randomFloat(3, 0, 100),
                    'part_weight' => fake()->randomFloat(3, 0.5, 50),
                    'part_price' => fake()->randomFloat(2, 50, 500),

                    // Production Details
                    'no_ups' => fake()->numberBetween(1, 8),
                    'sealing_type' => fake()->randomElement($sealingTypes),
                    'printing_status' => $isPrinting,
                    'printing_colour' => $isPrinting ? fake()->randomElement($printingColors) : 'None',
                    'bundle_qty' => fake()->numberBetween(50, 500),
                    'part_quantity' => fake()->numberBetween(1000, 10000),

                    // Toggle Properties
                    'bst' => fake()->boolean(30),
                    'plain' => fake()->boolean(40),
                    'flat' => fake()->boolean(50),
                    'gazzate' => fake()->boolean(20),
                    'bio' => fake()->boolean(10),
                    'normal' => fake()->boolean(60),
                    'milky' => fake()->boolean(30),
                    'roto_printing' => $isPrinting ? fake()->boolean(40) : false,
                    'flexo_printing' => $isPrinting ? fake()->boolean(60) : false,
                    'recycle_logo' => fake()->boolean(80),

                    // Basic Properties
                    'part_description' => fake()->paragraph(),
                    'part_tags' => json_encode([
                        'material_type' => fake()->randomElement(['LD', 'LLD', 'HD', 'RD', 'Mixed']),
                        'application' => fake()->randomElement(['Food', 'Industrial', 'Retail', 'Medical']),
                        'features' => fake()->randomElements(['UV Stabilized', 'Anti-Static', 'Food Grade', 'Heavy Duty', 'Light Weight'], 2)
                    ]),
                    'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']),

                    // Foreign Keys
                    'branch_id' => $branch->id,
                    'customer_id' => $customers->random()->id,
                    'user_id' => $admin->id,
                ]);
            }
        }
    }
}
