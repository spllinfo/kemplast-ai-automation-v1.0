<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\ProductionStage;
use App\Models\MaterialAssignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlittingProcessFactory extends Factory
{
    public function definition(): array
    {
        $startTime = fake()->dateTimeBetween('-1 month', 'now');
        $endTime = fake()->boolean(70) ? fake()->dateTimeBetween($startTime, '+1 month') : null;
        $plannedRolls = fake()->numberBetween(5, 20);
        $completedRolls = $endTime ? fake()->numberBetween($plannedRolls * 0.8, $plannedRolls * 1.2) : fake()->numberBetween(0, $plannedRolls);

        return [
            'branch_id' => Branch::factory(),
            'production_stage_id' => ProductionStage::factory(),
            'material_assignment_id' => MaterialAssignment::factory(),
            'job_number' => 'SLT' . fake()->unique()->numberBetween(1000, 9999),
            'part_name' => fake()->word(),
            'part_id' => 'P' . fake()->unique()->numberBetween(1000, 9999),
            'part_description' => fake()->sentence(),
            'customer_code' => 'CUST' . fake()->numberBetween(100, 999),
            'input_roll_details' => [
                'roll_number' => 'R' . fake()->numberBetween(1000, 9999),
                'material_type' => fake()->randomElement(['BOPP', 'PET', 'PE']),
                'supplier' => fake()->company(),
            ],
            'input_roll_width' => fake()->randomFloat(2, 1000, 2000),
            'input_roll_length' => fake()->randomFloat(2, 1000, 5000),
            'input_roll_weight' => fake()->randomFloat(2, 100, 500),
            'slitting_pattern' => [
                [
                    'position' => 1,
                    'width' => fake()->randomFloat(2, 100, 300),
                    'tolerance' => '±0.5',
                ],
                [
                    'position' => 2,
                    'width' => fake()->randomFloat(2, 100, 300),
                    'tolerance' => '±0.5',
                ],
            ],
            'number_of_cuts' => fake()->numberBetween(2, 6),
            'cut_width_specifications' => [
                ['width' => 250, 'tolerance' => '±0.5'],
                ['width' => 250, 'tolerance' => '±0.5'],
            ],
            'trim_waste_width' => fake()->randomFloat(2, 5, 15),
            'blade_details' => [
                'type' => fake()->randomElement(['Razor', 'Shear', 'Crush']),
                'condition' => fake()->randomElement(['New', 'Good', 'Fair']),
                'last_changed' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            ],
            'blade_positions' => [
                ['position' => 1, 'offset' => 0],
                ['position' => 2, 'offset' => 250],
                ['position' => 3, 'offset' => 500],
            ],
            'blade_pressure' => fake()->randomFloat(2, 2, 5),
            'machine_id' => 'MCH' . fake()->numberBetween(100, 999),
            'machine_name' => 'Slitting Machine ' . fake()->numberBetween(1, 5),
            'machine_settings' => [
                'speed' => fake()->numberBetween(100, 300),
                'tension' => fake()->randomFloat(2, 10, 30),
                'blade_height' => fake()->randomFloat(2, 0.5, 2),
            ],
            'machine_speed' => fake()->numberBetween(100, 300),
            'tension_settings' => [
                'unwinding' => fake()->randomFloat(2, 10, 30),
                'rewinding' => fake()->randomFloat(2, 15, 35),
            ],
            'planned_rolls' => $plannedRolls,
            'completed_rolls' => $completedRolls,
            'total_input_weight' => fake()->randomFloat(2, 500, 1000),
            'total_output_weight' => fake()->randomFloat(2, 450, 950),
            'trim_waste_weight' => fake()->randomFloat(2, 10, 50),
            'quality_parameters' => [
                'edge_quality' => fake()->numberBetween(85, 100),
                'width_accuracy' => fake()->numberBetween(90, 100),
                'tension_uniformity' => fake()->numberBetween(85, 100),
            ],
            'quality_checkpoints' => [
                'edge_quality' => true,
                'width_measurement' => true,
                'visual_inspection' => true,
            ],
            'quality_status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'quality_approved' => fake()->boolean(80),
            'quality_notes' => fake()->optional()->paragraph(),
            'total_runtime_minutes' => fake()->numberBetween(120, 480),
            'setup_time_minutes' => fake()->numberBetween(30, 90),
            'downtime_minutes' => fake()->numberBetween(0, 60),
            'downtime_reasons' => [
                [
                    'reason' => 'Blade Change',
                    'duration' => fake()->numberBetween(10, 30),
                ],
            ],
            'power_consumption' => fake()->randomFloat(2, 50, 200),
            'good_output_quantity' => fake()->randomFloat(3, 800, 2000),
            'waste_quantity' => fake()->randomFloat(3, 10, 100),
            'defect_categories' => [
                'edge_defects' => fake()->numberBetween(0, 5),
                'width_variations' => fake()->numberBetween(0, 3),
                'wrinkles' => fake()->numberBetween(0, 2),
            ],
            'production_metrics' => [
                'efficiency' => fake()->randomFloat(2, 75, 95),
                'quality_rate' => fake()->randomFloat(2, 85, 98),
                'waste_percentage' => fake()->randomFloat(2, 2, 8),
            ],
            'roll_inventory' => [
                'input_rolls' => ['R1001', 'R1002'],
                'output_rolls' => ['SR1001', 'SR1002', 'SR1003'],
            ],
            'roll_movement' => [
                [
                    'roll_id' => 'SR1001',
                    'from' => 'Production',
                    'to' => 'Quality Check',
                    'timestamp' => now()->subHour()->toDateTimeString(),
                ],
            ],
            'operator_id' => User::factory(),
            'supervisor_id' => User::factory(),
            'operator_notes' => [
                [
                    'timestamp' => now()->subHours(3)->toDateTimeString(),
                    'note' => 'Pattern change completed',
                ],
            ],
            'shift_details' => [
                'shift' => fake()->randomElement(['Morning', 'Afternoon', 'Night']),
                'start_time' => '08:00',
                'end_time' => '16:00',
            ],
            'status' => $endTime ? 'completed' : fake()->randomElement(['pending', 'in_setup', 'running', 'paused']),
            'process_alerts' => [
                [
                    'type' => 'Blade Warning',
                    'message' => 'Blade change due in 2 hours',
                    'timestamp' => now()->subMinutes(30)->toDateTimeString(),
                ],
            ],
            'maintenance_alerts' => [
                [
                    'type' => 'Scheduled Maintenance',
                    'due_date' => now()->addDays(5)->toDateString(),
                ],
            ],
            'quality_alerts' => [
                [
                    'type' => 'Edge Quality',
                    'message' => 'Edge quality below threshold',
                    'timestamp' => now()->subHours(1)->toDateTimeString(),
                ],
            ],
            'planned_start_time' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'actual_start_time' => $startTime,
            'completion_time' => $endTime,
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'actual_start_time' => null,
            'completion_time' => null,
            'completed_rolls' => 0,
        ]);
    }

    public function inSetup(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_setup',
            'actual_start_time' => now(),
            'completion_time' => null,
            'completed_rolls' => 0,
        ]);
    }

    public function running(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'running',
            'actual_start_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'completion_time' => null,
            'completed_rolls' => fake()->numberBetween(1, $attributes['planned_rolls']),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'actual_start_time' => fake()->dateTimeBetween('-2 days', '-1 day'),
            'completion_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'completed_rolls' => $attributes['planned_rolls'],
            'quality_approved' => true,
            'quality_status' => 'approved',
        ]);
    }

    public function onHold(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'on_hold',
            'operator_notes' => array_merge($attributes['operator_notes'] ?? [], [
                [
                    'timestamp' => now()->toDateTimeString(),
                    'note' => 'Process on hold due to blade maintenance',
                ],
            ]),
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
            'completion_time' => now(),
            'operator_notes' => array_merge($attributes['operator_notes'] ?? [], [
                [
                    'timestamp' => now()->toDateTimeString(),
                    'note' => 'Process cancelled due to quality issues',
                ],
            ]),
        ]);
    }
}
