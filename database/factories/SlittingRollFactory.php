<?php

namespace Database\Factories;

use App\Models\SlittingProcess;
use App\Models\LaminationRoll;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlittingRollFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slitting_process_id' => SlittingProcess::factory(),
            'roll_batch_number' => 'SR' . fake()->unique()->numberBetween(1000, 9999),
            'barcode' => fake()->unique()->ean13(),
            'qr_code' => fake()->unique()->uuid(),
            'parent_roll_id' => LaminationRoll::factory(),
            'slit_number' => fake()->numberBetween(1, 6),
            'weight' => fake()->randomFloat(2, 20, 100),
            'length' => fake()->randomFloat(2, 100, 1000),
            'width' => fake()->randomFloat(2, 100, 500),
            'diameter' => fake()->randomFloat(2, 200, 500),
            'core_details' => [
                'material' => fake()->randomElement(['Paper', 'Plastic', 'Metal']),
                'inner_diameter' => fake()->randomFloat(2, 70, 76),
                'wall_thickness' => fake()->randomFloat(2, 10, 15),
            ],
            'edge_quality' => [
                'left_edge' => fake()->numberBetween(85, 100),
                'right_edge' => fake()->numberBetween(85, 100),
                'uniformity' => fake()->numberBetween(90, 100),
            ],
            'edge_trim_width' => fake()->randomFloat(2, 2, 5),
            'tension_values' => [
                'unwinding' => fake()->randomFloat(2, 10, 30),
                'rewinding' => fake()->randomFloat(2, 15, 35),
            ],
            'quality_measurements' => [
                'width_accuracy' => fake()->numberBetween(90, 100),
                'edge_quality' => fake()->numberBetween(85, 100),
                'surface_quality' => fake()->numberBetween(90, 100),
            ],
            'quality_status' => fake()->randomElement(['pending', 'passed', 'failed']),
            'quality_approved' => fake()->boolean(80),
            'quality_notes' => fake()->optional()->paragraph(),
            'defects_found' => [
                [
                    'type' => 'Edge Defect',
                    'severity' => fake()->randomElement(['Minor', 'Major']),
                    'location' => fake()->randomElement(['Left', 'Right']),
                    'length' => fake()->randomFloat(2, 1, 10),
                ],
            ],
            'machine_id' => 'MCH' . fake()->numberBetween(100, 999),
            'machine_settings' => [
                'speed' => fake()->numberBetween(100, 300),
                'tension' => fake()->randomFloat(2, 10, 30),
                'blade_height' => fake()->randomFloat(2, 0.5, 2),
            ],
            'process_parameters' => [
                'blade_pressure' => fake()->randomFloat(2, 2, 5),
                'web_tension' => fake()->randomFloat(2, 10, 30),
            ],
            'status' => fake()->randomElement([
                'in_production',
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
                'Rejected Storage',
                'Next Process Area'
            ]),
            'movement_history' => [
                [
                    'from' => 'Production Line',
                    'to' => 'Quality Check Area',
                    'timestamp' => now()->subHour()->toDateTimeString(),
                ],
            ],
            'next_process' => fake()->optional()->randomElement(['packaging', 'shipping']),
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
            'next_process' => fake()->randomElement(['packaging', 'shipping']),
            'next_process_scheduled_time' => fake()->dateTimeBetween('now', '+1 week'),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'quality_status' => 'failed',
            'quality_approved' => false,
            'quality_notes' => 'Failed quality check due to poor edge quality',
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
