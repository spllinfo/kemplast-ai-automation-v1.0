<?php

namespace Database\Factories;

use App\Models\ExtrusionProcess;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtrusionRollFactory extends Factory
{
    public function definition(): array
    {
        return [
            'extrusion_process_id' => ExtrusionProcess::factory(),
            'roll_number' => 'ER' . fake()->unique()->numberBetween(1000, 9999),
            'barcode' => fake()->unique()->ean13(),
            'qr_code' => fake()->unique()->uuid(),
            'weight' => fake()->randomFloat(2, 40, 200),
            'length' => fake()->randomFloat(2, 100, 1000),
            'width' => fake()->randomFloat(2, 100, 2000),
            'thickness' => fake()->randomFloat(3, 0.01, 0.5),
            'quality_measurements' => [
                'thickness_uniformity' => [
                    'min' => fake()->randomFloat(3, 0.045, 0.048),
                    'max' => fake()->randomFloat(3, 0.052, 0.055),
                    'average' => fake()->randomFloat(3, 0.049, 0.051),
                ],
                'width_uniformity' => [
                    'min' => fake()->randomFloat(2, 498, 499),
                    'max' => fake()->randomFloat(2, 501, 502),
                    'average' => fake()->randomFloat(2, 499.5, 500.5),
                ],
                'surface_quality' => fake()->numberBetween(85, 100),
                'transparency' => fake()->numberBetween(90, 100),
            ],
            'quality_status' => fake()->randomElement(['pending', 'passed', 'failed']),
            'quality_approved' => fake()->boolean(80),
            'quality_notes' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement([
                'in_production',
                'completed',
                'in_quality_check',
                'approved',
                'rejected',
                'in_transit',
                'at_next_stage'
            ]),
            'current_location' => fake()->randomElement([
                'Production Line',
                'Quality Check Area',
                'Temporary Storage',
                'Next Process Area'
            ]),
            'movement_history' => [
                [
                    'from' => 'Production Line',
                    'to' => 'Quality Check Area',
                    'timestamp' => now()->subHours(2)->toDateTimeString(),
                ],
                [
                    'from' => 'Quality Check Area',
                    'to' => 'Temporary Storage',
                    'timestamp' => now()->subHour()->toDateTimeString(),
                ],
            ],
            'next_process' => fake()->optional()->randomElement(['printing', 'lamination', 'slitting']),
            'next_process_scheduled_time' => fake()->optional()->dateTimeBetween('now', '+1 week'),
        ];
    }

    public function inProduction(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_production',
            'quality_status' => 'pending',
            'quality_approved' => false,
            'current_location' => 'Production Line',
            'next_process' => null,
            'next_process_scheduled_time' => null,
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'quality_status' => 'pending',
            'quality_approved' => false,
            'current_location' => 'Quality Check Area',
        ]);
    }

    public function inQualityCheck(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_quality_check',
            'quality_status' => 'pending',
            'quality_approved' => false,
            'current_location' => 'Quality Check Area',
        ]);
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'quality_status' => 'passed',
            'quality_approved' => true,
            'current_location' => 'Temporary Storage',
            'next_process' => fake()->randomElement(['printing', 'lamination', 'slitting']),
            'next_process_scheduled_time' => fake()->dateTimeBetween('now', '+1 week'),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'quality_status' => 'failed',
            'quality_approved' => false,
            'quality_notes' => 'Failed quality check due to thickness variation',
            'current_location' => 'Rejected Storage',
            'next_process' => null,
            'next_process_scheduled_time' => null,
        ]);
    }

    public function inTransit(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_transit',
            'current_location' => 'In Transit',
            'movement_history' => array_merge($attributes['movement_history'] ?? [], [
                [
                    'from' => 'Temporary Storage',
                    'to' => 'In Transit',
                    'timestamp' => now()->toDateTimeString(),
                ],
            ]),
        ]);
    }

    public function atNextStage(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'at_next_stage',
            'current_location' => 'Next Process Area',
            'movement_history' => array_merge($attributes['movement_history'] ?? [], [
                [
                    'from' => 'In Transit',
                    'to' => 'Next Process Area',
                    'timestamp' => now()->toDateTimeString(),
                ],
            ]),
        ]);
    }
}
