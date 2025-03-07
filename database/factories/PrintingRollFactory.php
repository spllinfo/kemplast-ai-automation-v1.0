<?php

namespace Database\Factories;

use App\Models\PrintingProcess;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintingRollFactory extends Factory
{
    public function definition(): array
    {
        return [
            'printing_process_id' => PrintingProcess::factory(),
            'roll_batch_number' => 'PR' . fake()->unique()->numberBetween(1000, 9999),
            'barcode' => fake()->unique()->ean13(),
            'qr_code' => fake()->unique()->uuid(),
            'weight' => fake()->randomFloat(2, 40, 200),
            'length' => fake()->randomFloat(2, 100, 1000),
            'width' => fake()->randomFloat(2, 100, 2000),
            'material_type' => fake()->randomElement(['LDPE', 'LLDPE', 'HDPE', 'PP']),
            'color_density_readings' => [
                'Cyan' => [
                    'min' => fake()->randomFloat(2, 1.2, 1.4),
                    'max' => fake()->randomFloat(2, 1.6, 1.8),
                    'average' => fake()->randomFloat(2, 1.4, 1.6),
                ],
                'Magenta' => [
                    'min' => fake()->randomFloat(2, 1.2, 1.4),
                    'max' => fake()->randomFloat(2, 1.6, 1.8),
                    'average' => fake()->randomFloat(2, 1.4, 1.6),
                ],
                'Yellow' => [
                    'min' => fake()->randomFloat(2, 0.9, 1.1),
                    'max' => fake()->randomFloat(2, 1.3, 1.5),
                    'average' => fake()->randomFloat(2, 1.1, 1.3),
                ],
                'Black' => [
                    'min' => fake()->randomFloat(2, 1.5, 1.7),
                    'max' => fake()->randomFloat(2, 1.9, 2.1),
                    'average' => fake()->randomFloat(2, 1.7, 1.9),
                ],
            ],
            'registration_accuracy' => [
                'x_axis' => fake()->randomFloat(3, -0.1, 0.1),
                'y_axis' => fake()->randomFloat(3, -0.1, 0.1),
                'overall' => fake()->randomFloat(3, 0, 0.15),
            ],
            'adhesion_test_passed' => fake()->boolean(80),
            'print_defects' => [
                'color_variation' => fake()->numberBetween(0, 3),
                'registration_error' => fake()->numberBetween(0, 2),
                'smudging' => fake()->numberBetween(0, 2),
                'pinholes' => fake()->numberBetween(0, 1),
            ],
            'quality_measurements' => [
                'color_accuracy' => fake()->numberBetween(85, 100),
                'print_sharpness' => fake()->numberBetween(90, 100),
                'surface_quality' => fake()->numberBetween(85, 100),
            ],
            'quality_status' => fake()->randomElement(['pending', 'passed', 'failed']),
            'quality_approved' => fake()->boolean(80),
            'quality_notes' => fake()->optional()->paragraph(),
            'print_type' => fake()->randomElement(['flexo', 'roto']),
            'number_of_colors' => fake()->numberBetween(1, 8),
            'color_details' => [
                ['color' => 'Cyan', 'position' => 1, 'coverage' => fake()->numberBetween(10, 100)],
                ['color' => 'Magenta', 'position' => 2, 'coverage' => fake()->numberBetween(10, 100)],
                ['color' => 'Yellow', 'position' => 3, 'coverage' => fake()->numberBetween(10, 100)],
                ['color' => 'Black', 'position' => 4, 'coverage' => fake()->numberBetween(10, 100)],
            ],
            'ink_consumption' => [
                'Cyan' => fake()->randomFloat(2, 0.1, 0.5),
                'Magenta' => fake()->randomFloat(2, 0.1, 0.5),
                'Yellow' => fake()->randomFloat(2, 0.1, 0.5),
                'Black' => fake()->randomFloat(2, 0.1, 0.5),
            ],
            'artwork_reference' => 'ART' . fake()->numberBetween(1000, 9999),
            'machine_id' => 'MCH' . fake()->numberBetween(100, 999),
            'machine_settings' => [
                'speed' => fake()->numberBetween(50, 200),
                'temperature' => fake()->numberBetween(30, 50),
                'pressure' => fake()->randomFloat(2, 2, 5),
            ],
            'printing_speed' => fake()->numberBetween(50, 200),
            'process_parameters' => [
                'anilox_volume' => fake()->randomFloat(2, 3, 8),
                'doctor_blade_angle' => fake()->numberBetween(30, 60),
                'impression_pressure' => fake()->randomFloat(2, 2, 5),
            ],
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
            'next_process' => fake()->optional()->randomElement(['lamination', 'slitting', 'cutting']),
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
            'next_process' => fake()->randomElement(['lamination', 'slitting', 'cutting']),
            'next_process_scheduled_time' => fake()->dateTimeBetween('now', '+1 week'),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'quality_status' => 'failed',
            'quality_approved' => false,
            'quality_notes' => 'Failed quality check due to color density variation',
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
