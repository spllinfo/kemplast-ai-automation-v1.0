<?php

namespace Database\Seeders;

use App\Models\MaintenanceSchedule;
use App\Models\Machine;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class MaintenanceScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $machines = Machine::all();
        $technicians = Staff::where('designation', 'Technician')->get();

        foreach ($machines as $machine) {
            MaintenanceSchedule::factory()->create([
                'machine_id' => $machine->id,
                'technician_id' => $technicians->random()->id
            ]);
        }
    }
}