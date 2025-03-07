<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\ProductionStage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialAssignmentFactory extends Factory
{
    public function definition(): array
    {
        $totalWeight = fake()->numberBetween(100, 1000);
        $consumedWeight = fake()->boolean(70) ? fake()->numberBetween($totalWeight * 0.8, $totalWeight * 1.2) : 0;
        $wasteWeight = $consumedWeight > 0 ? fake()->numberBetween(0, $consumedWeight * 0.1) : 0;
        $returnedWeight = $consumedWeight > 0 ? fake()->numberBetween(0, $consumedWeight * 0.05) : 0;

        return [
            'branch_id' => Branch::factory(),
            'production_stage_id' => ProductionStage::factory(),
            'assignment_number' => 'MA' . fake()->unique()->numberBetween(1000, 9999),
            'ld_details' => [
                'material_id' => fake()->numberBetween(1, 100),
                'ratio' => fake()->numberBetween(20, 40),
                'weight' => fake()->numberBetween(10, 50),
                'used_weight' => fake()->numberBetween(5, 45),
            ],
            'lld_details' => [
                'material_id' => fake()->numberBetween(1, 100),
                'ratio' => fake()->numberBetween(20, 40),
                'weight' => fake()->numberBetween(10, 50),
                'used_weight' => fake()->numberBetween(5, 45),
            ],
            'hd_details' => [
                'material_id' => fake()->numberBetween(1, 100),
                'ratio' => fake()->numberBetween(20, 40),
                'weight' => fake()->numberBetween(10, 50),
                'used_weight' => fake()->numberBetween(5, 45),
            ],
            'rd_details' => [
                'material_id' => fake()->numberBetween(1, 100),
                'ratio' => fake()->numberBetween(20, 40),
                'weight' => fake()->numberBetween(10, 50),
                'used_weight' => fake()->numberBetween(5, 45),
            ],
            'thickness' => fake()->randomFloat(3, 0.1, 5),
            'width' => fake()->randomFloat(2, 10, 100),
            'height' => fake()->randomFloat(2, 10, 100),
            'target_weight' => fake()->randomFloat(2, 100, 1000),
            'batch_number' => 'BATCH' . fake()->unique()->numberBetween(1000, 9999),
            'mixing_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'mixing_operator' => fake()->name(),
            'status' => fake()->randomElement(['pending', 'in_mixing', 'mixed', 'in_process', 'completed', 'rejected']),
            'mixing_parameters' => [
                'temperature' => fake()->numberBetween(150, 250),
                'humidity' => fake()->numberBetween(40, 60),
                'mixing_time' => fake()->numberBetween(30, 120),
            ],
            'quality_checked' => fake()->boolean(),
            'quality_results' => [
                'appearance' => fake()->randomElement(['good', 'fair', 'poor']),
                'uniformity' => fake()->numberBetween(70, 100),
                'contamination' => fake()->boolean(20),
            ],
            'total_assigned_weight' => $totalWeight,
            'total_consumed_weight' => $consumedWeight,
            'total_waste' => $wasteWeight,
            'total_returned' => $returnedWeight,
            'number_of_batches' => fake()->numberBetween(1, 5),
            'batch_details' => [
                [
                    'batch_number' => 'B1',
                    'weight' => fake()->numberBetween(100, 500),
                    'status' => 'completed',
                ],
                [
                    'batch_number' => 'B2',
                    'weight' => fake()->numberBetween(100, 500),
                    'status' => 'in_process',
                ],
            ],
            'batch_status' => [
                'completed' => fake()->numberBetween(0, 3),
                'in_process' => fake()->numberBetween(0, 2),
                'pending' => fake()->numberBetween(0, 2),
            ],
            'mixing_instructions' => [
                'sequence' => ['LD', 'LLD', 'HD', 'RD'],
                'temperature_range' => ['min' => 150, 'max' => 250],
                'special_instructions' => fake()->sentences(2),
            ],
            'special_notes' => fake()->optional()->paragraph(),
            'operator_notes' => [
                'shift_notes' => fake()->optional()->sentence(),
                'quality_concerns' => fake()->optional()->sentence(),
            ],
            'process_alerts' => [
                'temperature_warnings' => fake()->numberBetween(0, 3),
                'quality_warnings' => fake()->numberBetween(0, 2),
            ],
            'quality_alerts' => [
                'contamination_detected' => fake()->boolean(20),
                'uniformity_issues' => fake()->boolean(15),
            ],
            'inventory_alerts' => [
                'low_stock_warnings' => fake()->numberBetween(0, 2),
                'material_shortages' => fake()->boolean(10),
            ],
            'assigned_by' => User::factory(),
            'verified_by' => fake()->boolean(70) ? User::factory() : null,
            'verified_at' => fake()->boolean(70) ? fake()->dateTimeBetween('-1 month', 'now') : null,
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'mixing_date' => null,
            'total_consumed_weight' => 0,
            'total_waste' => 0,
            'total_returned' => 0,
        ]);
    }

    public function inMixing(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_mixing',
            'mixing_date' => now(),
            'total_consumed_weight' => 0,
            'total_waste' => 0,
            'total_returned' => 0,
        ]);
    }

    public function mixed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'mixed',
            'mixing_date' => fake()->dateTimeBetween('-1 week', 'now'),
            'total_consumed_weight' => fake()->numberBetween($attributes['total_assigned_weight'] * 0.8, $attributes['total_assigned_weight'] * 1.2),
            'total_waste' => fake()->numberBetween(0, $attributes['total_assigned_weight'] * 0.1),
            'total_returned' => fake()->numberBetween(0, $attributes['total_assigned_weight'] * 0.05),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'mixing_date' => fake()->dateTimeBetween('-1 month', '-1 week'),
            'quality_checked' => true,
            'verified_by' => User::factory(),
            'verified_at' => fake()->dateTimeBetween('-1 week', 'now'),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'quality_checked' => true,
            'quality_results' => [
                'appearance' => 'poor',
                'uniformity' => fake()->numberBetween(40, 69),
                'contamination' => true,
            ],
            'special_notes' => 'Rejected due to quality issues',
        ]);
    }
}
