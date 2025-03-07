<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\ProductionStage;
use App\Models\MaterialAssignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtrusionProcessFactory extends Factory
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
            'job_number' => 'EXT' . fake()->unique()->numberBetween(1000, 9999),
            'part_name' => fake()->word(),
            'part_description' => fake()->sentence(),
            'customer_code' => 'CUST' . fake()->numberBetween(100, 999),
            'ld_ratio' => fake()->randomFloat(2, 20, 40),
            'lld_ratio' => fake()->randomFloat(2, 20, 40),
            'hd_ratio' => fake()->randomFloat(2, 20, 40),
            'rd_ratio' => fake()->randomFloat(2, 5, 10),
            'total_material_weight' => fake()->randomFloat(2, 100, 1000),
            'film_thickness' => fake()->randomFloat(3, 0.01, 0.5),
            'film_width' => fake()->randomFloat(2, 100, 2000),
            'film_weight' => fake()->randomFloat(2, 10, 100),
            'line_speed' => fake()->numberBetween(10, 50),
            'temperature_zones' => [
                'zone1' => fake()->numberBetween(150, 200),
                'zone2' => fake()->numberBetween(160, 210),
                'zone3' => fake()->numberBetween(170, 220),
                'zone4' => fake()->numberBetween(180, 230),
            ],
            'melt_temperature' => fake()->randomFloat(2, 180, 220),
            'die_temperature' => fake()->randomFloat(2, 190, 230),
            'temperature_history' => [
                [
                    'timestamp' => now()->subHours(2)->toDateTimeString(),
                    'readings' => [
                        'zone1' => fake()->numberBetween(150, 200),
                        'zone2' => fake()->numberBetween(160, 210),
                        'zone3' => fake()->numberBetween(170, 220),
                        'zone4' => fake()->numberBetween(180, 230),
                    ]
                ]
            ],
            'machine_id' => 'MCH' . fake()->numberBetween(100, 999),
            'machine_name' => 'Extrusion Machine ' . fake()->numberBetween(1, 5),
            'screw_speed' => fake()->randomFloat(2, 20, 60),
            'pressure' => fake()->randomFloat(2, 50, 200),
            'blow_up_ratio' => fake()->randomFloat(2, 1.5, 3.0),
            'frost_line_height' => fake()->randomFloat(2, 50, 150),
            'machine_parameters' => [
                'air_pressure' => fake()->randomFloat(2, 5, 10),
                'cooling_temperature' => fake()->numberBetween(15, 25),
                'nip_pressure' => fake()->randomFloat(2, 2, 5),
            ],
            'planned_rolls' => $plannedRolls,
            'completed_rolls' => $completedRolls,
            'target_roll_weight' => fake()->randomFloat(2, 50, 200),
            'roll_details' => [
                [
                    'roll_number' => 'R1',
                    'weight' => fake()->randomFloat(2, 40, 60),
                    'status' => 'completed',
                ],
                [
                    'roll_number' => 'R2',
                    'weight' => fake()->randomFloat(2, 40, 60),
                    'status' => 'in_progress',
                ],
            ],
            'thickness_variance' => fake()->randomFloat(2, 0, 5),
            'quality_measurements' => [
                'thickness_uniformity' => fake()->numberBetween(90, 100),
                'surface_quality' => fake()->numberBetween(85, 100),
                'transparency' => fake()->numberBetween(80, 100),
            ],
            'quality_checkpoints' => [
                'thickness_check' => true,
                'width_check' => true,
                'surface_inspection' => true,
            ],
            'quality_approved' => fake()->boolean(80),
            'quality_status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'total_runtime_minutes' => fake()->numberBetween(120, 480),
            'downtime_minutes' => fake()->numberBetween(0, 60),
            'downtime_reasons' => [
                [
                    'reason' => 'Material Change',
                    'duration' => fake()->numberBetween(10, 30),
                ],
            ],
            'power_consumption' => fake()->randomFloat(2, 100, 500),
            'production_metrics' => [
                'efficiency' => fake()->numberBetween(80, 95),
                'quality_rate' => fake()->numberBetween(90, 100),
                'availability' => fake()->numberBetween(85, 95),
            ],
            'good_output_quantity' => fake()->randomFloat(3, 800, 2000),
            'waste_quantity' => fake()->randomFloat(3, 10, 100),
            'defect_details' => [
                'thickness_variation' => fake()->numberBetween(0, 5),
                'surface_defects' => fake()->numberBetween(0, 3),
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
                    'note' => 'Material change completed',
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
                    'type' => 'Temperature Warning',
                    'message' => 'Zone 2 temperature high',
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
                    'type' => 'Thickness Variation',
                    'message' => 'Thickness variation above threshold',
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
                    'note' => 'Process on hold due to material shortage',
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
