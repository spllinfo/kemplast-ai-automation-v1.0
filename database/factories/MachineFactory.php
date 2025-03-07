<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class MachineFactory extends Factory
{
    public function definition(): array
    {
        return [
            'machine_code' => 'MCH' . fake()->unique()->numberBetween(1000, 9999),
            'name' => fake()->randomElement([
                'Extrusion Machine',
                'Printing Machine',
                'Cutting Machine',
                'Sealing Machine',
                'Packing Machine',
                'Quality Control Machine',
                'Testing Machine',
                'Mixing Machine',
                'Grinding Machine',
                'Cooling Machine'
            ]),
            'model_number' => fake()->bothify('??-####'),
            'serial_number' => fake()->bothify('SN-####-????'),
            'manufacturer' => fake()->company(),
            'manufacturing_date' => fake()->dateTimeBetween('-10 years', 'now'),
            'purchase_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'warranty_start_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'warranty_end_date' => fake()->dateTimeBetween('now', '+5 years'),
            'purchase_price' => fake()->numberBetween(100000, 10000000),
            'current_value' => fake()->numberBetween(50000, 5000000),
            'branch_id' => Branch::factory(),
            'location' => fake()->randomElement(['Production Hall A', 'Production Hall B', 'Warehouse', 'Testing Lab']),
            'status' => fake()->randomElement(['active', 'maintenance', 'inactive', 'repair', 'scrapped']),
            'capacity' => fake()->numberBetween(100, 1000),
            'capacity_unit' => fake()->randomElement(['kg/hour', 'pieces/hour', 'meters/hour', 'liters/hour']),
            'power_consumption' => fake()->numberBetween(1, 100),
            'power_unit' => fake()->randomElement(['kW', 'HP']),
            'operating_pressure' => fake()->numberBetween(1, 100),
            'pressure_unit' => fake()->randomElement(['bar', 'psi', 'kPa']),
            'operating_temperature' => fake()->numberBetween(20, 200),
            'temperature_unit' => fake()->randomElement(['°C', '°F']),
            'specifications' => json_encode([
                'dimensions' => [
                    'length' => fake()->numberBetween(1, 10),
                    'width' => fake()->numberBetween(1, 5),
                    'height' => fake()->numberBetween(1, 3),
                ],
                'weight' => fake()->numberBetween(100, 10000),
                'voltage' => fake()->randomElement(['220V', '380V', '440V']),
                'phase' => fake()->randomElement(['Single Phase', 'Three Phase']),
            ]),
            'maintenance_schedule' => json_encode([
                'daily' => ['cleaning', 'inspection'],
                'weekly' => ['lubrication', 'calibration'],
                'monthly' => ['deep_cleaning', 'parts_replacement'],
                'quarterly' => ['major_inspection', 'performance_test'],
                'yearly' => ['overhaul', 'certification'],
            ]),
            'spare_parts' => json_encode([
                'critical_parts' => fake()->randomElements(['Motor', 'Control Panel', 'Belt', 'Sensor'], 2),
                'last_replaced' => fake()->dateTimeBetween('-1 year', 'now'),
                'next_replacement' => fake()->dateTimeBetween('now', '+1 year'),
            ]),
            'documents' => json_encode([
                'manual' => fake()->url(),
                'warranty_certificate' => fake()->url(),
                'calibration_certificate' => fake()->url(),
                'maintenance_records' => fake()->url(),
            ]),
            'notes' => fake()->optional()->paragraph(),
            'metadata' => json_encode([
                'last_maintenance' => fake()->dateTimeBetween('-1 month', 'now'),
                'next_maintenance' => fake()->dateTimeBetween('now', '+1 month'),
                'total_operating_hours' => fake()->numberBetween(1000, 50000),
                'efficiency_rating' => fake()->numberBetween(70, 100),
            ])
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    public function maintenance(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'maintenance'
        ]);
    }
}
