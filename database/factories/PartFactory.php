<?php

namespace Database\Factories;

use App\Models\Part;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Branch;
use App\Models\User;

class PartFactory extends Factory
{
    protected $model = Part::class;

    public function definition(): array
    {
        $partTypes = [
            'Shopping Bags' => ['D Cut', 'W Cut', 'Loop Handle'],
            'Industrial Packaging' => ['Liner Bags', 'FIBC Bags', 'Jumbo Bags'],
            'Food Packaging' => ['Stand-up Pouches', 'Zip-lock Bags', 'Vacuum Bags'],
            'Agricultural Films' => ['Mulch Films', 'Greenhouse Films', 'Silage Bags'],
            'Specialty Products' => ['Security Bags', 'Medical Packaging', 'Anti-static Bags']
        ];

        $indianCustomers = [
            'Reliance Retail',
            'Big Bazaar',
            'D-Mart',
            'Metro Cash & Carry',
            'More Retail',
            'Patanjali',
            'ITC Limited',
            'Britannia Industries',
            'Haldirams',
            'Parle Agro'
        ];

        $partCategory = fake()->randomElement(array_keys($partTypes));
        $partType = fake()->randomElement($partTypes[$partCategory]);

        return [
            'part_unique_code' => 'PRT' . str_pad(fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'part_name' => $partType . ' ' . fake()->numberBetween(100, 1000) . 'mm',
            'part_category' => $partCategory,
            'part_model' => 'MOD-' . Str::random(6),
            'hsn_no' => '3923' . fake()->numberBetween(10, 90),
            'reel_size' => fake()->randomFloat(2, 100, 1000),
            'part_length' => fake()->randomFloat(2, 100, 1000),
            'part_width' => fake()->randomFloat(2, 100, 1000),
            'part_height' => fake()->randomFloat(2, 0.1, 10),
            'part_thickness' => fake()->randomFloat(2, 20, 200),
            'part_ld_ratio' => fake()->randomFloat(2, 0.2, 0.8),
            'part_lld_ratio' => fake()->randomFloat(2, 0.1, 0.5),
            'part_hd_ratio' => fake()->randomFloat(2, 0.1, 0.4),
            'part_rd_ratio' => fake()->randomFloat(2, 0, 0.3),
            'part_weight' => fake()->randomFloat(2, 0.5, 50),
            'part_price' => fake()->randomFloat(2, 50, 500),
            'no_ups' => fake()->numberBetween(1, 8),
            'sealing_type' => fake()->randomElement(['Bottom Seal', 'Side Seal', 'Patch Handle']),
            'printing_status' => fake()->boolean(),
            'printing_colour' => fake()->randomElement(['Single Color', 'Two Color', 'Four Color', 'Six Color', 'Eight Color']),
            'bundle_qty' => fake()->numberBetween(100, 1000),
            'part_quantity' => fake()->numberBetween(1000, 100000),
            'bst' => fake()->boolean(),
            'plain' => fake()->boolean(),
            'flat' => fake()->boolean(),
            'gazzate' => fake()->boolean(),
            'bio' => fake()->boolean(),
            'normal' => fake()->boolean(),
            'milky' => fake()->boolean(),
            'roto_printing' => fake()->boolean(),
            'flexo_printing' => fake()->boolean(),
            'recycle_logo' => fake()->boolean(),
            'part_description' => fake()->sentence(),
            'part_profile_picture' => null,
            'part_tags' => fake()->randomElements(['eco-friendly', 'food-grade', 'heavy-duty', 'custom-design', 'recyclable'], 2),
            'status' => fake()->randomElement(['active', 'inactive', 'archived']),
            'branch_id' => Branch::factory(),
            'customer_id' => Customer::factory(),
            'user_id' => User::factory()
        ];
    }
}
