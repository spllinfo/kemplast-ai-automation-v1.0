<?php

namespace Database\Factories;

use App\Models\ProductionPlan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ProductionStageFactory extends Factory
{
    public function definition(): array
    {
        $plannedDuration = fake()->numberBetween(30, 480); // 30 minutes to 8 hours
        $startTime = Carbon::instance(fake()->dateTimeBetween('-1 month', 'now'));
        $endTime = fake()->boolean(70) ? Carbon::instance(fake()->dateTimeBetween($startTime, '+1 month')) : null;
        $actualDuration = $endTime && $startTime->lte($endTime) ? $endTime->diffInMinutes($startTime) : null;
        $plannedQuantity = fake()->numberBetween(100, 1000);
        $actualQuantity = $endTime ? fake()->numberBetween($plannedQuantity * 0.8, $plannedQuantity * 1.2) : 0;
        $rejectedQuantity = $actualQuantity > 0 ? fake()->numberBetween(0, $actualQuantity * 0.1) : 0;

        return [
            'stage_code' => 'STG' . fake()->unique()->numberBetween(1000, 9999),
            'production_plan_id' => ProductionPlan::factory(),
            'name' => fake()->randomElement([
                'Material Preparation',
                'Extrusion',
                'Printing',
                'Lamination',
                'Cutting',
                'Sealing',
                'Quality Control',
                'Packing',
                'Labeling',
                'Final Inspection'
            ]),
            'description' => fake()->paragraph(),
            'sequence' => fake()->numberBetween(1, 10),
            'status' => $endTime ? 'completed' : fake()->randomElement(['pending', 'in_progress']),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'planned_duration' => $plannedDuration,
            'actual_duration' => $actualDuration,
            'planned_quantity' => $plannedQuantity,
            'actual_quantity' => $actualQuantity,
            'rejected_quantity' => $rejectedQuantity,
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
            'machine_requirements' => [
                'machines' => fake()->randomElements([
                    'Extrusion Machine',
                    'Printing Machine',
                    'Cutting Machine',
                    'Sealing Machine',
                    'Packing Machine',
                ], fake()->numberBetween(1, 3)),
                'operators' => fake()->numberBetween(2, 10),
                'maintenance_schedule' => 'weekly',
            ],
            'operator_requirements' => [
                'skills' => fake()->randomElements([
                    'Machine Operation',
                    'Quality Control',
                    'Maintenance',
                    'Safety Procedures',
                ], fake()->numberBetween(1, 3)),
                'certifications' => fake()->randomElements([
                    'ISO 9001',
                    'Safety Training',
                    'Machine Operation',
                ], fake()->numberBetween(1, 2)),
                'experience_years' => fake()->numberBetween(1, 10),
            ],
            'material_requirements' => [
                'materials' => fake()->randomElements([
                    'Raw Material A',
                    'Raw Material B',
                    'Packaging Material',
                    'Labels',
                ], fake()->numberBetween(1, 3)),
                'quantities' => fake()->numberBetween(100, 1000),
                'specifications' => [
                    'grade' => fake()->randomElement(['A', 'B', 'C']),
                    'color' => fake()->randomElement(['red', 'blue', 'green']),
                    'size' => fake()->randomElement(['small', 'medium', 'large']),
                ],
            ],
            'notes' => fake()->optional()->paragraph(),
            'metadata' => [
                'efficiency_rate' => $actualDuration ? ($actualQuantity / $actualDuration) * 60 : null,
                'quality_score' => fake()->randomFloat(1, 70, 100),
                'downtime_minutes' => fake()->numberBetween(0, 120),
                'maintenance_required' => fake()->boolean(30),
                'special_instructions' => fake()->optional()->paragraph(),
            ],
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'start_time' => null,
            'end_time' => null,
            'actual_duration' => null,
            'actual_quantity' => 0,
            'rejected_quantity' => 0,
        ]);
    }

    public function inProgress(): static
    {
        $startTime = Carbon::instance(fake()->dateTimeBetween('-1 month', 'now'));
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'start_time' => $startTime,
            'end_time' => null,
            'actual_duration' => null,
            'actual_quantity' => fake()->numberBetween(0, $attributes['planned_quantity']),
            'rejected_quantity' => fake()->numberBetween(0, 10),
        ]);
    }

    public function completed(): static
    {
        $startTime = Carbon::instance(fake()->dateTimeBetween('-2 days', '-1 day'));
        $endTime = Carbon::instance(fake()->dateTimeBetween('-1 day', 'now'));
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'start_time' => $startTime,
            'end_time' => $endTime,
            'actual_duration' => $endTime->diffInMinutes($startTime),
            'actual_quantity' => fake()->numberBetween($attributes['planned_quantity'] * 0.8, $attributes['planned_quantity'] * 1.2),
            'rejected_quantity' => fake()->numberBetween(0, 50),
        ]);
    }

    public function failed(): static
    {
        $startTime = Carbon::instance(fake()->dateTimeBetween('-2 days', '-1 day'));
        $endTime = Carbon::instance(fake()->dateTimeBetween('-1 day', 'now'));
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
            'start_time' => $startTime,
            'end_time' => $endTime,
            'actual_duration' => $endTime->diffInMinutes($startTime),
            'actual_quantity' => fake()->numberBetween(0, $attributes['planned_quantity'] * 0.5),
            'rejected_quantity' => fake()->numberBetween(50, 100),
            'notes' => fake()->paragraph(),
        ]);
    }
}
