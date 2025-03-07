<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\MaterialMixingBatch;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaterialMixingBatchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $materials = Material::all();
        $operators = User::where('role', 'operator')->get();
        $supervisors = User::where('role', 'supervisor')->get();

        $mixingTypes = ['Standard', 'Custom', 'Special'];
        $mixerTypes = ['Ribbon Blender', 'Tumble Mixer', 'High-Speed Mixer'];

        foreach ($branches as $branch) {
            // Create 10 mixing batches for each branch
            for ($i = 1; $i <= 10; $i++) {
                $status = fake()->randomElement(['pending', 'in_progress', 'completed', 'rejected']);
                $mixingType = fake()->randomElement($mixingTypes);
                $mixerType = fake()->randomElement($mixerTypes);

                // Select random materials for mixing
                $selectedMaterials = $materials->where('branch_id', $branch->id)
                    ->random(fake()->numberBetween(2, 5));

                $totalQuantity = fake()->numberBetween(100, 1000);

                // Calculate material ratios that sum to 100%
                $remainingPercentage = 100;
                $materialRatios = [];

                foreach ($selectedMaterials as $index => $material) {
                    if ($index === $selectedMaterials->count() - 1) {
                        $ratio = $remainingPercentage;
                    } else {
                        $ratio = $index === 0 ?
                            fake()->numberBetween(40, 60) :
                            fake()->numberBetween(5, $remainingPercentage - 5);
                    }
                    $materialRatios[$material->id] = $ratio;
                    $remainingPercentage -= $ratio;
                }

                MaterialMixingBatch::create([
                    'branch_id' => $branch->id,
                    'batch_number' => 'MIX-' . $branch->id . date('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT),

                    // Basic Information
                    'mixing_type' => $mixingType,
                    'mixer_type' => $mixerType,
                    'total_quantity' => $totalQuantity,
                    'unit' => 'KG',

                    // Material Composition
                    'material_composition' => json_encode(array_map(function($material) use ($materialRatios, $totalQuantity) {
                        $ratio = $materialRatios[$material->id];
                        return [
                            'material_id' => $material->id,
                            'material_code' => $material->material_code,
                            'material_name' => $material->material_name,
                            'percentage' => $ratio,
                            'quantity' => ($ratio / 100) * $totalQuantity,
                            'batch_number' => 'BATCH-' . fake()->bothify('??###')
                        ];
                    }, $selectedMaterials->all())),

                    // Process Parameters
                    'mixing_parameters' => json_encode([
                        'temperature' => fake()->numberBetween(20, 40) . '°C',
                        'mixing_speed' => fake()->numberBetween(30, 100) . ' RPM',
                        'mixing_time' => fake()->numberBetween(10, 30) . ' minutes',
                        'power_consumption' => fake()->randomFloat(2, 5, 15) . ' kW'
                    ]),

                    // Quality Parameters
                    'quality_parameters' => json_encode([
                        'homogeneity' => fake()->randomElement(['Excellent', 'Good', 'Fair']),
                        'contamination' => fake()->randomElement(['None', 'Minor', 'Significant']),
                        'color_consistency' => fake()->randomElement(['Uniform', 'Slightly Varied', 'Varied']),
                        'moisture_content' => fake()->randomFloat(2, 0.01, 0.1) . '%'
                    ]),

                    // Process Results
                    'mixing_results' => json_encode([
                        'actual_quantity' => fake()->randomFloat(2, $totalQuantity * 0.98, $totalQuantity * 1.02),
                        'yield_percentage' => fake()->randomFloat(2, 97, 99.5),
                        'waste_quantity' => fake()->randomFloat(2, 1, 5),
                        'mixing_efficiency' => fake()->randomFloat(2, 90, 98) . '%'
                    ]),

                    // Equipment Details
                    'equipment_details' => json_encode([
                        'mixer_id' => 'MIX-' . fake()->bothify('??##'),
                        'mixer_capacity' => fake()->numberBetween(100, 2000) . ' KG',
                        'maintenance_status' => fake()->randomElement(['Good', 'Needs Attention', 'Recently Serviced']),
                        'cleaning_status' => fake()->randomElement(['Clean', 'Needs Cleaning', 'In Progress'])
                    ]),

                    // Process Monitoring
                    'process_monitoring' => json_encode([
                        'temperature_log' => [
                            ['time' => '0min', 'temp' => fake()->numberBetween(20, 25)],
                            ['time' => '15min', 'temp' => fake()->numberBetween(25, 35)],
                            ['time' => '30min', 'temp' => fake()->numberBetween(30, 40)]
                        ],
                        'power_consumption_log' => [
                            ['time' => '0min', 'power' => fake()->randomFloat(2, 5, 8)],
                            ['time' => '15min', 'power' => fake()->randomFloat(2, 8, 12)],
                            ['time' => '30min', 'power' => fake()->randomFloat(2, 10, 15)]
                        ]
                    ]),

                    // Status Information
                    'status' => $status,
                    'operator_id' => $operators->random()->id,
                    'supervisor_id' => $supervisors->random()->id,
                    'start_time' => $plannedStartTime = fake()->dateTimeBetween('-1 week', 'now'),
                    'end_time' => $status === 'completed' ? fake()->dateTimeBetween($plannedStartTime, 'now') : null,

                    // Additional Information
                    'notes' => fake()->boolean(70) ? fake()->paragraph() : null,
                    'issues_encountered' => fake()->boolean(30) ? fake()->sentence() : null,
                    'corrective_actions' => fake()->boolean(20) ? fake()->sentence() : null,

                    // Quality Control
                    'quality_checks' => json_encode([
                        'visual_inspection' => fake()->boolean(90),
                        'composition_check' => fake()->boolean(85),
                        'moisture_analysis' => fake()->boolean(80),
                        'homogeneity_test' => fake()->boolean(75)
                    ]),
                    'quality_results' => json_encode([
                        'appearance' => fake()->randomElement(['Excellent', 'Good', 'Fair']),
                        'blend_uniformity' => fake()->randomElement(['Within Spec', 'Minor Deviation', 'Major Deviation']),
                        'foreign_particles' => fake()->randomElement(['None Detected', 'Minor Presence', 'Significant'])
                    ]),

                    // Metadata
                    'metadata' => json_encode([
                        'environmental_conditions' => [
                            'temperature' => fake()->randomFloat(1, 20, 25) . '°C',
                            'humidity' => fake()->numberBetween(45, 65) . '%',
                            'room_cleanliness' => fake()->randomElement(['Clean', 'Acceptable', 'Needs Attention'])
                        ],
                        'batch_tags' => [
                            'priority' => fake()->randomElement(['High', 'Medium', 'Low']),
                            'special_instructions' => fake()->boolean(30) ? fake()->sentence() : null,
                            'customer_requirements' => fake()->boolean(20) ? fake()->sentence() : null
                        ]
                    ])
                ]);
            }
        }
    }
}
