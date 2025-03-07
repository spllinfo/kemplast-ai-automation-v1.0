<?php

namespace Database\Seeders;

use App\Models\Machine;
use App\Models\Branch;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();

        foreach ($branches as $branch) {
            // Create active machines
            Machine::factory(3)->active()->create([
                'branch_id' => $branch->id,
            ]);

            // Create maintenance machines
            Machine::factory(1)->maintenance()->create([
                'branch_id' => $branch->id,
            ]);
        }
    }
}
