<?php

namespace Database\Factories;

use App\Models\LaminationProcess;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaminationRollFactory extends Factory
{
    public function definition(): array
    {
        $curingStartTime = fake()->dateTimeBetween('-2 days', '-1 day');
        $curingEndTime = fake()->boolean(70) ? fake()->dateTimeBetween($curingStartTime, 'now') : null;

        return [
            'lamination_process_id' => LaminationProcess::factory(),
            'roll_batch_number' => 'LR' . fake()->unique()->numberBetween(1000, 9999),
            'barcode' => fake()->unique()->ean13(),
            'qr_code' => fake()->unique()->uuid(),
            'weight' => fake()->randomFloat(2, 40, 200),
            'length' => fake()->randomFloat(2, 100, 1000),
            'width' => fake()->randomFloat(2, 100, 2000),
            'number_of_layers' => fake()->numberBetween(2, 4),
            'layer_details' => [
                [
                    'layer' => 1,
                    'material' => 'BOPP',
                    'thickness' => fake()->randomFloat(2, 12, 25),
                ],
                [
                    'layer' => 2,
                    'material' => 'MET-PET',
                    'thickness' => fake()->randomFloat(2, 12, 25),
                ],
            ],
            'bond_strength' => fake()->randomFloat(2, 200, 400),
            'delamination_test_passed' => fake()->boolean(80),
            'coating_uniformity' => [
                'min' => fake()->randomFloat(2, 1.8, 2.0),
                'max' => fake()->randomFloat(2, 2.2, 2.4),
                'average' => fake()->randomFloat(2, 2.0, 2.2),
                'variation' => fake()->randomFloat(2, 0.1, 0.3),
            ],
            'quality_measurements' => [
                'bond_strength' => fake()->numberBetween(85, 100),
                'coating_uniformity' => fake()->numberBetween(90, 100),
                'appearance' => fake()->numberBetween(85, 100),
            ],
            'quality_status' => fake()->randomElement(['pending', 'passed', 'failed']),
            'quality_approved' => fake()->boolean(80),
            'quality_notes' => fake()->optional()->paragraph(),
            'lamination_type' => fake()->randomElement(['solvent_based', 'solventless', 'water_based', 'thermal']),
            'adhesive_details' => [
                'type' => fake()->randomElement(['PU', 'Acrylic', 'EVA']),
                'brand' => fake()->company(),
                'batch_number' => 'ADH' . fake()->numberBetween(1000, 9999),
                'mixing_ratio' => '100:' . fake()->numberBetween(5, 10),
            ],
            'adhesive_consumption' => fake()->randomFloat(2, 2, 5),
            'curing_start_time' => $curingStartTime,
            'curing_end_time' => $curingEndTime,
            'machine_id' => 'MCH' . fake()->numberBetween(100, 999),
            'machine_settings' => [
                'speed' => fake()->numberBetween(50, 200),
                'temperature' => fake()->numberBetween(30, 50),
                'pressure' => fake()->randomFloat(2, 2, 5),
            ],
            'process_parameters' => [
                'nip_pressure' => fake()->randomFloat(2, 2, 5),
                'web_tension' => fake()->randomFloat(2, 10, 30),
                'coating_weight' => fake()->randomFloat(2, 2, 5),
            ],
            'status' => $curingEndTime ? 'curing_completed' : fake()->randomElement([
                'in_production',
                'in_curing',
                'in_quality_check',
                'approved',
                'rejected',
                'in_transit',
                'at_next_stage'
            ]),
            'current_location' => fake()->randomElement([
                'Production Line',
                'Curing Area',
                'Quality Check Area',
                'Temporary Storage',
                'Next Process Area'
            ]),
            'movement_history' => [
                [
                    'from' => 'Production Line',
                    'to' => 'Curing Area',
                    'timestamp' => now()->subDays(2)->toDateTimeString(),
                ],
                [
                    'from' => 'Curing Area',
                    'to' => 'Quality Check Area',
                    'timestamp' => now()->subDay()->toDateTimeString(),
                ],
            ],
            'next_process' => fake()->optional()->randomElement(['slitting', 'cutting']),
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
            'curing_start_time' => null,
            'curing_end_time' => null,
            'next_process' => null,
            'next_process_scheduled_time' => null,
        ]);
    }

    public function inCuring(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_curing',
            'quality_status' => 'pending',
            'quality_approved' => false,
            'current_location' => 'Curing Area',
            'curing_start_time' => now()->subDay(),
            'curing_end_time' => null,
        ]);
    }

    public function curingCompleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'curing_completed',
            'quality_status' => 'pending',
            'quality_approved' => false,
            'current_location' => 'Quality Check Area',
            'curing_start_time' => now()->subDays(2),
            'curing_end_time' => now()->subDay(),
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
            'next_process' => fake()->randomElement(['slitting', 'cutting']),
            'next_process_scheduled_time' => fake()->dateTimeBetween('now', '+1 week'),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'quality_status' => 'failed',
            'quality_approved' => false,
            'quality_notes' => 'Failed quality check due to poor bond strength',
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
