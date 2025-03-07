<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        return [
            'branch_id' => Branch::factory(),
            'name' => fake()->unique()->words(2, true),
            'code' => strtoupper(fake()->unique()->bothify('???###')),
            'description' => fake()->sentence(),
            'main_department' => fake()->randomElement([
                'Production',
                'Engineering',
                'Operations',
                'Administration',
                'Sales'
            ]),
            'head_of_department' => fake()->name(),
            'head_count' => fake()->numberBetween(5, 50),
            'budget' => fake()->randomFloat(2, 10000, 1000000),
            'location' => fake()->word(),
            'status' => 'active',
            'parent_id' => null,
        ];
    }
}
