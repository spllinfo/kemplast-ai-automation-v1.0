<?php

namespace Database\Seeders;

use App\Models\ProductionPlan;
use App\Models\ProductionStage;
use Illuminate\Database\Seeder;

class ProductionStageSeeder extends Seeder
{
    public function run(): void
    {
        $productionPlans = ProductionPlan::all();
        if ($productionPlans->isEmpty()) {
            throw new \RuntimeException('No production plans found. Please run ProductionPlanSeeder first.');
        }

        $stageTemplates = [
            [
                'name' => 'Material Preparation',
                'description' => 'Preparing and mixing raw materials',
                'sequence' => 1,
                'planned_duration' => 120,
            ],
            [
                'name' => 'Extrusion',
                'description' => 'Converting raw materials into film through extrusion',
                'sequence' => 2,
                'planned_duration' => 240,
            ],
            [
                'name' => 'Printing',
                'description' => 'Applying prints and designs to the film',
                'sequence' => 3,
                'planned_duration' => 180,
            ],
            [
                'name' => 'Lamination',
                'description' => 'Bonding multiple layers of film',
                'sequence' => 4,
                'planned_duration' => 150,
            ],
            [
                'name' => 'Slitting',
                'description' => 'Cutting film into required widths',
                'sequence' => 5,
                'planned_duration' => 90,
            ],
            [
                'name' => 'Quality Check',
                'description' => 'Quality inspection and testing',
                'sequence' => 6,
                'planned_duration' => 60,
            ],
            [
                'name' => 'Packaging',
                'description' => 'Preparing finished goods for dispatch',
                'sequence' => 7,
                'planned_duration' => 90,
            ],
        ];

        foreach ($productionPlans as $plan) {
            foreach ($stageTemplates as $template) {
                $status = $plan->status === 'completed' ? 'completed' :
                    ($plan->status === 'in_progress' ?
                        ($template['sequence'] <= 3 ? 'completed' :
                            ($template['sequence'] === 4 ? 'in_progress' : 'pending')) :
                        'pending');

                $startTime = $status !== 'pending' ? fake()->dateTimeBetween($plan->planned_start_date, $plan->planned_end_date) : null;
                $endTime = $status === 'completed' ? fake()->dateTimeBetween($startTime, $plan->planned_end_date) : null;
                $actualDuration = $status === 'completed' ? fake()->numberBetween($template['planned_duration'] - 30, $template['planned_duration'] + 60) : null;

                ProductionStage::create([
                    'stage_code' => 'PS-' . $plan->id . '-' . str_pad($template['sequence'], 2, '0', STR_PAD_LEFT),
                    'production_plan_id' => $plan->id,
                    'name' => $template['name'],
                    'description' => $template['description'],
                    'sequence' => $template['sequence'],
                    'status' => $status,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'planned_duration' => $template['planned_duration'],
                    'actual_duration' => $actualDuration,
                    'planned_quantity' => $plan->total_quantity,
                    'actual_quantity' => $status === 'completed' ? $plan->completed_quantity : 0,
                    'rejected_quantity' => $status === 'completed' ? $plan->rejected_quantity : 0,
                    'quality_parameters' => json_encode([
                        'visual_inspection' => true,
                        'measurement_check' => true,
                        'documentation_required' => true,
                        'parameters' => [
                            'thickness_tolerance' => '±5%',
                            'width_tolerance' => '±2mm',
                            'print_quality' => 'Grade A',
                            'seal_strength' => '>3.5 N/15mm'
                        ]
                    ]),
                    'machine_requirements' => json_encode([
                        'machine_type' => $template['name'] === 'Extrusion' ? 'Extruder' :
                            ($template['name'] === 'Printing' ? 'Printer' :
                            ($template['name'] === 'Lamination' ? 'Laminator' :
                            ($template['name'] === 'Slitting' ? 'Slitter' : null))),
                        'specifications' => [
                            'speed_range' => '50-150 m/min',
                            'temperature_range' => '150-250°C',
                            'pressure_range' => '2000-4000 PSI'
                        ]
                    ]),
                    'operator_requirements' => json_encode([
                        'skill_level' => 'Expert',
                        'certification_required' => true,
                        'ppe_requirements' => [
                            'safety_glasses',
                            'gloves',
                            'ear_protection'
                        ]
                    ]),
                    'material_requirements' => json_encode([
                        'raw_materials' => [
                            ['type' => 'LDPE', 'quantity' => '500kg'],
                            ['type' => 'LLDPE', 'quantity' => '300kg'],
                            ['type' => 'MB', 'quantity' => '50kg']
                        ],
                        'packaging' => [
                            ['type' => 'Boxes', 'quantity' => '100'],
                            ['type' => 'Labels', 'quantity' => '1000']
                        ]
                    ]),
                    'notes' => fake()->paragraph(),
                    'metadata' => json_encode([
                        'average_processing_time' => fake()->numberBetween(30, 180),
                        'quality_parameters' => [
                            'visual_inspection' => true,
                            'measurement_check' => true,
                            'documentation_required' => true,
                        ],
                    ]),
                ]);
            }
        }

        info('ProductionStageSeeder: Created production stages successfully');
    }
}
