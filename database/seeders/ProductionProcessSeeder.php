<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
use App\Models\MaterialAssignment;
use App\Models\MaterialMixingBatch;
use App\Models\ExtrusionProcess;
use App\Models\ExtrusionRoll;
use App\Models\PrintingProcess;
use App\Models\PrintingRoll;
use App\Models\LaminationProcess;
use App\Models\LaminationRoll;
use App\Models\SlittingProcess;
use App\Models\SlittingRoll;
use App\Models\CuttingProcess;
use App\Models\CuttingBundle;
use App\Models\PackingProcess;
use App\Models\ProductionStage;
use Illuminate\Database\Seeder;

class ProductionProcessSeeder extends Seeder
{
    public function run(): void
    {
        // Get necessary users
        $operators = User::where('role', 'operator')->get();
        $supervisors = User::where('role', 'supervisor')->get();
        $qualityInspectors = User::where('role', 'quality_inspector')->get();

        // Get branches
        $branches = Branch::all();

        // Get production stages
        $stages = ProductionStage::all();

        foreach ($stages as $stage) {
            // Create material assignments
            $materialAssignment = MaterialAssignment::factory()->create([
                'branch_id' => $stage->productionPlan->branch_id,
                'production_stage_id' => $stage->id,
            ]);

            // Create mixing batches for each material assignment
            MaterialMixingBatch::factory(3)->create([
                'material_assignment_id' => $materialAssignment->id,
                'operator_id' => $operators->random()->id,
            ]);

            // Based on stage name, create corresponding process
            switch (strtolower($stage->name)) {
                case 'extrusion':
                    $this->createExtrusionProcess($stage, $materialAssignment, $operators, $supervisors);
                    break;

                case 'printing':
                    $this->createPrintingProcess($stage, $materialAssignment, $operators, $supervisors);
                    break;

                case 'lamination':
                    $this->createLaminationProcess($stage, $materialAssignment, $operators, $supervisors);
                    break;

                case 'slitting':
                    $this->createSlittingProcess($stage, $materialAssignment, $operators, $supervisors);
                    break;

                case 'cutting':
                    $this->createCuttingProcess($stage, $materialAssignment, $operators, $supervisors);
                    break;

                case 'packing':
                    $this->createPackingProcess($stage, $materialAssignment, $operators, $supervisors);
                    break;
            }
        }
    }

    private function createExtrusionProcess($stage, $materialAssignment, $operators, $supervisors): void
    {
        $process = ExtrusionProcess::factory()->create([
            'branch_id' => $stage->productionPlan->branch_id,
            'production_stage_id' => $stage->id,
            'material_assignment_id' => $materialAssignment->id,
            'operator_id' => $operators->random()->id,
            'supervisor_id' => $supervisors->random()->id,
        ]);

        // Create rolls for the process
        ExtrusionRoll::factory(fake()->numberBetween(3, 8))->create([
            'extrusion_process_id' => $process->id,
        ]);
    }

    private function createPrintingProcess($stage, $materialAssignment, $operators, $supervisors): void
    {
        $process = PrintingProcess::factory()->create([
            'branch_id' => $stage->productionPlan->branch_id,
            'production_stage_id' => $stage->id,
            'material_assignment_id' => $materialAssignment->id,
            'operator_id' => $operators->random()->id,
            'supervisor_id' => $supervisors->random()->id,
        ]);

        // Create rolls for the process
        PrintingRoll::factory(fake()->numberBetween(3, 8))->create([
            'printing_process_id' => $process->id,
        ]);
    }

