<?php

namespace Database\Factories;

use App\Models\MaintenanceSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceScheduleFactory extends Factory
{
    protected $model = MaintenanceSchedule::class;

    public function definition(): array
    {
        $types = ['Preventive', 'Corrective', 'Predictive'];
        $type = fake()->randomElement($types);
        
        return [
            'schedule_number' => 'MAINT-' . fake()->unique()->numberBetween(1000, 9999),
            'machine_id' => null, // Set in seeder
            'maintenance_type' => $type,
            'description' => fake()->sentence(),
            'scheduled_date' => fake()->dateTimeBetween('now', '+1 month'),
            'estimated_duration' => fake()->numberBetween(1, 8), // hours
            'technician_id' => null, // Set in seeder
            'parts_required' => json_encode([
                'spare_parts' => fake()->words(3),
                'tools' => fake()->words(3),
                'consumables' => fake()->words(2)
            ]),
            'estimated_cost' => fake()->numberBetween(1000, 10000),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'status' => fake()->randomElement(['scheduled', 'in_progress', 'completed', 'delayed']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}