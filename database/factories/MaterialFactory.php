<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition(): array
    {
        $types = ['LD', 'LLD', 'HD', 'RD', 'MB', 'OTHER'];
        $categories = ['Raw Material', 'Finished Good', 'Semi-Finished', 'Packaging'];

        return [
            'material_code' => 'MAT-' . fake()->unique()->numberBetween(1000, 9999),
            'material_name' => fake()->word() . ' ' . fake()->randomElement(['Polymer', 'Resin', 'Additive', 'Film']),
            'material_type' => fake()->randomElement($types),
            'material_grade' => fake()->randomElement(['A', 'B', 'C']) . fake()->numberBetween(100, 999),
            'material_category' => fake()->randomElement($categories),
            'material_color' => fake()->safeColorName(),
            
            'opening_balance' => fake()->randomFloat(3, 0, 1000),
            'quantity' => fake()->randomFloat(3, 0, 1000),
            'lead_time_days' => fake()->numberBetween(1, 30),
            'minimum_order_quantity' => fake()->randomFloat(3, 100, 1000),
            
            'material_image' => null,
            'msds_document' => null,
            'technical_datasheet' => null,
            'quality_certificate' => null,
            'notes' => fake()->optional()->paragraph(),
            'certificates' => json_encode([
                'ISO' => fake()->boolean(),
                'Quality' => fake()->boolean(),
                'Safety' => fake()->boolean()
            ]),
            
            'status' => fake()->randomElement(['active', 'inactive', 'pending_approval', 'discontinued', 'out_of_stock', 'expired']),
            'is_active' => fake()->boolean(80),
            'is_returnable' => fake()->boolean(30),
            'is_batch_tracked' => fake()->boolean(90)
        ];
    }
}