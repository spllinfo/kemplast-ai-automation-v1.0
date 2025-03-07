<?php

namespace Database\Seeders;

use App\Models\Shift;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        $supervisors = Staff::where('designation', 'Supervisor')->get();

        foreach (['Morning', 'Afternoon', 'Night'] as $shiftName) {
            Shift::factory()->create([
                'name' => $shiftName . ' Shift',
                'supervisor_id' => $supervisors->random()->id
            ]);
        }
    }
}