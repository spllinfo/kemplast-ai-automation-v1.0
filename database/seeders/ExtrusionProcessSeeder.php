<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\ExtrusionProcess;
use App\Models\MaterialAssignment;
use App\Models\ProductionPlan;
use App\Models\ProductionStage;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExtrusionProcessSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        if ($branches->isEmpty()) {
            throw new \RuntimeException('No branches found. Please run BranchSeeder first.');
        }

        // Get or create operators
        $operators = User::where('role', 'operator')->get();
        if ($operators->isEmpty()) {
            info('No operators found. Creating default operators.');
            for ($i = 1; $i <= 3; $i++) {
                $operator = User::create([
                    'name' => "Operator {$i}",
                    'email' => "operator{$i}@kemplast.net",
                    'password' => bcrypt('password'),
                    'mobile' => '+91' . fake()->numerify('##########'),
                    'designation' => 'Machine Operator',
                    'role' => 'operator',
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]);
                $operators->push($operator);
            }
        }

        // Get or create supervisors
        $supervisors = User::where('role', 'supervisor')->get();
        if ($supervisors->isEmpty()) {
            info('No supervisors found. Creating default supervisors.');
            for ($i = 1; $i <= 2; $i++) {
                $supervisor = User::create([
                    'name' => "Supervisor {$i}",
                    'email' => "supervisor{$i}@kemplast.net",
                    'password' => bcrypt('password'),
                    'mobile' => '+91' . fake()->numerify('##########'),
                    'designation' => 'Production Supervisor',
                    'role' => 'supervisor',
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]);
                $supervisors->push($supervisor);
            }
        }

        // Get production stages and material assignments
        $productionStages = ProductionStage::all();
        if ($productionStages->isEmpty()) {
            throw new \RuntimeException('No production stages found. Please ensure production stages are created.');
        }

        $materialAssignments = MaterialAssignment::all();
        if ($materialAssignments->isEmpty()) {
            throw new \RuntimeException('No material assignments found. Please ensure material assignments are created.');
        }

        $machineNames = ['Extruder-A1', 'Extruder-B1', 'Extruder-C1', 'Extruder-D1'];

        foreach ($branches as $branch) {
            foreach ($machineNames as $machineName) {
                // Create 3 processes for each machine in each branch
                for ($i = 1; $i <= 3; $i++) {
                    $status = fake()->randomElement(['pending', 'in_setup', 'running', 'completed']);
                    $plannedStartTime = fake()->dateTimeBetween('-1 week', 'now');
                    $actualStartTime = $status !== 'pending' ? fake()->dateTimeBetween($plannedStartTime, '+1 hour') : null;
                    $completionTime = $status === 'completed' ? fake()->dateTimeBetween($actualStartTime ?? $plannedStartTime, '+2 hours') : null;

                    // Calculate material ratios that sum to 100%
                    $ldRatio = fake()->numberBetween(20, 40);
                    $lldRatio = fake()->numberBetween(20, 40);
                    $hdRatio = fake()->numberBetween(10, 20);
                    $rdRatio = 100 - ($ldRatio + $lldRatio + $hdRatio);

                    $totalMaterialWeight = fake()->numberBetween(500, 2000);
                    $plannedRolls = fake()->numberBetween(5, 20);
                    $completedRolls = $status === 'completed' ? $plannedRolls : fake()->numberBetween(0, $plannedRolls);

                    ExtrusionProcess::create([
                        'branch_id' => $branch->id,
                        'production_stage_id' => $productionStages->random()->id,
                        'material_assignment_id' => $materialAssignments->random()->id,

                        // Job Information
                        'job_number' => 'EXT-' . $branch->id . date('Ymd', $plannedStartTime->getTimestamp()) . '-' . str_pad($i + fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
                        'part_name' => fake()->word() . ' Film',
                        'part_description' => fake()->sentence(),
                        'customer_code' => 'CUST-' . fake()->numerify('####'),

                        // Material Specifications
                        'ld_ratio' => $ldRatio,
                        'lld_ratio' => $lldRatio,
                        'hd_ratio' => $hdRatio,
                        'rd_ratio' => $rdRatio,
                        'total_material_weight' => $totalMaterialWeight,

                        // Process Parameters
                        'film_thickness' => fake()->randomFloat(3, 20, 200),
                        'film_width' => fake()->randomFloat(2, 500, 2000),
                        'film_weight' => fake()->randomFloat(2, 10, 50),
                        'line_speed' => fake()->numberBetween(20, 100),

                        // Temperature Control
                        'temperature_zones' => json_encode([
                            'zone1' => fake()->numberBetween(160, 180),
                            'zone2' => fake()->numberBetween(170, 190),
                            'zone3' => fake()->numberBetween(180, 200),
                            'zone4' => fake()->numberBetween(190, 210),
                        ]),
                        'melt_temperature' => fake()->randomFloat(2, 180, 220),
                        'die_temperature' => fake()->randomFloat(2, 190, 230),
                        'temperature_history' => json_encode([
                            ['time' => '08:00', 'zone1' => 175, 'zone2' => 185, 'zone3' => 195, 'zone4' => 205],
                            ['time' => '10:00', 'zone1' => 176, 'zone2' => 186, 'zone3' => 196, 'zone4' => 206],
                            ['time' => '12:00', 'zone1' => 174, 'zone2' => 184, 'zone3' => 194, 'zone4' => 204],
                        ]),

                        // Machine Settings
                        'machine_id' => str_replace('-', '', $machineName),
                        'machine_name' => $machineName,
                        'screw_speed' => fake()->randomFloat(2, 40, 100),
                        'pressure' => fake()->randomFloat(2, 2000, 4000),
                        'blow_up_ratio' => fake()->randomFloat(2, 2, 4),
                        'frost_line_height' => fake()->randomFloat(2, 500, 1000),
                        'machine_parameters' => json_encode([
                            'extruder_load' => fake()->numberBetween(60, 90) . '%',
                            'screen_pack_pressure' => fake()->numberBetween(1000, 3000) . ' PSI',
                            'cooling_air_temperature' => fake()->numberBetween(18, 25) . '°C'
                        ]),

                        // Output Management
                        'planned_rolls' => $plannedRolls,
                        'completed_rolls' => $completedRolls,
                        'target_roll_weight' => fake()->randomFloat(2, 40, 100),
                        'roll_details' => json_encode(array_map(function($rollNum) {
                            return [
                                'roll_number' => 'R' . str_pad($rollNum, 3, '0', STR_PAD_LEFT),
                                'weight' => fake()->randomFloat(2, 40, 100),
                                'length' => fake()->randomFloat(2, 1000, 5000),
                                'quality_grade' => fake()->randomElement(['A', 'B', 'C'])
                            ];
                        }, range(1, $completedRolls))),

                        // Quality Control
                        'thickness_variance' => fake()->randomFloat(2, 0, 5),
                        'quality_measurements' => json_encode([
                            'tensile_strength' => fake()->randomFloat(2, 20, 30) . ' MPa',
                            'elongation' => fake()->randomFloat(2, 200, 600) . '%',
                            'dart_impact' => fake()->randomFloat(2, 100, 300) . ' g'
                        ]),
                        'quality_checkpoints' => json_encode([
                            'visual_inspection' => fake()->boolean(80),
                            'dimension_check' => fake()->boolean(90),
                            'weight_check' => fake()->boolean(95)
                        ]),
                        'quality_approved' => $status === 'completed' ? fake()->boolean(90) : false,
                        'quality_status' => $status === 'completed' ? 'approved' : 'pending',

                        // Production Metrics
                        'total_runtime_minutes' => fake()->numberBetween(120, 720),
                        'downtime_minutes' => fake()->numberBetween(0, 120),
                        'downtime_reasons' => fake()->boolean(30) ? json_encode([
                            'material_change' => fake()->numberBetween(10, 30),
                            'mechanical_issue' => fake()->numberBetween(15, 45),
                            'quality_adjustment' => fake()->numberBetween(5, 20)
                        ]) : null,
                        'power_consumption' => fake()->randomFloat(2, 100, 500),
                        'production_metrics' => json_encode([
                            'efficiency' => fake()->randomFloat(2, 75, 95),
                            'waste_percentage' => fake()->randomFloat(2, 1, 5),
                            'average_speed' => fake()->numberBetween(20, 100)
                        ]),

                        // Output Tracking
                        'good_output_quantity' => $completedRolls * fake()->randomFloat(2, 40, 100),
                        'waste_quantity' => fake()->randomFloat(3, 5, 50),
                        'defect_details' => json_encode([
                            'gels' => fake()->numberBetween(0, 10),
                            'thickness_variation' => fake()->numberBetween(0, 5),
                            'die_lines' => fake()->numberBetween(0, 3)
                        ]),

                        // Roll Tracking
                        'roll_inventory' => json_encode(array_map(function($rollNum) {
                            return [
                                'roll_id' => 'R' . str_pad($rollNum, 3, '0', STR_PAD_LEFT),
                                'status' => fake()->randomElement(['in_production', 'quality_check', 'ready', 'dispatched']),
                                'location' => fake()->randomElement(['Production Floor', 'QC Area', 'Warehouse'])
                            ];
                        }, range(1, $completedRolls))),

                        // Operator Management
                        'operator_id' => $operators->random()->id,
                        'supervisor_id' => $supervisors->random()->id,
                        'operator_notes' => json_encode([
                            'setup_notes' => fake()->sentence(),
                            'quality_observations' => fake()->sentence(),
                            'maintenance_notes' => fake()->sentence()
                        ]),
                        'shift_details' => json_encode([
                            'shift' => fake()->randomElement(['Morning', 'Afternoon', 'Night']),
                            'start_time' => fake()->time(),
                            'end_time' => fake()->time()
                        ]),

                        // Process Status
                        'status' => $status,

                        // Monitoring and Alerts
                        'process_alerts' => json_encode([
                            'temperature_warnings' => fake()->numberBetween(0, 3),
                            'pressure_alerts' => fake()->numberBetween(0, 2),
                            'quality_notifications' => fake()->numberBetween(0, 4)
                        ]),
                        'maintenance_alerts' => json_encode([
                            'screen_pack_change' => fake()->boolean(20),
                            'die_cleaning' => fake()->boolean(15),
                            'bearing_check' => fake()->boolean(10)
                        ]),

                        // Timestamps
                        'planned_start_time' => $plannedStartTime,
                        'actual_start_time' => $actualStartTime,
                        'completion_time' => $completionTime,
                    ]);
                }
            }
        }
    }
}
