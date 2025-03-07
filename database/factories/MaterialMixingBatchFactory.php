<?php

namespace Database\Factories;

use App\Models\MaterialAssignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialMixingBatchFactory extends Factory
{
    public function definition(): array
    {
        $startTime = fake()->dateTimeBetween('-1 month', 'now');
        $endTime = fake()->boolean(70) ? fake()->dateTimeBetween($startTime, '+1 day') : null;

        return [
            'material_assignment_id' => MaterialAssignment::factory(),
            'batch_number' => 'MB' . fake()->unique()->numberBetween(1000, 9999),
            'batch_sequence' => fake()->numberBetween(1, 5),
            'batch_weight' => fake()->randomFloat(2, 100, 1000),
            'mixing_start_time' => $startTime,
            'mixing_end_time' => $endTime,
            'material_quantities' => [
                'ld' => fake()->randomFloat(2, 10, 50),
                'lld' => fake()->randomFloat(2, 10, 50),
                'hd' => fake()->randomFloat(2, 10, 50),
                'rd' => fake()->randomFloat(2, 10, 50),
            ],
            'mixing_parameters' => [
                'temperature' => fake()->numberBetween(150, 250),
                'time' => fake()->numberBetween(30, 120),
                'speed' => fake()->numberBetween(100, 500),
            ],
            'quality_parameters' => [
                'appearance' => fake()->randomElement(['good', 'fair', 'poor']),
                'uniformity' => fake()->numberBetween(70, 100),
                'contamination' => fake()->boolean(20),
            ],
            'quality_status' => fake()->randomElement(['pending', 'passed', 'failed']),
            'quality_notes' => fake()->optional()->paragraph(),
            'operator_id' => User::factory(),
            'operator_notes' => fake()->optional()->paragraph(),
            'status' => $endTime ? 'completed' : fake()->randomElement(['pending', 'in_process', 'on_hold']),
            'current_location' => fake()->randomElement(['Mixing Area', 'Quality Check', 'Storage', 'Production Line']),
            'movement_history' => [
                [
                    'from' => 'Storage',
                    'to' => 'Mixing Area',
                    'timestamp' => fake()->dateTimeBetween('-1 month', '-2 weeks')->format('Y-m-d H:i:s'),
                ],
                [
                    'from' => 'Mixing Area',
                    'to' => 'Quality Check',
                    'timestamp' => fake()->dateTimeBetween('-2 weeks', '-1 week')->format('Y-m-d H:i:s'),
                ],
            ],
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'mixing_start_time' => null,
            'mixing_end_time' => null,
            'quality_status' => 'pending',
            'current_location' => 'Storage',
        ]);
    }

    public function inProcess(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_process',
            'mixing_start_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'mixing_end_time' => null,
            'quality_status' => 'pending',
            'current_location' => 'Mixing Area',
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'mixing_start_time' => fake()->dateTimeBetween('-2 days', '-1 day'),
            'mixing_end_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'quality_status' => 'passed',
            'current_location' => 'Storage',
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'quality_status' => 'failed',
            'quality_notes' => 'Failed quality check due to contamination',
            'current_location' => 'Rejected Storage',
        ]);
    }

    public function onHold(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'on_hold',
            'operator_notes' => 'On hold due to equipment maintenance',
            'current_location' => 'Mixing Area',
        ]);
    }
}
