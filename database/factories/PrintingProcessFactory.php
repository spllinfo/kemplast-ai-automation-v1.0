<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\ProductionStage;
use App\Models\MaterialAssignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintingProcessFactory extends Factory
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
            'job_number' => 'PRT' . fake()->unique()->numberBetween(1000, 9999),
            'part_name' => fake()->word(),
            'part_id' => 'P' . fake()->unique()->numberBetween(1000, 9999),
            'part_description' => fake()->sentence(),
            'customer_code' => 'CUST' . fake()->numberBetween(100, 999),
            'print_type' => fake()->randomElement(['flexo', 'roto']),
            'number_of_colors' => fake()->numberBetween(1, 8),
            'color_details' => [
                ['color' => 'Cyan', 'position' => 1, 'density' => fake()->randomFloat(2, 1.3, 1.7)],
                ['color' => 'Magenta', 'position' => 2, 'density' => fake()->randomFloat(2, 1.3, 1.7)],
                ['color' => 'Yellow', 'position' => 3, 'density' => fake()->randomFloat(2, 1.0, 1.4)],
                ['color' => 'Black', 'position' => 4, 'density' => fake()->randomFloat(2, 1.6, 2.0)],
            ],
            'artwork_reference' => 'ART' . fake()->numberBetween(1000, 9999),
            'artwork_files' => [
                'preview' => fake()->imageUrl(),
                'production' => fake()->url(),
                'approval' => fake()->url(),
            ],
            'machine_id' => 'MCH' . fake()->numberBetween(100, 999),
            'machine_name' => 'Printing Machine ' . fake()->numberBetween(1, 5),
            'machine_settings' => [
                'speed' => fake()->numberBetween(50, 200),
                'temperature' => fake()->numberBetween(30, 50),
                'pressure' => fake()->randomFloat(2, 2, 5),
            ],
            'printing_speed' => fake()->numberBetween(50, 200),
            'tension_settings' => [
                'unwinding' => fake()->randomFloat(2, 10, 30),
                'rewinding' => fake()->randomFloat(2, 15, 35),
            ],
            'registration_marks' => [
                'position' => fake()->randomElement(['left', 'right', 'both']),
                'type' => fake()->randomElement(['standard', 'custom']),
                'size' => fake()->randomFloat(2, 2, 5),
            ],
            'print_parameters' => [
                'anilox_volume' => fake()->randomFloat(2, 3, 8),
                'doctor_blade_angle' => fake()->numberBetween(30, 60),
                'impression_pressure' => fake()->randomFloat(2, 2, 5),
            ],
            'input_rolls' => [
                ['roll_number' => 'R1', 'weight' => fake()->randomFloat(2, 100, 200)],
                ['roll_number' => 'R2', 'weight' => fake()->randomFloat(2, 100, 200)],
            ],
            'total_input_weight' => fake()->randomFloat(2, 500, 1000),
            'planned_rolls' => $plannedRolls,
            'completed_rolls' => $completedRolls,
            'ink_consumption' => [
                ['color' => 'Cyan', 'quantity' => fake()->randomFloat(2, 2, 5), 'cost' => fake()->randomFloat(2, 100, 300)],
                ['color' => 'Magenta', 'quantity' => fake()->randomFloat(2, 2, 5), 'cost' => fake()->randomFloat(2, 100, 300)],
                ['color' => 'Yellow', 'quantity' => fake()->randomFloat(2, 2, 5), 'cost' => fake()->randomFloat(2, 100, 300)],
                ['color' => 'Black', 'quantity' => fake()->randomFloat(2, 2, 5), 'cost' => fake()->randomFloat(2, 100, 300)],
            ],
            'ink_batch_numbers' => [
                'Cyan' => 'INK' . fake()->numberBetween(1000, 9999),
                'Magenta' => 'INK' . fake()->numberBetween(1000, 9999),
                'Yellow' => 'INK' . fake()->numberBetween(1000, 9999),
                'Black' => 'INK' . fake()->numberBetween(1000, 9999),
            ],
            'total_ink_cost' => fake()->randomFloat(2, 400, 1200),
            'ink_inventory' => [
                'Cyan' => fake()->randomFloat(2, 10, 50),
                'Magenta' => fake()->randomFloat(2, 10, 50),
                'Yellow' => fake()->randomFloat(2, 10, 50),
                'Black' => fake()->randomFloat(2, 10, 50),
            ],
            'color_density_readings' => [
                ['color' => 'Cyan', 'reading' => fake()->randomFloat(2, 1.3, 1.7)],
                ['color' => 'Magenta', 'reading' => fake()->randomFloat(2, 1.3, 1.7)],
                ['color' => 'Yellow', 'reading' => fake()->randomFloat(2, 1.0, 1.4)],
                ['color' => 'Black', 'reading' => fake()->randomFloat(2, 1.6, 2.0)],
            ],
            'registration_accuracy' => [
                'x_axis' => fake()->randomFloat(3, -0.1, 0.1),
                'y_axis' => fake()->randomFloat(3, -0.1, 0.1),
            ],
            'adhesion_test_passed' => fake()->boolean(80),
            'quality_checkpoints' => [
                'color_density' => true,
                'registration' => true,
                'adhesion' => true,
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
                    'reason' => 'Color Change',
                    'duration' => fake()->numberBetween(10, 30),
                ],
            ],
            'power_consumption' => fake()->randomFloat(2, 100, 500),
            'good_output_quantity' => fake()->randomFloat(3, 800, 2000),
            'waste_quantity' => fake()->randomFloat(3, 10, 100),
            'defect_categories' => [
                'color_variation' => fake()->numberBetween(0, 5),
                'registration_error' => fake()->numberBetween(0, 3),
                'smudging' => fake()->numberBetween(0, 2),
            ],
            'production_metrics' => [
                'efficiency' => fake()->numberBetween(80, 95),
                'quality_rate' => fake()->numberBetween(90, 100),
                'availability' => fake()->numberBetween(85, 95),
            ],
            'roll_inventory' => [
                'in_production' => fake()->numberBetween(1, 3),
                'completed' => fake()->numberBetween(3, 8),
                'quality_check' => fake()->numberBetween(1, 2),
            ],
            'roll_movement' => [
                [
                    'roll_number' => 'R1',
                    'from' => 'Production',
                    'to' => 'Quality Check',
                    'timestamp' => now()->subHours(2)->toDateTimeString(),
                ],
            ],
            'operator_id' => User::factory(),
            'supervisor_id' => User::factory(),
            'operator_notes' => [
                [
                    'timestamp' => now()->subHours(3)->toDateTimeString(),
                    'note' => 'Color adjustment completed',
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
                    'type' => 'Color Density Warning',
                    'message' => 'Cyan density below threshold',
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
                    'type' => 'Registration Error',
                    'message' => 'Registration out of tolerance',
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
                    'note' => 'Process on hold due to ink shortage',
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
