<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\ProductionStage;
use App\Models\MaterialAssignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaminationProcessFactory extends Factory
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
            'job_number' => 'LAM' . fake()->unique()->numberBetween(1000, 9999),
            'part_name' => fake()->word(),
            'part_id' => 'P' . fake()->unique()->numberBetween(1000, 9999),
            'part_description' => fake()->sentence(),
            'customer_code' => 'CUST' . fake()->numberBetween(100, 999),
            'lamination_type' => fake()->randomElement(['solvent_based', 'solventless', 'water_based', 'thermal']),
            'number_of_layers' => fake()->numberBetween(2, 4),
            'layer_specifications' => [
                [
                    'layer' => 1,
                    'material' => 'BOPP',
                    'thickness' => fake()->randomFloat(2, 12, 25),
                    'width' => fake()->randomFloat(2, 100, 1000),
                ],
                [
                    'layer' => 2,
                    'material' => 'MET-PET',
                    'thickness' => fake()->randomFloat(2, 12, 25),
                    'width' => fake()->randomFloat(2, 100, 1000),
                ],
            ],
            'adhesive_gsm' => fake()->randomFloat(2, 2, 5),
            'adhesive_type' => fake()->randomElement(['PU', 'Acrylic', 'EVA']),
            'adhesive_details' => [
                'brand' => fake()->company(),
                'grade' => fake()->randomElement(['A', 'B', 'C']),
                'viscosity' => fake()->randomFloat(2, 100, 500),
                'solid_content' => fake()->randomFloat(2, 40, 60),
            ],
            'machine_id' => 'MCH' . fake()->numberBetween(100, 999),
            'machine_name' => 'Lamination Machine ' . fake()->numberBetween(1, 5),
            'machine_settings' => [
                'speed' => fake()->numberBetween(50, 200),
                'temperature' => fake()->numberBetween(30, 50),
                'pressure' => fake()->randomFloat(2, 2, 5),
            ],
            'machine_speed' => fake()->numberBetween(50, 200),
            'nip_pressure' => fake()->randomFloat(2, 2, 5),
            'temperature' => fake()->randomFloat(2, 30, 50),
            'tension_settings' => [
                'unwinding' => fake()->randomFloat(2, 10, 30),
                'rewinding' => fake()->randomFloat(2, 15, 35),
            ],
            'coating_weight' => fake()->randomFloat(2, 2, 5),
            'input_rolls' => [
                ['roll_number' => 'R1', 'weight' => fake()->randomFloat(2, 100, 200)],
                ['roll_number' => 'R2', 'weight' => fake()->randomFloat(2, 100, 200)],
            ],
            'total_input_weight' => fake()->randomFloat(2, 500, 1000),
            'planned_rolls' => $plannedRolls,
            'completed_rolls' => $completedRolls,
            'adhesive_batch_numbers' => [
                'part_a' => 'ADH-A' . fake()->numberBetween(1000, 9999),
                'part_b' => 'ADH-B' . fake()->numberBetween(1000, 9999),
            ],
            'adhesive_consumption' => fake()->randomFloat(2, 10, 50),
            'adhesive_mixing_ratio' => [
                'part_a' => 100,
                'part_b' => fake()->numberBetween(5, 10),
            ],
            'pot_life_tracking' => [
                [
                    'batch' => 'MIX1',
                    'mixed_at' => now()->subHours(2)->toDateTimeString(),
                    'expires_at' => now()->addHours(4)->toDateTimeString(),
                ],
            ],
            'bond_strength_tests' => [
                [
                    'sample' => 1,
                    'value' => fake()->randomFloat(2, 200, 400),
                    'unit' => 'gf/25mm',
                    'tested_at' => now()->toDateTimeString(),
                ],
            ],
            'delamination_tests' => [
                [
                    'sample' => 1,
                    'result' => fake()->boolean(80),
                    'tested_at' => now()->toDateTimeString(),
                ],
            ],
            'appearance_check' => fake()->boolean(90),
            'quality_checkpoints' => [
                'bond_strength' => true,
                'delamination' => true,
                'appearance' => true,
                'coating_uniformity' => true,
            ],
            'quality_status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'quality_approved' => fake()->boolean(80),
            'quality_notes' => fake()->optional()->paragraph(),
            'total_runtime_minutes' => fake()->numberBetween(120, 480),
            'setup_time_minutes' => fake()->numberBetween(30, 90),
            'downtime_minutes' => fake()->numberBetween(0, 60),
            'downtime_categories' => [
                [
                    'reason' => 'Adhesive Change',
                    'duration' => fake()->numberBetween(10, 30),
                ],
            ],
            'power_consumption' => fake()->randomFloat(2, 100, 500),
            'good_output_quantity' => fake()->randomFloat(3, 800, 2000),
            'waste_quantity' => fake()->randomFloat(3, 10, 100),
            'defect_categories' => [
                'delamination' => fake()->numberBetween(0, 5),
                'wrinkles' => fake()->numberBetween(0, 3),
                'bubbles' => fake()->numberBetween(0, 2),
            ],
            'curing_time_tracking' => [
                [
                    'batch' => 'B1',
                    'start_time' => now()->subHours(24)->toDateTimeString(),
                    'end_time' => now()->toDateTimeString(),
                ],
            ],
            'status' => $endTime ? 'completed' : fake()->randomElement(['pending', 'in_setup', 'running', 'paused']),
            'humidity' => fake()->randomFloat(2, 40, 60),
            'room_temperature' => fake()->randomFloat(2, 20, 30),
            'environmental_readings' => [
                [
                    'timestamp' => now()->toDateTimeString(),
                    'humidity' => fake()->randomFloat(2, 40, 60),
                    'temperature' => fake()->randomFloat(2, 20, 30),
                ],
            ],
            'operator_id' => User::factory(),
            'supervisor_id' => User::factory(),
            'operator_notes' => [
                [
                    'timestamp' => now()->subHours(3)->toDateTimeString(),
                    'note' => 'Adhesive mixing completed',
                ],
            ],
            'shift_details' => [
                'shift' => fake()->randomElement(['Morning', 'Afternoon', 'Night']),
                'start_time' => '08:00',
                'end_time' => '16:00',
            ],
            'process_alerts' => [
                [
                    'type' => 'Pot Life Warning',
                    'message' => 'Adhesive mix approaching expiry',
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
                    'type' => 'Bond Strength',
                    'message' => 'Bond strength below threshold',
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
                    'note' => 'Process on hold due to adhesive shortage',
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
