<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();

        if ($branches->isEmpty()) {
            info('No branches found. Creating a default branch.');
            $branch = Branch::create([
                'name' => 'Main Branch',
                'code' => 'BR001',
                'type' => 'headquarters',
                'status' => 'active',
                'address' => fake()->address(),
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'country' => 'India',
                'pincode' => '400001',
                'phone' => '+91' . fake()->numerify('##########'),
                'email' => 'hq@kemplast.com',
                'website' => 'https://kemplast.com',
                'gst_number' => '27AAAAA0000A1Z5',
                'pan_number' => 'AAAAA0000A',
                'tin_number' => 'MH01234567890',
                'cst_number' => 'MH01234567890',
                'contact_person' => fake()->name(),
                'contact_phone' => '+91' . fake()->numerify('##########'),
                'contact_email' => 'contact@kemplast.com'
            ]);
            $branches = Branch::all();
        }

        $mainDepartments = [
            'Production',
            'Engineering',
            'Operations',
            'Administration',
            'Sales'
        ];

        foreach ($mainDepartments as $dept) {
            for ($i = 0; $i < 3; $i++) {
                try {
                    $department = Department::create([
                        'main_department' => $dept,
                        'branch_id' => $branches->random()->id,
                        'name' => $dept . ' ' . fake()->words(2, true),
                        'code' => strtoupper(substr($dept, 0, 3) . fake()->unique()->numerify('###')),
                        'description' => fake()->sentence(),
                        'head_of_department' => fake()->name(),
                        'head_count' => fake()->numberBetween(5, 50),
                        'budget' => fake()->randomFloat(2, 10000, 1000000),
                        'location' => fake()->word(),
                        'status' => 'active',
                        'parent_id' => null
                    ]);

                    info("Created main department: {$department->name}");
                } catch (\Exception $e) {
                    Log::error("Failed to create department: {$dept}", [
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }

        // Create some sub-departments
        $departments = Department::whereNull('parent_id')->get();
        foreach ($departments as $department) {
            try {
                $subDepartment = Department::create([
                    'main_department' => $department->main_department,
                    'parent_id' => $department->id,
                    'branch_id' => $department->branch_id,
                    'name' => $department->name . ' - ' . fake()->words(1, true),
                    'code' => $department->code . '-' . fake()->unique()->numerify('##'),
                    'description' => fake()->sentence(),
                    'head_of_department' => fake()->name(),
                    'head_count' => fake()->numberBetween(2, 20),
                    'budget' => fake()->randomFloat(2, 5000, 500000),
                    'location' => $department->location,
                    'status' => 'active'
                ]);

                info("Created sub-department: {$subDepartment->name}");
            } catch (\Exception $e) {
                Log::error("Failed to create sub-department for {$department->name}", [
                    'error' => $e->getMessage()
                ]);
            }
        }

        info('DepartmentSeeder: Created departments successfully');
    }
}
