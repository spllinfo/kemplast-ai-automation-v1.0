<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Part;
use App\Models\ProductionPlan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductionPlanSeeder extends Seeder
{
    public function run(): void
    {
        // Get all required data
        $branches = Branch::all();
        $customers = Customer::all();
        $departments = Department::all();
        $users = User::all();
        $parts = Part::all();

        // Ensure we have all required data
        if ($branches->isEmpty()) {
            throw new \RuntimeException('No branches found. Please run BranchSeeder first.');
        }
        if ($customers->isEmpty()) {
            throw new \RuntimeException('No customers found. Please run CustomerSeeder first.');
        }
        if ($departments->isEmpty()) {
            throw new \RuntimeException('No departments found. Please run DepartmentSeeder first.');
        }

        // Get admin user, create one if it doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@kemplast.net'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Get managers, create some if none exist
        $managers = User::where('role', 'manager')->get();
        if ($managers->isEmpty()) {
            // Create at least one manager
            $manager = User::create([
                'name' => 'Manager User',
                'email' => 'manager@kemplast.net',
                'password' => bcrypt('password'),
                'role' => 'manager',
                'status' => 'active',
                'email_verified_at' => now(),
            ]);
            $managers = collect([$manager]);
        }

        $productionLines = ['Line A', 'Line B', 'Line C', 'Line D'];
        $locations = ['Main Floor', 'Secondary Floor', 'Warehouse A', 'Warehouse B'];

        foreach ($branches as $branch) {
            // Create 5 production plans for each branch
            for ($i = 1; $i <= 5; $i++) {
                $type = fake()->randomElement(['regular', 'rush', 'prototype', 'custom']);
                $status = fake()->randomElement(['draft', 'pending', 'approved', 'in_progress', 'completed']);

                // Generate dates in a logical sequence
                $baseDate = fake()->dateTimeBetween('-1 month', '+2 months');
                $plannedStartDate = $baseDate;
                $plannedEndDate = fake()->dateTimeBetween($plannedStartDate, date('Y-m-d', strtotime('+3 months', $baseDate->getTimestamp())));
                $actualStartDate = $status !== 'draft' ? fake()->dateTimeBetween($plannedStartDate, $plannedEndDate) : null;
                $actualEndDate = $status === 'completed' ? fake()->dateTimeBetween($actualStartDate ?? $plannedStartDate, $plannedEndDate) : null;

                $totalQuantity = fake()->numberBetween(1000, 10000);
                $completedQuantity = $status === 'completed' ? $totalQuantity : fake()->numberBetween(0, $totalQuantity);
                $rejectedQuantity = fake()->numberBetween(0, $totalQuantity - $completedQuantity);
                $estimatedHours = fake()->numberBetween(24, 240);
                $actualHours = $status === 'completed' ? fake()->numberBetween($estimatedHours - 24, $estimatedHours + 48) : 0;

                // Calculate costs
                $materialCost = fake()->randomFloat(2, 5000, 50000);
                $laborCost = fake()->randomFloat(2, 2000, 20000);
                $overheadCost = fake()->randomFloat(2, 1000, 10000);
                $estimatedCost = $materialCost + $laborCost + $overheadCost;
                $budget = $estimatedCost * fake()->randomFloat(2, 1.1, 1.3); // Budget is 10-30% higher than estimated cost

                $projectManager = $managers->random();
                $approver = $status !== 'draft' ? $admin : null;

                ProductionPlan::create([
                    'uuid' => Str::uuid(),
                    'plan_code' => 'PP-' . $branch->id . '-' . date('Y') . str_pad($i, 4, '0', STR_PAD_LEFT),
                    'title' => fake()->catchPhrase() . ' Production Plan',
                    'description' => fake()->paragraph(),

                    // Planning Details
                    'type' => $type,
                    'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),
                    'status' => $status,

                    // Dates
                    'planned_start_date' => $plannedStartDate,
                    'planned_end_date' => $plannedEndDate,
                    'actual_start_date' => $actualStartDate,
                    'actual_end_date' => $actualEndDate,

                    // Financial tracking
                    'estimated_cost' => $estimatedCost,
                    'actual_cost' => $status === 'completed' ? fake()->randomFloat(2, $estimatedCost * 0.8, $estimatedCost * 1.2) : 0,
                    'budget' => $budget,
                    'material_cost' => $materialCost,
                    'labor_cost' => $laborCost,
                    'overhead_cost' => $overheadCost,

                    // Production metrics
                    'total_quantity' => $totalQuantity,
                    'completed_quantity' => $completedQuantity,
                    'rejected_quantity' => $rejectedQuantity,
                    'estimated_hours' => $estimatedHours,
                    'actual_hours' => $actualHours,
                    'completion_percentage' => ($completedQuantity / $totalQuantity) * 100,
                    'efficiency_rate' => $status === 'completed' ? fake()->randomFloat(2, 75, 98) : null,

                    // Location and assignment
                    'production_line' => fake()->randomElement($productionLines),
                    'location' => fake()->randomElement($locations),
                    'branch_id' => $branch->id,
                    'department_id' => $departments->random()->id,

                    // Stakeholders
                    'created_by' => $admin->id,
                    'approved_by' => $approver?->id,
                    'customer_id' => $customers->random()->id,
                    'project_manager_id' => $projectManager->id,

                    // Additional data
                    'quality_parameters' => json_encode([
                        'thickness_tolerance' => '±5%',
                        'width_tolerance' => '±2mm',
                        'print_quality' => 'Grade A',
                        'seal_strength' => '>3.5 N/15mm'
                    ]),
                    'machine_requirements' => json_encode([
                        'extruder' => ['capacity' => '100kg/hr', 'type' => 'Twin Screw'],
                        'printer' => ['colors' => 6, 'speed' => '120m/min'],
                        'slitter' => ['width' => '1500mm', 'speed' => '200m/min']
                    ]),
                    'material_requirements' => json_encode([
                        'raw_materials' => [
                            ['type' => 'LDPE', 'quantity' => '500kg'],
                            ['type' => 'LLDPE', 'quantity' => '300kg'],
                            ['type' => 'MB', 'quantity' => '50kg']
                        ],
                        'packaging' => [
                            ['type' => 'Boxes', 'quantity' => '100'],
                            ['type' => 'Labels', 'quantity' => '1000']
                        ]
                    ]),
                    'metadata' => json_encode([
                        'shift' => fake()->randomElement(['Morning', 'Afternoon', 'Night']),
                        'priority_reason' => $type === 'rush' ? 'Customer Urgent Requirement' : null,
                        'special_instructions' => fake()->boolean(30) ? fake()->sentence() : null
                    ]),
                    'notes' => fake()->boolean(70) ? fake()->paragraph() : null,
                ]);
            }
        }
    }
}
