<?php

namespace Database\Factories;

use App\Models\MaterialQualityCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialQualityCheckFactory extends Factory
{
    protected $model = MaterialQualityCheck::class;

    public function definition(): array
    {
        return [
            'material_stock_id' => null, // Set in seeder
            'transaction_id' => null, // Set in seeder
            'inspector_id' => null, // Set in seeder
            'check_type' => fake()->randomElement(['inward', 'periodic', 'pre-production']),
            'batch_number' => 'QC-' . fake()->bothify('####??'),
            'check_date' => fake()->dateTimeBetween('-1 week', 'now'),
            'parameters_checked' => json_encode([
                'density' => true,
                'mfi' => true,
                'contamination' => true,
                'moisture' => true,
            ]),
            'test_results' => json_encode([
                'density' => fake()->randomFloat(3, 0.910, 0.960),
                'mfi' => fake()->randomFloat(2, 0.5, 2.5),
                'contamination' => fake()->randomElement(['none', 'minor', 'major']),
                'moisture' => fake()->randomFloat(2, 0.01, 0.05),
            ]),
            'overall_status' => fake()->randomElement(['passed', 'failed', 'conditional']),
        ];
    }
}
