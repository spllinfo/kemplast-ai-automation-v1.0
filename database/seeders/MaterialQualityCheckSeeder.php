<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\MaterialQualityCheck;
use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaterialQualityCheckSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $materials = Material::all();
        $qualityInspectors = User::where('role', 'quality_inspector')->get();
        $supervisors = User::where('role', 'supervisor')->get();

        $testTypes = ['Incoming', 'In-Process', 'Final'];
        $materialCategories = ['Raw Material', 'Finished Good', 'Semi-Finished'];

        foreach ($branches as $branch) {
            foreach ($materials->where('branch_id', $branch->id) as $material) {
                // Create 2 quality checks for each material
                for ($i = 1; $i <= 2; $i++) {
                    $testType = fake()->randomElement($testTypes);
                    $status = fake()->randomElement(['pending', 'in_progress', 'completed', 'rejected']);

                    MaterialQualityCheck::create([
                        'branch_id' => $branch->id,
                        'material_id' => $material->id,
                        'check_number' => 'MQC-' . $branch->id . date('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT),

                        // Basic Information
                        'test_type' => $testType,
                        'material_category' => $material->material_category,
                        'batch_number' => 'BATCH-' . fake()->bothify('??###'),
                        'lot_number' => 'LOT-' . fake()->bothify('??###'),
                        'sample_quantity' => fake()->numberBetween(1, 10),
                        'sample_unit' => fake()->randomElement(['KG', 'MT', 'PCS']),

                        // Material Properties
                        'material_properties' => json_encode([
                            'physical' => [
                                'density' => fake()->randomFloat(3, 0.91, 0.97) . ' g/cm³',
                                'melt_flow_index' => fake()->randomFloat(2, 0.5, 25) . ' g/10min',
                                'moisture_content' => fake()->randomFloat(2, 0.01, 0.1) . '%'
                            ],
                            'mechanical' => [
                                'tensile_strength' => fake()->numberBetween(20, 30) . ' MPa',
                                'elongation' => fake()->numberBetween(200, 600) . '%',
                                'impact_strength' => fake()->numberBetween(2, 20) . ' kJ/m²'
                            ],
                            'thermal' => [
                                'melting_point' => fake()->numberBetween(120, 170) . '°C',
                                'vicat_softening' => fake()->numberBetween(90, 130) . '°C'
                            ]
                        ]),

                        // Test Results
                        'test_results' => json_encode([
                            'measurements' => [
                                ['parameter' => 'Density', 'value' => fake()->randomFloat(3, 0.91, 0.97), 'unit' => 'g/cm³'],
                                ['parameter' => 'MFI', 'value' => fake()->randomFloat(2, 0.5, 25), 'unit' => 'g/10min'],
                                ['parameter' => 'Moisture', 'value' => fake()->randomFloat(2, 0.01, 0.1), 'unit' => '%']
                            ],
                            'visual_inspection' => [
                                'color' => fake()->randomElement(['Standard', 'Slight Variation', 'Off-Spec']),
                                'contamination' => fake()->randomElement(['None', 'Minor', 'Major']),
                                'appearance' => fake()->randomElement(['Uniform', 'Slightly Irregular', 'Irregular'])
                            ],
                            'conclusion' => fake()->randomElement(['Accepted', 'Accepted with Deviation', 'Rejected'])
                        ]),

                        // Specifications
                        'specifications' => json_encode([
                            'density_range' => '0.91-0.97 g/cm³',
                            'mfi_range' => '0.5-25 g/10min',
                            'moisture_limit' => '< 0.1%',
                            'contamination_limit' => '< 0.05%',
                            'color_delta_e' => '≤ 2'
                        ]),

                        // Quality Parameters
                        'quality_parameters' => json_encode([
                            'critical' => [
                                'contamination' => 'None visible',
                                'moisture_content' => '< 0.1%',
                                'melt_flow_rate' => 'Within ±10% of spec'
                            ],
                            'major' => [
                                'color_consistency' => 'Delta E ≤ 2',
                                'density_variation' => '± 0.02 g/cm³'
                            ],
                            'minor' => [
                                'surface_appearance' => 'Uniform',
                                'pellet_size' => 'Standard distribution'
                            ]
                        ]),

                        // Status Information
                        'status' => $status,
                        'inspector_id' => $qualityInspectors->random()->id,
                        'supervisor_id' => $supervisors->random()->id,
                        'check_date' => fake()->dateTimeBetween('-1 week', 'now'),
                        'completion_date' => $status === 'completed' ? fake()->dateTimeBetween('-1 week', 'now') : null,

                        // Additional Information
                        'notes' => fake()->boolean(70) ? fake()->paragraph() : null,
                        'deviations' => fake()->boolean(30) ? fake()->sentence() : null,
                        'corrective_actions' => $status === 'rejected' ? fake()->sentence() : null,

                        // Documentation
                        'certificates' => json_encode([
                            'coa' => fake()->boolean(80) ? 'coa_' . fake()->bothify('??###') . '.pdf' : null,
                            'test_report' => fake()->boolean(70) ? 'tr_' . fake()->bothify('??###') . '.pdf' : null,
                            'msds' => fake()->boolean(90) ? 'msds_' . fake()->bothify('??###') . '.pdf' : null
                        ]),

                        // Metadata
                        'metadata' => json_encode([
                            'equipment_used' => [
                                'density_meter' => 'DM-2000',
                                'moisture_analyzer' => 'MA-1000',
                                'mfi_tester' => 'MFI-3000'
                            ],
                            'test_conditions' => [
                                'temperature' => fake()->randomFloat(1, 20, 25) . '°C',
                                'humidity' => fake()->numberBetween(45, 65) . '%',
                                'test_method' => 'ASTM D' . fake()->numberBetween(1000, 9999)
                            ],
                            'calibration_info' => [
                                'last_calibration' => fake()->date(),
                                'next_due' => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d')
                            ]
                        ])
                    ]);
                }
            }
        }
    }
}
