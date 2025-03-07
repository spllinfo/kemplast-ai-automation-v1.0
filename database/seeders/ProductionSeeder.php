<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Machine;
use App\Models\ProductionPlan;
use App\Models\ProductionStage;
use App\Models\ProductionBatch;
use App\Models\QualityCheck;
use App\Models\Breakdown;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create necessary users
        $admin = User::where('role', 'admin')->first();
        $operators = User::where('role', 'operator')->get();
        $qualityInspectors = User::where('role', 'quality_inspector')->get();
        $maintenanceStaff = User::where('role', 'maintenance')->get();

        // Create production plans
        $productionPlans = ProductionPlan::factory(5)->create([
            'created_by' => $admin->id,
            'approved_by' => $admin->id,
        ]);

        foreach ($productionPlans as $plan) {
            // Create stages for each plan
            $stages = [];
            for ($i = 0; $i < 3; $i++) {
                $stages[] = ProductionStage::factory()->create([
                    'production_plan_id' => $plan->id,
                    'sequence' => $i + 1,
                ]);
            }

            foreach ($stages as $stage) {
                // Create batches for each stage
                $batches = ProductionBatch::factory(2)->create([
                    'production_plan_id' => $plan->id,
                    'machine_id' => Machine::factory(),
                    'operator_id' => $operators->random()->id,
                ]);

                foreach ($batches as $batch) {
                    // Create quality checks
                    QualityCheck::factory(2)->create([
                        'checkable_type' => ProductionBatch::class,
                        'checkable_id' => $batch->id,
                        'checked_by' => $qualityInspectors->random()->id,
                    ]);

                    // Create breakdowns
                    if (fake()->boolean(30)) { // 30% chance of breakdown
                        Breakdown::factory()->create([
                            'breakdownable_type' => ProductionBatch::class,
                            'breakdownable_id' => $batch->id,
                            'reported_by' => $operators->random()->id,
                            'resolved_by' => fake()->boolean(70) ? $maintenanceStaff->random()->id : null,
                        ]);
                    }
                }

                // Create quality checks for stages
                QualityCheck::factory(1)->create([
                    'checkable_type' => ProductionStage::class,
                    'checkable_id' => $stage->id,
                    'checked_by' => $qualityInspectors->random()->id,
                ]);

                // Create breakdowns for stages
                if (fake()->boolean(20)) { // 20% chance of breakdown
                    Breakdown::factory()->create([
                        'breakdownable_type' => ProductionStage::class,
                        'breakdownable_id' => $stage->id,
                        'reported_by' => $operators->random()->id,
                        'resolved_by' => fake()->boolean(70) ? $maintenanceStaff->random()->id : null,
                    ]);
                }
            }
        }

        // Update some batches to different statuses
        ProductionBatch::inRandomOrder()->take(3)->update([
            'status' => 'completed',
            'completed_time' => now(),
        ]);

        ProductionBatch::inRandomOrder()->take(2)->update([
            'status' => 'rejected',
            'completed_time' => now(),
            'operator_notes' => 'Rejected due to material shortage',
        ]);

        // Update some stages to different statuses
        ProductionStage::inRandomOrder()->take(3)->update([
            'status' => 'completed',
            'end_time' => now(),
        ]);

        ProductionStage::inRandomOrder()->take(2)->update([
            'status' => 'failed',
            'end_time' => now(),
            'notes' => 'Failed due to quality issues',
        ]);
    }
}
