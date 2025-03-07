<?php

namespace Database\Factories;

use App\Models\ProductionPlan;
use App\Models\ProductionBatch;
use App\Models\Part;
use App\Models\Machine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionBatchFactory extends Factory
{
    protected $model = ProductionBatch::class;

    public function definition(): array
    {
        $startTime = Carbon::instance(fake()->dateTimeBetween('-1 month', 'now'));
        $endTime = fake()->boolean(80) ? Carbon::instance(fake()->dateTimeBetween($startTime, '+1 week')) : null;
        $plannedQuantity = fake()->numberBetween(500, 2000);
        $producedQuantity = $endTime ? fake()->numberBetween($plannedQuantity * 0.8, $plannedQuantity * 1.2) : 0;
        $rejectedQuantity = $producedQuantity > 0 ? fake()->numberBetween(0, $producedQuantity * 0.1) : 0;

        return [
            'uuid' => fake()->uuid(),
            'batch_number' => fake()->unique()->regexify('[A-Z]{2}[0-9]{6}'),
            'production_plan_id' => ProductionPlan::factory(),
            'part_id' => Part::factory(),
            'version' => 1,
            'status' => fake()->randomElement(['pending', 'material_assigned', 'in_production', 'quality_check', 'completed', 'rejected']),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
            'planned_quantity' => $plannedQuantity,
            'produced_quantity' => $producedQuantity,
            'rejected_quantity' => $rejectedQuantity,
            'material_cost' => fake()->randomFloat(2, 1000, 10000),
            'labor_cost' => fake()->randomFloat(2, 500, 5000),
            'overhead_cost' => fake()->randomFloat(2, 200, 2000),
            'scheduled_start_time' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'actual_start_time' => $startTime,
            'completed_time' => $endTime,
            'efficiency_rate' => $endTime ? fake()->randomFloat(2, 70, 95) : null,
            'total_runtime_minutes' => $endTime ? fake()->numberBetween(120, 480) : 0,
            'total_downtime_minutes' => $endTime ? fake()->numberBetween(0, 60) : 0,
            'quality_parameters' => [
                'tolerance' => fake()->randomFloat(2, 0.1, 1.0),
                'defect_rate' => fake()->randomFloat(2, 0, 5),
                'inspection_points' => fake()->numberBetween(3, 10),
                'acceptance_criteria' => [
                    'dimension' => fake()->randomFloat(2, 10, 100),
                    'weight' => fake()->randomFloat(2, 1, 10),
                    'strength' => fake()->randomFloat(2, 1, 10),
                ],
            ],
            'machine_settings' => [
                'temperature' => fake()->numberBetween(150, 250),
                'pressure' => fake()->numberBetween(50, 150),
                'speed' => fake()->numberBetween(100, 500),
                'other_parameters' => [
                    'humidity' => fake()->numberBetween(40, 60),
                    'cooling_rate' => fake()->numberBetween(20, 40),
                ],
            ],
            'process_parameters' => [
                'setup_time' => fake()->numberBetween(30, 90),
                'cycle_time' => fake()->numberBetween(60, 180),
                'changeover_time' => fake()->numberBetween(15, 45),
            ],
            'machine_id' => Machine::factory(),
            'operator_id' => User::factory()->create(['role' => 'operator'])->id,
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'actual_start_time' => null,
            'completed_time' => null,
            'produced_quantity' => 0,
            'rejected_quantity' => 0,
            'efficiency_rate' => null,
            'total_runtime_minutes' => 0,
            'total_downtime_minutes' => 0,
        ]);
    }

    public function materialAssigned(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'material_assigned',
            'actual_start_time' => null,
            'completed_time' => null,
            'produced_quantity' => 0,
            'rejected_quantity' => 0,
        ]);
    }

    public function inProduction(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_production',
            'actual_start_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'completed_time' => null,
            'produced_quantity' => fake()->numberBetween(0, $attributes['planned_quantity']),
            'rejected_quantity' => fake()->numberBetween(0, 10),
        ]);
    }

    public function inQualityCheck(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'quality_check',
            'actual_start_time' => fake()->dateTimeBetween('-2 days', '-1 day'),
            'completed_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'produced_quantity' => $attributes['planned_quantity'],
            'rejected_quantity' => fake()->numberBetween(0, $attributes['planned_quantity'] * 0.1),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'actual_start_time' => fake()->dateTimeBetween('-2 days', '-1 day'),
            'completed_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'produced_quantity' => fake()->numberBetween($attributes['planned_quantity'] * 0.8, $attributes['planned_quantity'] * 1.2),
            'rejected_quantity' => fake()->numberBetween(0, $attributes['planned_quantity'] * 0.1),
            'efficiency_rate' => fake()->randomFloat(2, 70, 95),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'actual_start_time' => fake()->dateTimeBetween('-2 days', '-1 day'),
            'completed_time' => fake()->dateTimeBetween('-1 day', 'now'),
            'produced_quantity' => fake()->numberBetween(0, $attributes['planned_quantity'] * 0.5),
            'rejected_quantity' => fake()->numberBetween($attributes['planned_quantity'] * 0.5, $attributes['planned_quantity']),
            'quality_parameters' => array_merge($attributes['quality_parameters'] ?? [], [
                'rejection_reason' => fake()->randomElement([
                    'Quality standards not met',
                    'Material defects',
                    'Process failure',
                    'Equipment malfunction'
                ])
            ]),
        ]);
    }

    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => fake()->randomElement(['high', 'urgent']),
        ]);
    }
}
