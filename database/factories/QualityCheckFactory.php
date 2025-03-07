<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ProductionBatch;
use App\Models\ProductionStage;
use Illuminate\Database\Eloquent\Factories\Factory;

class QualityCheckFactory extends Factory
{
    public function definition(): array
    {
        $checkableType = fake()->randomElement([ProductionBatch::class, ProductionStage::class]);
        $checkable = $checkableType::factory()->create();

        return [
            'check_code' => 'QC' . fake()->unique()->numberBetween(1000, 9999),
            'checkable_type' => $checkableType,
            'checkable_id' => $checkable->id,
            'parameters' => [
                'dimension' => fake()->randomFloat(2, 10, 100),
                'weight' => fake()->randomFloat(2, 1, 10),
                'color' => fake()->randomElement(['red', 'blue', 'green', 'yellow']),
                'texture' => fake()->randomElement(['smooth', 'rough', 'glossy', 'matte']),
                'strength' => fake()->randomFloat(2, 1, 10),
            ],
            'score' => fake()->randomFloat(1, 0, 100),
            'notes' => fake()->optional()->paragraph(),
            'checked_by' => User::factory(),
            'checked_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'metadata' => [
                'inspection_method' => fake()->randomElement(['visual', 'measurement', 'testing']),
                'inspection_tool' => fake()->randomElement(['caliper', 'scale', 'colorimeter']),
                'environmental_conditions' => [
                    'temperature' => fake()->randomFloat(1, 20, 30),
                    'humidity' => fake()->randomFloat(1, 40, 60),
                ],
            ],
        ];
    }

    public function passed(): static
    {
        return $this->state(fn (array $attributes) => [
            'score' => fake()->randomFloat(1, 80, 100),
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'score' => fake()->randomFloat(1, 0, 79),
        ]);
    }

    public function forBatch(): static
    {
        return $this->state(fn (array $attributes) => [
            'checkable_type' => ProductionBatch::class,
            'checkable_id' => ProductionBatch::factory(),
        ]);
    }

    public function forStage(): static
    {
        return $this->state(fn (array $attributes) => [
            'checkable_type' => ProductionStage::class,
            'checkable_id' => ProductionStage::factory(),
        ]);
    }
}
