<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\SlittingProcess;
use App\Models\ProductionStage;
use App\Models\User;
use Illuminate\Database\Seeder;

class SlittingProcessSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $operators = User::where('role', 'operator')->get();
        $supervisors = User::where('role', 'supervisor')->get();
        $productionStages = ProductionStage::all();

        $machineNames = ['Slitter-A1', 'Slitter-B1', 'Slitter-C1'];
        $slittingTypes = ['Razor', 'Shear', 'Crush Cut', 'Score'];
        $materialTypes = ['PE Film', 'PP Film', 'PET Film', 'BOPP Film', 'Laminated Film'];

        foreach ($branches as $branch) {
            foreach ($machineNames as $machineName) {
                // Create 3 processes for each machine in each branch
                for ($i = 1; $i <= 3; $i++) {
                    $status = fake()->randomElement(['pending', 'in_setup', 'running', 'completed']);
                    $plannedStartTime = fake()->dateTimeBetween('-1 week', '+1 week');
                    $slittingType = fake()->randomElement($slittingTypes);
                    $numberOfSlits = fake()->numberBetween(2, 8);

                    SlittingProcess::create([
                        'branch_id' => $branch->id,
                        'production_stage_id' => $productionStages->random()->id,

                        // Job Information
                        'job_number' => 'SLT-' . $branch->id . date('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT),
                        'customer_name' => fake()->company(),
                        'job_description' => fake()->sentence(),
                        'product_code' => 'PRD-' . fake()->bothify('??###'),

                        // Process Details
                        'slitting_type' => $slittingType,
                        'material_type' => fake()->randomElement($materialTypes),
                        'material_thickness' => fake()->randomFloat(3, 12, 100),
                        'parent_roll_width' => fake()->randomFloat(2, 800, 1600),
                        'number_of_slits' => $numberOfSlits,

                        // Slit Specifications
                        'slit_widths' => json_encode(array_map(function($slit) {
                            return [
                                'position' => $slit,
                                'width' => fake()->randomFloat(2, 100, 300),
                                'tolerance' => '±1mm'
                            ];
                        }, range(1, $numberOfSlits))),
                        'trim_width' => fake()->randomFloat(2, 10, 30),
                        'minimum_slit_width' => fake()->randomFloat(2, 50, 100),

                        // Machine Settings
                        'machine_id' => str_replace('-', '', $machineName),
                        'machine_name' => $machineName,
                        'machine_speed' => fake()->numberBetween(100, 300),
                        'blade_settings' => json_encode([
                            'blade_type' => fake()->randomElement(['Razor', 'Circular', 'Crush Cut']),
                            'blade_diameter' => fake()->randomFloat(2, 100, 200),
                            'blade_overlap' => fake()->randomFloat(2, 0.5, 2)
                        ]),
                        'tension_settings' => json_encode([
                            'unwind_tension' => fake()->randomFloat(2, 10, 30),
                            'rewind_tension' => fake()->randomFloat(2, 15, 35),
                            'web_tension' => fake()->randomFloat(2, 20, 40)
                        ]),

                        // Quality Control
                        'quality_parameters' => json_encode([
                            'edge_quality' => 'Clean cut, no burrs',
                            'width_tolerance' => '±1mm',
                            'tension_uniformity' => '±5%'
                        ]),
                        'quality_checks' => json_encode([
                            'width_measurement' => fake()->boolean(95),
                            'edge_inspection' => fake()->boolean(90),
                            'tension_check' => fake()->boolean(85)
                        ]),
                        'defect_tracking' => json_encode([
                            'edge_burrs' => fake()->numberBetween(0, 5),
                            'width_variation' => fake()->numberBetween(0, 3),
                            'telescoping' => fake()->numberBetween(0, 2)
                        ]),

                        // Production Metrics
                        'planned_quantity' => fake()->numberBetween(5000, 20000),
                        'completed_quantity' => $status === 'completed' ?
                            fake()->numberBetween(5000, 20000) :
                            fake()->numberBetween(0, 5000),
                        'waste_quantity' => fake()->numberBetween(100, 500),
                        'setup_time_minutes' => fake()->numberBetween(20, 60),
                        'production_time_minutes' => fake()->numberBetween(60, 240),
                        'downtime_minutes' => fake()->numberBetween(0, 30),

                        // Roll Management
                        'parent_rolls' => json_encode(array_map(function($roll) {
                            return [
                                'roll_number' => 'PR-' . fake()->bothify('??###'),
                                'length' => fake()->randomFloat(2, 1000, 5000),
                                'weight' => fake()->randomFloat(2, 100, 500)
                            ];
                        }, range(1, fake()->numberBetween(1, 3)))),
                        'finished_rolls' => json_encode(array_map(function($roll) {
                            return [
                                'roll_number' => 'FR-' . fake()->bothify('??###'),
                                'position' => fake()->numberBetween(1, 8),
                                'width' => fake()->randomFloat(2, 100, 300),
                                'length' => fake()->randomFloat(2, 1000, 5000),
                                'weight' => fake()->randomFloat(2, 20, 100)
                            ];
                        }, range(1, fake()->numberBetween(5, 15)))),

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

                        // Process Status and Monitoring
                        'status' => $status,
                        'process_alerts' => json_encode([
                            'blade_warnings' => fake()->numberBetween(0, 2),
                            'tension_alerts' => fake()->numberBetween(0, 2),
                            'quality_alerts' => fake()->numberBetween(0, 3)
                        ]),
                        'maintenance_logs' => json_encode([
                            'blade_change' => fake()->dateTime(),
                            'tension_calibration' => fake()->dateTime(),
                            'bearing_inspection' => fake()->dateTime()
                        ]),

                        // Timestamps
                        'planned_start_time' => $plannedStartTime,
                        'actual_start_time' => $status !== 'pending' ? fake()->dateTimeBetween($plannedStartTime, 'now') : null,
                        'completion_time' => $status === 'completed' ? fake()->dateTimeBetween($plannedStartTime, 'now') : null,
                    ]);
                }
            }
        }
    }
}
