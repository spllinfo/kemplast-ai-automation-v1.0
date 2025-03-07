<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionPlanFactory extends Factory
{
    public function definition(): array
    {
        $plannedStartDate = fake()->dateTimeBetween('now', '+3 months');
        $plannedEndDate = fake()->dateTimeBetween($plannedStartDate, '+6 months');

        return [
            'uuid' => fake()->uuid(),
            'plan_code' => 'PLN' . fake()->unique()->numberBetween(1000, 9999),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'type' => fake()->randomElement(['regular', 'rush', 'prototype', 'custom']),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
            'status' => fake()->randomElement(['draft', 'pending', 'approved', 'in_progress', 'completed', 'cancelled', 'on_hold']),
            'planned_start_date' => $plannedStartDate,
            'planned_end_date' => $plannedEndDate,
            'actual_start_date' => null,
            'actual_end_date' => null,
            'estimated_cost' => fake()->numberBetween(10000, 1000000),
            'actual_cost' => 0,
            'budget' => fake()->numberBetween(10000, 1000000),
            'material_cost' => 0,
            'labor_cost' => 0,
            'overhead_cost' => 0,
            'total_quantity' => fake()->numberBetween(100, 10000),
            'completed_quantity' => 0,
            'rejected_quantity' => 0,
            'estimated_hours' => fake()->numberBetween(100, 1000),
            'actual_hours' => 0,
            'completion_percentage' => 0,
            'efficiency_rate' => null,
            'production_line' => fake()->randomElement(['Line A', 'Line B', 'Line C', 'Line D']),
            'location' => fake()->randomElement(['Factory 1', 'Factory 2', 'Factory 3']),
            'branch_id' => Branch::factory(),
            'department_id' => fake()->numberBetween(1, 5),
            'created_by' => User::factory(),
            'approved_by' => null,
            'customer_id' => Customer::factory(),
            'project_manager_id' => User::factory(),
            'quality_parameters' => json_encode([
                'tolerance' => fake()->numberBetween(0.1, 1.0),
                'defect_rate' => fake()->numberBetween(0, 5),
                'inspection_points' => fake()->numberBetween(3, 10)
            ]),
            'machine_requirements' => json_encode([
                'machines' => fake()->randomElements(['Machine A', 'Machine B', 'Machine C'], 2),
                'operators' => fake()->numberBetween(2, 10),
                'maintenance_schedule' => 'weekly'
            ]),
            'material_requirements' => json_encode([
                'materials' => fake()->randomElements(['Material X', 'Material Y', 'Material Z'], 3),
                'quantities' => fake()->numberBetween(100, 1000)
            ]),
            'metadata' => json_encode([
                'notes' => fake()->paragraph(),
                'attachments' => [],
                'tags' => fake()->randomElements(['urgent', 'high-priority', 'standard'], 2)
            ])
        ];
    }
}