    private function createLaminationProcess($stage, $materialAssignment, $operators, $supervisors): void
    {
        $process = LaminationProcess::factory()->create([
            'branch_id' => $stage->productionPlan->branch_id,
            'production_stage_id' => $stage->id,
            'material_assignment_id' => $materialAssignment->id,
            'operator_id' => $operators->random()->id,
            'supervisor_id' => $supervisors->random()->id,
        ]);

        // Create rolls for the process
        $numberOfRolls = fake()->numberBetween(3, 8);
        for ($i = 0; $i < $numberOfRolls; $i++) {
            $roll = LaminationRoll::factory()->create([
                'lamination_process_id' => $process->id,
            ]);

            // Start curing for some rolls
            if (fake()->boolean(70)) {
                $roll->complete();

                // Complete curing for some rolls
                if (fake()->boolean(80)) {
                    $roll->completeCuring();

                    // Add quality checks for cured rolls
                    if (fake()->boolean(90)) {
                        $roll->updateQualityMeasurements([
                            'bond_strength' => fake()->numberBetween(200, 400),
                            'coating_uniformity' => [
                                'min' => fake()->randomFloat(2, 1.8, 2.0),
                                'max' => fake()->randomFloat(2, 2.2, 2.4),
                                'average' => fake()->randomFloat(2, 2.0, 2.2),
                            ],
                        ]);

                        if (fake()->boolean(80)) {
                            $roll->approve();
                        } else {
                            $roll->reject('Failed quality check due to poor bond strength');
                        }
                    }
                }
            }
        }

        // Update process progress
        $process->updateProgress(
            $numberOfRolls,
            fake()->randomFloat(3, 800, 2000),
            fake()->randomFloat(3, 10, 100)
        );
    }

    private function createSlittingProcess($stage, $materialAssignment, $operators, $supervisors): void
    {
        $process = SlittingProcess::factory()->create([
            'branch_id' => $stage->productionPlan->branch_id,
            'production_stage_id' => $stage->id,
            'material_assignment_id' => $materialAssignment->id,
            'operator_id' => $operators->random()->id,
            'supervisor_id' => $supervisors->random()->id,
        ]);

        // Create rolls for the process
        $numberOfRolls = fake()->numberBetween(3, 8);
        for ($i = 0; $i < $numberOfRolls; $i++) {
            $roll = SlittingRoll::factory()->create([
                'slitting_process_id' => $process->id,
                'slit_number' => $i + 1,
            ]);

            // Add quality checks for some rolls
            if (fake()->boolean(70)) {
                $roll->updateQualityMeasurements([
                    'width_accuracy' => fake()->numberBetween(90, 100),
                    'edge_quality' => fake()->numberBetween(85, 100),
                    'surface_quality' => fake()->numberBetween(90, 100),
                ]);

                if (fake()->boolean(80)) {
                    $roll->approve();
                } else {
                    $roll->reject('Failed quality check due to poor edge quality');
                }
            }
        }

        // Update process progress
        $process->updateProgress(
            $numberOfRolls,
            fake()->randomFloat(3, 800, 2000),
            fake()->randomFloat(3, 10, 100)
        );
    }

    private function createCuttingProcess($stage, $materialAssignment, $operators, $supervisors): void
    {
        $process = CuttingProcess::factory()->create([
            'branch_id' => $stage->productionPlan->branch_id,
            'production_stage_id' => $stage->id,
            'material_assignment_id' => $materialAssignment->id,
            'operator_id' => $operators->random()->id,
            'supervisor_id' => $supervisors->random()->id,
        ]);

        // Create bundles for the process
        CuttingBundle::factory(fake()->numberBetween(10, 20))->create([
            'cutting_process_id' => $process->id,
        ]);
    }

    private function createPackingProcess($stage, $materialAssignment, $operators, $supervisors): void
    {
        // Find the related cutting process
        $cuttingProcess = CuttingProcess::where('production_stage_id', $stage->id)->first();

        if ($cuttingProcess) {
            PackingProcess::factory()->create([
                'branch_id' => $stage->productionPlan->branch_id,
                'production_stage_id' => $stage->id,
                'cutting_process_id' => $cuttingProcess->id,
                'operator_id' => $operators->random()->id,
            ]);
        }
    }
}
