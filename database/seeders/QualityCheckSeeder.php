<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\QualityCheck;
use App\Models\User;
use App\Models\ProductionStage;
use Illuminate\Database\Seeder;

class QualityCheckSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $qualityInspectors = User::where('role', 'quality_inspector')->get();
        $supervisors = User::where('role', 'supervisor')->get();
        $productionStages = ProductionStage::all();

        $checkTypes = ['Visual', 'Dimensional', 'Physical', 'Chemical', 'Performance'];
        $productTypes = ['Raw Material', 'In-Process', 'Finished Good'];

        foreach ($branches as $branch) {
            // Create 20 quality checks for each branch
            for ($i = 1; $i <= 20; $i++) {
                $checkType = fake()->randomElement($checkTypes);
                $productType = fake()->randomElement($productTypes);
                $status = fake()->randomElement(['pending', 'in_progress', 'completed', 'rejected']);

                QualityCheck::create([
                    'branch_id' => $branch->id,
                    'check_number' => 'QC-' . $branch->id . date('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'production_stage_id' => $productionStages->random()->id,

                    // Basic Information
                    'check_type' => $checkType,
                    'product_type' => $productType,
                    'batch_number' => 'BATCH-' . fake()->bothify('??###'),
                    'sample_size' => fake()->numberBetween(5, 50),
                    'priority' => fake()->randomElement(['low', 'medium', 'high', 'urgent']),

                    // Check Parameters
                    'parameters' => json_encode([
                        'visual' => [
                            'appearance' => fake()->randomElement(['Good', 'Fair', 'Poor']),
                            'color' => fake()->randomElement(['Matching', 'Slight Variation', 'Major Variation']),
                            'defects' => fake()->numberBetween(0, 5)
                        ],
                        'dimensional' => [
                            'length' => fake()->randomFloat(2, 95, 105) . '%',
                            'width' => fake()->randomFloat(2, 95, 105) . '%',
                            'thickness' => fake()->randomFloat(2, 95, 105) . '%'
                        ],
                        'physical' => [
                            'weight' => fake()->randomFloat(2, 95, 105) . '%',
                            'density' => fake()->randomFloat(3, 0.9, 1.1) . ' g/cm³',
                            'tensile_strength' => fake()->numberBetween(20, 30) . ' MPa'
                        ]
                    ]),

                    // Results
                    'results' => json_encode([
                        'measurements' => [
                            ['parameter' => 'Length', 'value' => fake()->randomFloat(2, 95, 105), 'unit' => 'mm'],
                            ['parameter' => 'Width', 'value' => fake()->randomFloat(2, 95, 105), 'unit' => 'mm'],
                            ['parameter' => 'Thickness', 'value' => fake()->randomFloat(3, 0.095, 0.105), 'unit' => 'mm']
                        ],
                        'observations' => [
                            'visual_defects' => fake()->boolean(20) ? 'Minor surface scratches' : 'None',
                            'color_consistency' => fake()->boolean(90) ? 'Consistent' : 'Variation detected',
                            'structural_integrity' => fake()->boolean(95) ? 'Good' : 'Issues detected'
                        ],
                        'conclusion' => fake()->randomElement(['Passed', 'Passed with observations', 'Failed'])
                    ]),

                    // Specifications
                    'specifications' => json_encode([
                        'dimensional' => [
                            'length_tolerance' => '±2%',
                            'width_tolerance' => '±2%',
                            'thickness_tolerance' => '±5%'
                        ],
                        'physical' => [
                            'min_tensile_strength' => '20 MPa',
                            'max_elongation' => '600%',
                            'density_range' => '0.91-0.97 g/cm³'
                        ],
                        'appearance' => [
                            'color_delta_e' => '≤ 2',
                            'surface_quality' => 'No visible defects',
                            'transparency' => '> 90%'
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
                    'recommendations' => $status === 'completed' ? fake()->sentence() : null,
                    'corrective_actions' => $status === 'rejected' ? fake()->sentence() : null,

                    // Attachments and Documentation
                    'attachments' => json_encode([
                        'test_reports' => fake()->boolean(60) ? ['report1.pdf', 'report2.pdf'] : [],
                        'images' => fake()->boolean(40) ? ['image1.jpg', 'image2.jpg'] : [],
                        'certificates' => fake()->boolean(30) ? ['cert1.pdf'] : []
                    ]),

                    // Metadata
                    'metadata' => json_encode([
                        'equipment_used' => [
                            'thickness_gauge' => 'DG-1000',
                            'tensile_tester' => 'TT-2000',
                            'colorimeter' => 'CR-400'
                        ],
                        'environmental_conditions' => [
                            'temperature' => fake()->randomFloat(1, 20, 25),
                            'humidity' => fake()->numberBetween(45, 65),
                            'lighting' => 'Standard D65'
                        ],
                        'calibration_status' => [
                            'last_calibration' => fake()->date(),
                            'next_calibration' => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d')
                        ]
                    ])
                ]);
            }
        }
    }
}
