<?php

namespace Database\Seeders;

use App\Models\PrintingRoll;
use App\Models\PrintingProcess;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class PrintingRollSeeder extends Seeder
{
    public function run(): void
    {
        // Get all printing processes and QC staff
        $printingProcesses = PrintingProcess::all();
        $qcStaff = Staff::where('department', 'Quality')->get();

        foreach ($printingProcesses as $process) {
            // Create rolls based on the process status
            $rollsToCreate = match($process->status) {
                'completed' => $process->planned_rolls,
                'in_progress' => fake()->numberBetween(1, $process->planned_rolls - 1),
                default => 0
            };

            // Create the rolls
            for ($i = 0; $i < $rollsToCreate; $i++) {
                PrintingRoll::factory()->create([
                    'printing_process_id' => $process->id,
                    'roll_number' => $process->job_number . '-R' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                    'created_by' => $qcStaff->random()->id,
                    
                    // Set quality status based on position in batch
                    'quality_status' => $i < ($rollsToCreate - 2) ? 'approved' : 
                        ($i === ($rollsToCreate - 2) ? 'rejected' : 'pending'),
                ]);
            }
        }
    }
}