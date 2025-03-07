<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\LaminationProcess;
use App\Models\ProductionStage;
use App\Models\User;
use Illuminate\Database\Seeder;

class LaminationProcessSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $operators = User::where('role', 'operator')->get();
        $supervisors = User::where('role', 'supervisor')->get();
        $productionStages = ProductionStage::all();

        $machineNames = ['Laminator-A1', 'Laminator-B1', 'Laminator-C1'];
        $laminationTypes = ['Solvent Based', 'Solventless', 'Water Based', 'Thermal'];
        $materialTypes = ['PET', 'BOPP', 'PE', 'Aluminum Foil', 'Paper'];

        foreach ($branches as $branch) {
            foreach ($machineNames as $machineName) {
                // Create 3 processes for each machine in each branch
                for ($i = 1; $i <= 3; $i++) {
                    $status = fake()->randomElement(['pending', 'in_setup', 'running', 'completed']);
                    $plannedStartTime = fake()->dateTimeBetween('-1 week', '+1 week');
                    $laminationType = fake()->randomElement($laminationTypes);

                    LaminationProcess::create([
                        'branch_id' => $branch->id,
                        'production_stage_id' => $productionStages->random()->id,

                        // Job Information
                        'job_number' => 'LAM-' . $branch->id . date('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT),
                        'customer_name' => fake()->company(),
                        'job_description' => fake()->sentence(),
                        'product_code' => 'PRD-' . fake()->bothify('??###'),

                        // Process Details
                        'lamination_type' => $laminationType,
                        'number_of_layers' => fake()->numberBetween(2, 4),
                        'substrate_details' => json_encode(array_map(function($layer) use ($materialTypes) {
                            return [
                                'layer' => $layer,
                                'material' => fake()->randomElement($materialTypes),
                                'thickness' => fake()->randomFloat(2, 8, 50),
                                'width' => fake()->randomFloat(2, 300, 1200)
                            ];
                        }, range(1, fake()->numberBetween(2, 4)))),

                        // Machine Settings
                        'machine_id' => str_replace('-', '', $machineName),
                        'machine_name' => $machineName,
                        'machine_speed' => fake()->numberBetween(50, 150),
                        'temperature_settings' => json_encode([
                            'primary' => fake()->numberBetween(80, 120),
                            'secondary' => fake()->numberBetween(70, 100),
                            'nip_roller' => fake()->numberBetween(40, 60)
                        ]),
                        'pressure_settings' => json_encode([
                            'nip_pressure' => fake()->randomFloat(2, 2, 6),
                            'air_pressure' => fake()->randomFloat(2, 4, 8)
                        ]),

                        // Adhesive Details
                        'adhesive_type' => $laminationType === 'Solventless' ?
                            fake()->randomElement(['PU', 'Acrylic']) :
                            fake()->randomElement(['Solvent Based', 'Water Based']),
                        'adhesive_ratio' => json_encode([
                            'part_a' => fake()->numberBetween(100, 150),
                            'part_b' => 100,
                            'dilution' => fake()->numberBetween(0, 20)
                        ]),
                        'adhesive_properties' => json_encode([
                            'viscosity' => fake()->randomFloat(2, 18, 25),
                            'solid_content' => fake()->randomFloat(2, 45, 55),
                            'pot_life_hours' => fake()->numberBetween(4, 8)
                        ]),

                        // Quality Control
                        'quality_parameters' => json_encode([
                            'bond_strength' => '>250 g/25mm',
                            'appearance' => 'No visual defects',
                            'cure_time' => '24-48 hours'
                        ]),
                        'quality_checks' => json_encode([
                            'visual_inspection' => fake()->boolean(95),
                            'bond_strength_test' => fake()->boolean(90),
                            'delamination_test' => fake()->boolean(85)
                        ]),
                        'defect_tracking' => json_encode([
                            'bubbles' => fake()->numberBetween(0, 5),
                            'wrinkles' => fake()->numberBetween(0, 3),
                            'adhesive_spots' => fake()->numberBetween(0, 4)
                        ]),

                        // Production Metrics
                        'planned_quantity' => fake()->numberBetween(3000, 15000),
                        'completed_quantity' => $status === 'completed' ?
                            fake()->numberBetween(3000, 15000) :
                            fake()->numberBetween(0, 3000),
                        'waste_quantity' => fake()->numberBetween(50, 300),
                        'setup_time_minutes' => fake()->numberBetween(30, 90),
                        'production_time_minutes' => fake()->numberBetween(120, 360),
                        'downtime_minutes' => fake()->numberBetween(0, 45),

                        // Curing Details
                        'curing_conditions' => json_encode([
                            'temperature' => fake()->numberBetween(25, 35),
                            'humidity' => fake()->numberBetween(45, 65),
                            'duration_hours' => fake()->numberBetween(24, 48)
                        ]),
                        'curing_status' => $status === 'completed' ?
                            fake()->randomElement(['in_process', 'completed']) :
                            'not_started',

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
                            'temperature_warnings' => fake()->numberBetween(0, 2),
                            'adhesive_alerts' => fake()->numberBetween(0, 2),
                            'tension_alerts' => fake()->numberBetween(0, 3)
                        ]),
                        'maintenance_logs' => json_encode([
                            'roller_cleaning' => fake()->dateTime(),
                            'adhesive_system_check' => fake()->dateTime(),
                            'tension_calibration' => fake()->dateTime()
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
