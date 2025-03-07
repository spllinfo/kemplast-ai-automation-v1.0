<?php

namespace Database\Factories;

use App\Models\FinishedGood;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinishedGoodFactory extends Factory
{
    protected $model = FinishedGood::class;

    public function definition(): array
    {
        return [
            'packing_process_id' => null, // Set in seeder
            'product_code' => 'FG-' . fake()->bothify('####??'),
            'batch_number' => fake()->bothify('??####'),
            'quantity' => fake()->randomFloat(2, 100, 1000),
            'unit' => fake()->randomElement(['PCS', 'KG', 'MTR']),
            'quality_status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'packaging_type' => fake()->randomElement(['Box', 'Bag', 'Roll', 'Pallet']),
            'storage_location' => fake()->bothify('ZONE-#-RACK-#-LEVEL-#'),
            'production_date' => fake()->date(),
            'expiry_date' => fake()->dateTimeBetween('+6 months', '+1 year'),
        ];
    }
}
