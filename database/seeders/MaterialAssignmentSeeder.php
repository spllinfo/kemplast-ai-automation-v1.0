<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\MaterialAssignment;
use App\Models\Material;
use App\Models\ProductionStage;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaterialAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        if ($branches->isEmpty()) {
            throw new \RuntimeException('No branches found. Please run BranchSeeder first.');
        }

        $productionStages = ProductionStage::all();
        if ($productionStages->isEmpty()) {
            throw new \RuntimeException('No production stages found. Please run ProductionStageSeeder first.');
        }

        $materials = Material::all();
        if ($materials->isEmpty()) {
            throw new \RuntimeException('No materials found. Please run MaterialSeeder first.');
        }

        $users = User::whereIn('role', ['operator', 'supervisor'])->get();
        if ($users->isEmpty()) {
            throw new \RuntimeException('No operators or supervisors found. Please run UserSeeder first.');
        }

        foreach ($branches as $branch) {
            // Create 5 material assignments for each branch
            for ($i = 1; $i <= 5; $i++) {
                $status = fake()->randomElement(['pending', 'in_mixing', 'mixed', 'in_process', 'completed', 'rejected']);
                $mixingDate = fake()->dateTimeBetween('-1 week', 'now');

                // Calculate material ratios that sum to 100%
                $ldRatio = fake()->numberBetween(20, 40);
                $lldRatio = fake()->numberBetween(20, 40);
                $hdRatio = fake()->numberBetween(10, 20);
                $rdRatio = 100 - ($ldRatio + $lldRatio + $hdRatio);

                // Calculate weights based on ratios
                $totalWeight = fake()->numberBetween(500, 2000);
                $ldWeight = ($ldRatio / 100) * $totalWeight;
                $lldWeight = ($lldRatio / 100) * $totalWeight;
                $hdWeight = ($hdRatio / 100) * $totalWeight;
                $rdWeight = ($rdRatio / 100) * $totalWeight;

                MaterialAssignment::create([
                    'branch_id' => $branch->id,
                    'production_stage_id' => $productionStages->random()->id,
                    'assignment_number' => 'MA-' . $branch->code . '-' . date('Ymd', $mixingDate->getTimestamp()) . str_pad($i, 3, '0', STR_PAD_LEFT),

                    // Material Composition
                    'ld_details' => json_encode([
                        'material_id' => $materials->where('material_type', 'LD')->random()->id,
                        'ratio' => $ldRatio,
                        'weight' => $ldWeight,
                        'used_weight' => $status === 'completed' ? $ldWeight : 0,
                    ]),
                    'lld_details' => json_encode([
                        'material_id' => $materials->where('material_type', 'LLD')->random()->id,
                        'ratio' => $lldRatio,
                        'weight' => $lldWeight,
                        'used_weight' => $status === 'completed' ? $lldWeight : 0,
                    ]),
                    'hd_details' => json_encode([
                        'material_id' => $materials->where('material_type', 'HD')->random()->id,
                        'ratio' => $hdRatio,
                        'weight' => $hdWeight,
                        'used_weight' => $status === 'completed' ? $hdWeight : 0,
                    ]),
                    'rd_details' => json_encode([
                        'material_id' => $materials->where('material_type', 'RD')->random()->id,
                        'ratio' => $rdRatio,
                        'weight' => $rdWeight,
                        'used_weight' => $status === 'completed' ? $rdWeight : 0,
                    ]),

                    // Product Specifications
                    'thickness' => fake()->randomFloat(3, 0.01, 0.5),
                    'width' => fake()->randomFloat(2, 10, 200),
                    'height' => fake()->randomFloat(2, 10, 200),
                    'target_weight' => fake()->randomFloat(2, 100, 1000),

                    // Batch Information
                    'batch_number' => 'B' . fake()->numerify('#####'),
                    'mixing_date' => $mixingDate,
                    'mixing_operator' => fake()->name(),
                    'status' => $status,

                    // Quality Parameters
                    'mixing_parameters' => json_encode([
                        'temperature' => fake()->numberBetween(150, 200) . '°C',
                        'humidity' => fake()->numberBetween(40, 60) . '%',
                        'mixing_time' => fake()->numberBetween(20, 60) . ' minutes',
                    ]),
                    'quality_checked' => $status === 'completed',
                    'quality_results' => $status === 'completed' ? json_encode([
                        'visual_inspection' => 'passed',
                        'density_test' => fake()->randomFloat(3, 0.91, 0.97) . ' g/cm³',
                        'melt_flow_index' => fake()->randomFloat(2, 1.5, 3.5) . ' g/10min',
                    ]) : null,

                    // Material Tracking
                    'total_assigned_weight' => $totalWeight,
                    'total_consumed_weight' => $status === 'completed' ? $totalWeight * 0.98 : 0,
                    'total_waste' => $status === 'completed' ? $totalWeight * 0.02 : 0,
                    'total_returned' => 0,

                    // Batch Processing
                    'number_of_batches' => fake()->numberBetween(1, 5),
                    'batch_details' => json_encode(array_map(function($batchNum) {
                        return [
                            'batch_id' => 'MB' . str_pad($batchNum, 3, '0', STR_PAD_LEFT),
                            'start_time' => fake()->time(),
                            'end_time' => fake()->time(),
                            'operator' => fake()->name(),
                        ];
                    }, range(1, fake()->numberBetween(1, 5)))),
                    'batch_status' => json_encode([
                        'completed_batches' => fake()->numberBetween(1, 5),
                        'in_progress_batches' => 0,
                        'pending_batches' => 0,
                    ]),

                    // Documentation
                    'mixing_instructions' => json_encode([
                        'sequence' => [
                            'Add LDPE and mix for 5 minutes',
                            'Add LLDPE and mix for 10 minutes',
                            'Add additives and mix for 15 minutes',
                            'Final mixing for 10 minutes',
                        ],
                        'temperature_control' => 'Maintain between 160-180°C',
                        'quality_checks' => ['Visual inspection', 'Density test', 'MFI test'],
                    ]),
                    'special_notes' => fake()->sentence(),
                    'operator_notes' => json_encode([
                        'setup_notes' => fake()->sentence(),
                        'process_notes' => fake()->sentence(),
                        'quality_notes' => fake()->sentence(),
                    ]),

                    // Monitoring and Alerts
                    'process_alerts' => json_encode([
                        'temperature_warnings' => fake()->numberBetween(0, 3),
                        'mixing_time_alerts' => fake()->numberBetween(0, 2),
                        'quality_notifications' => fake()->numberBetween(0, 4),
                    ]),
                    'quality_alerts' => json_encode([
                        'density_variations' => fake()->boolean(),
                        'contamination_detected' => fake()->boolean(),
                        'color_inconsistency' => fake()->boolean(),
                    ]),
                    'inventory_alerts' => json_encode([
                        'low_stock_warnings' => fake()->boolean(),
                        'material_expiry_alerts' => fake()->boolean(),
                        'reorder_notifications' => fake()->boolean(),
                    ]),

                    // Approval and Verification
                    'assigned_by' => $users->where('role', 'supervisor')->random()->id,
                    'verified_by' => $status === 'completed' ? $users->where('role', 'supervisor')->random()->id : null,
                    'verified_at' => $status === 'completed' ? fake()->dateTimeBetween($mixingDate, 'now') : null,
                ]);
            }
        }

        info('MaterialAssignmentSeeder: Created material assignments successfully');
    }
}
