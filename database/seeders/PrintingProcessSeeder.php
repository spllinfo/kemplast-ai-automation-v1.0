<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\PrintingProcess;
use App\Models\ProductionStage;
use App\Models\User;
use Illuminate\Database\Seeder;

class PrintingProcessSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $operators = User::where('role', 'operator')->get();
        $supervisors = User::where('role', 'supervisor')->get();
        $productionStages = ProductionStage::all();

        $machineNames = ['Printer-A1', 'Printer-B1', 'Printer-C1'];
        $printingTypes = ['Flexographic', 'Rotogravure', 'Digital'];
        $colorSchemes = ['CMYK', 'Pantone', 'Custom Mix'];
        $surfaceTreatments = ['Corona', 'Plasma', 'None'];

        foreach ($branches as $branch) {
            foreach ($machineNames as $machineName) {
                // Create 3 processes for each machine in each branch
                for ($i = 1; $i <= 3; $i++) {
                    $status = fake()->randomElement(['pending', 'in_setup', 'running', 'completed']);
                    $plannedStartTime = fake()->dateTimeBetween('-1 week', 'now');
                    $actualStartTime = $status !== 'pending' ? fake()->dateTimeBetween($plannedStartTime, '+1 hour') : null;
                    $completionTime = $status === 'completed' ? fake()->dateTimeBetween($actualStartTime ?? $plannedStartTime, '+2 hours') : null;

                    // Calculate planned and completed rolls
                    $plannedRolls = fake()->numberBetween(5, 20);
                    $completedRolls = $status === 'completed' ? $plannedRolls : fake()->numberBetween(0, $plannedRolls);

                    // Generate input rolls
                    $inputRolls = [];
                    for ($j = 1; $j <= fake()->numberBetween(1, 3); $j++) {
                        $inputRolls[] = [
                            'roll_id' => 'IR-' . fake()->bothify('???###'),
                            'weight' => fake()->randomFloat(2, 100, 500),
                            'length' => fake()->randomFloat(2, 1000, 5000),
                        ];
                    }

                    // Calculate total input weight
                    $totalInputWeight = array_sum(array_column($inputRolls, 'weight'));

                    PrintingProcess::create([
                        'branch_id' => $branch->id,
                        'production_stage_id' => $productionStages->random()->id,
                        'material_assignment_id' => fake()->numberBetween(1, 10), // You might want to get this from actual material assignments

                        // Job Information
                        'job_number' => 'PRT-' . $branch->id . date('Ymd', $plannedStartTime->getTimestamp()) . '-' . str_pad($i + fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
                        'part_name' => fake()->word() . ' Film',
                        'part_id' => 'PART-' . fake()->bothify('???###'),
                        'part_description' => fake()->sentence(),
                        'customer_code' => 'CUST-' . fake()->numerify('####'),

                        // Print Specifications
                        'print_type' => fake()->randomElement(['flexo', 'roto']),
                        'number_of_colors' => fake()->numberBetween(1, 8),
                        'color_details' => json_encode(array_map(function($colorNum) {
                            return [
                                'position' => $colorNum,
                                'color' => fake()->safeColorName(),
                                'ink_code' => 'INK-' . fake()->bothify('??###'),
                                'viscosity' => fake()->randomFloat(2, 18, 25),
                                'density' => fake()->randomFloat(3, 0.8, 1.2)
                            ];
                        }, range(1, fake()->numberBetween(1, 8)))),
                        'artwork_reference' => 'ART-' . fake()->bothify('??###'),
                        'artwork_files' => json_encode([
                            'design' => 'design_' . fake()->bothify('???###') . '.ai',
                            'proof' => 'proof_' . fake()->bothify('???###') . '.pdf'
                        ]),

                        // Machine Assignment
                        'machine_id' => str_replace('-', '', $machineName),
                        'machine_name' => $machineName,
                        'machine_settings' => json_encode([
                            'speed' => fake()->numberBetween(50, 200),
                            'tension' => [
                                'unwinder' => fake()->randomFloat(2, 10, 30),
                                'rewinder' => fake()->randomFloat(2, 15, 35)
                            ],
                            'temperature' => fake()->numberBetween(50, 80),
                            'pressure' => fake()->randomFloat(2, 2, 5)
                        ]),

                        // Process Parameters
                        'printing_speed' => fake()->numberBetween(50, 200),
                        'tension_settings' => json_encode([
                            'unwinder' => fake()->randomFloat(2, 10, 30),
                            'rewinder' => fake()->randomFloat(2, 15, 35)
                        ]),
                        'registration_marks' => json_encode([
                            'type' => fake()->randomElement(['standard', 'custom']),
                            'position' => fake()->randomElement(['edge', 'center']),
                            'interval' => fake()->numberBetween(100, 500)
                        ]),
                        'print_parameters' => json_encode([
                            'anilox_volume' => fake()->randomFloat(2, 2, 8),
                            'doctor_blade_angle' => fake()->numberBetween(30, 60),
                            'impression_pressure' => fake()->randomFloat(2, 2, 5)
                        ]),

                        // Material Details
                        'input_rolls' => json_encode($inputRolls),
                        'total_input_weight' => $totalInputWeight,
                        'planned_rolls' => $plannedRolls,
                        'completed_rolls' => $completedRolls,

                        // Ink Management
                        'ink_consumption' => json_encode(array_map(function($colorNum) {
                            return [
                                'color' => fake()->safeColorName(),
                                'quantity' => fake()->randomFloat(2, 1, 5)
                            ];
                        }, range(1, fake()->numberBetween(1, 8)))),
                        'ink_batch_numbers' => json_encode(array_map(function($colorNum) {
                            return [
                                'color' => fake()->safeColorName(),
                                'batch' => 'INK-' . fake()->bothify('??###')
                            ];
                        }, range(1, fake()->numberBetween(1, 8)))),
                        'total_ink_cost' => fake()->randomFloat(2, 100, 1000),
                        'ink_inventory' => json_encode(array_map(function($colorNum) {
                            return [
                                'color' => fake()->safeColorName(),
                                'remaining' => fake()->randomFloat(2, 0, 10)
                            ];
                        }, range(1, fake()->numberBetween(1, 8)))),

                        // Quality Control
                        'color_density_readings' => json_encode(array_map(function($colorNum) {
                            return [
                                'color' => fake()->safeColorName(),
                                'target' => fake()->randomFloat(2, 1.2, 1.8),
                                'actual' => fake()->randomFloat(2, 1.0, 2.0)
                            ];
                        }, range(1, fake()->numberBetween(1, 8)))),
                        'registration_accuracy' => json_encode([
                            'x_axis' => fake()->randomFloat(3, -0.1, 0.1),
                            'y_axis' => fake()->randomFloat(3, -0.1, 0.1)
                        ]),
                        'adhesion_test_passed' => fake()->boolean(90),
                        'quality_checkpoints' => json_encode([
                            'registration' => fake()->boolean(90),
                            'color_matching' => fake()->boolean(85),
                            'adhesion' => fake()->boolean(95),
                            'drying' => fake()->boolean(90)
                        ]),
                        'quality_status' => $status === 'completed' ? 'approved' : 'pending',
                        'quality_approved' => $status === 'completed' && fake()->boolean(90),
                        'quality_notes' => fake()->sentence(),

                        // Production Metrics
                        'total_runtime_minutes' => fake()->numberBetween(120, 480),
                        'setup_time_minutes' => fake()->numberBetween(30, 120),
                        'downtime_minutes' => fake()->numberBetween(0, 60),
                        'downtime_reasons' => $status !== 'pending' ? fake()->sentence() : null,
                        'power_consumption' => fake()->randomFloat(2, 100, 500),

                        // Output Tracking
                        'good_output_quantity' => $status === 'completed' ? fake()->randomFloat(3, 100, 1000) : 0,
                        'waste_quantity' => fake()->randomFloat(3, 5, 50),
                        'defect_categories' => json_encode([
                            'misregistration' => fake()->numberBetween(0, 5),
                            'color_variation' => fake()->numberBetween(0, 3),
                            'pin_holes' => fake()->numberBetween(0, 8)
                        ]),
                        'production_metrics' => json_encode([
                            'efficiency' => fake()->randomFloat(2, 75, 95),
                            'waste_percentage' => fake()->randomFloat(2, 1, 5),
                            'average_speed' => fake()->numberBetween(50, 200)
                        ]),

                        // Roll Tracking
                        'roll_inventory' => json_encode(array_map(function($rollNum) {
                            return [
                                'roll_id' => 'R' . str_pad($rollNum, 3, '0', STR_PAD_LEFT),
                                'status' => fake()->randomElement(['in_production', 'quality_check', 'ready', 'dispatched']),
                                'location' => fake()->randomElement(['Production Floor', 'QC Area', 'Warehouse'])
                            ];
                        }, range(1, $completedRolls))),
                        'roll_movement' => json_encode(array_map(function($rollNum) {
                            return [
                                'roll_id' => 'R' . str_pad($rollNum, 3, '0', STR_PAD_LEFT),
                                'movements' => [
                                    [
                                        'from' => 'Production',
                                        'to' => 'QC',
                                        'timestamp' => fake()->dateTimeThisMonth()->format('Y-m-d H:i:s')
                                    ]
                                ]
                            ];
                        }, range(1, $completedRolls))),

                        // Operator Management
                        'operator_id' => $operators->random()->id,
                        'supervisor_id' => $supervisors->random()->id,
                        'operator_notes' => json_encode([
                            'setup_observations' => fake()->sentence(),
                            'quality_issues' => fake()->sentence(),
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
                            'color_warnings' => fake()->numberBetween(0, 3),
                            'registration_alerts' => fake()->numberBetween(0, 2),
                            'substrate_issues' => fake()->numberBetween(0, 2)
                        ]),
                        'maintenance_alerts' => json_encode([
                            'screen_pack_change' => fake()->boolean(20),
                            'die_cleaning' => fake()->boolean(15),
                            'bearing_check' => fake()->boolean(10)
                        ]),
                        'quality_alerts' => json_encode([
                            'color_variation' => fake()->boolean(15),
                            'registration_drift' => fake()->boolean(10),
                            'adhesion_issues' => fake()->boolean(5)
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
