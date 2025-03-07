<?php

namespace Database\Factories;

use App\Models\MaterialStock;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialStockFactory extends Factory
{
    protected $model = MaterialStock::class;

    public function definition(): array
    {
        $materials = [
            'LDPE' => ['unit' => 'KG', 'price_range' => [80, 120]],
            'HDPE' => ['unit' => 'KG', 'price_range' => [90, 130]],
            'PP' => ['unit' => 'KG', 'price_range' => [85, 125]],
            'LLDPE' => ['unit' => 'KG', 'price_range' => [95, 135]],
            'Master Batch' => ['unit' => 'KG', 'price_range' => [150, 250]],
            'Processing Aids' => ['unit' => 'KG', 'price_range' => [200, 300]],
        ];

        $material = fake()->randomElement(array_keys($materials));
        $materialInfo = $materials[$material];

        return [
            'uuid' => fake()->uuid(),
            'code' => 'MAT-' . fake()->bothify('####??'),
            'name' => "$material Raw Material",
            'type' => $material,
            'category' => fake()->randomElement(['Raw Material', 'Additive', 'Packaging']),
            'quantity' => fake()->numberBetween(1000, 10000),
            'unit' => $materialInfo['unit'],
            'unit_price' => fake()->randomFloat(2, $materialInfo['price_range'][0], $materialInfo['price_range'][1]),
            'reorder_level' => fake()->numberBetween(500, 1000),
            'location' => fake()->randomElement(['Warehouse A', 'Warehouse B', 'Production Floor']),
            'batch_number' => fake()->bothify('BATCH-####??'),
            'expiry_date' => fake()->dateTimeBetween('+6 months', '+2 years'),
            'specifications' => json_encode([
                'grade' => fake()->randomElement(['A', 'B', 'Premium']),
                'color' => fake()->safeColorName(),
                'density' => fake()->randomFloat(2, 0.91, 0.97) . ' g/cm³',
            ]),
            'status' => fake()->randomElement(['in_stock', 'low_stock', 'out_of_stock']),
            'notes' => fake()->text(200),
        ];
    }

    public function lowStock(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'low_stock',
                'quantity' => fake()->numberBetween(100, 499),
            ];
        });
    }
}
