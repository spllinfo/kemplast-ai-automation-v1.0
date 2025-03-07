<?php

namespace Database\Seeders;

use App\Models\MaterialStock;
use App\Models\Material;
use App\Models\Branch;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class MaterialStockSeeder extends Seeder
{
    public function run(): void
    {
        $materials = Material::all();
        $branches = Branch::all();
        $suppliers = Supplier::all();

        foreach ($materials as $material) {
            // Create stock entries for each branch
            foreach ($branches as $branch) {
                MaterialStock::create([
                    'branch_id' => $branch->id,
                    'supplier_id' => $suppliers->random()->id,

                    // Material Basic Info
                    'material_code' => $material->material_code . '-B' . $branch->id,
                    'material_name' => $material->material_name,
                    'material_grade' => $material->material_grade,
                    'material_category' => $material->material_category,
                    'material_type' => $material->material_type,
                    'material_description' => fake()->sentence(),

                    // Stock Metrics
                    'quantity' => fake()->numberBetween(500, 5000),
                    'uom' => $material->uom,
                    'minimum_stock_level' => $material->minimum_stock_level,
                    'maximum_stock_level' => $material->maximum_stock_level,
                    'reorder_level' => $material->reorder_point,

                    // Financial Details
                    'unit_price' => $material->unit_price,
                    'currency' => $material->currency,
                    'total_value' => $material->unit_price * fake()->numberBetween(500, 5000),
                    'price_history' => json_encode([
                        [
                            'date' => now()->subMonths(2)->format('Y-m-d'),
                            'price' => fake()->randomFloat(2, 40, 450)
                        ],
                        [
                            'date' => now()->subMonth()->format('Y-m-d'),
                            'price' => fake()->randomFloat(2, 45, 480)
                        ],
                        [
                            'date' => now()->format('Y-m-d'),
                            'price' => $material->unit_price
                        ]
                    ]),

                    // Location & Storage
                    'warehouse_location' => $material->warehouse_location,
                    'rack_number' => 'RACK-' . fake()->bothify('??-##'),
                    'bin_number' => 'BIN-' . fake()->bothify('??-##'),
                    'storage_conditions' => $material->storage_conditions,

                    // Tracking
                    'batch_number' => 'BATCH-' . fake()->bothify('??####'),
                    'barcode' => fake()->ean13(),
                    'qr_code' => fake()->uuid(),
                    'manufacturing_date' => fake()->dateTimeBetween('-6 months', 'now'),
                    'expiry_date' => fake()->dateTimeBetween('now', '+2 years'),

                    // Quality Parameters
                    'quality_status' => fake()->randomElement(['approved', 'approved', 'approved', 'pending', 'rejected']),
                    'quality_parameters' => json_encode([
                        'moisture_content' => fake()->randomFloat(2, 0.01, 0.1) . '%',
                        'melt_flow_index' => fake()->randomFloat(2, 0.5, 25) . ' g/10min',
                        'density' => fake()->randomFloat(3, 0.9, 1.5) . ' g/cm³'
                    ]),
                    'certificates' => json_encode([
                        'coa' => fake()->url(),
                        'msds' => fake()->url(),
                        'test_report' => fake()->url()
                    ]),

                    // Usage Tracking
                    'consumption_history' => json_encode([
                        [
                            'date' => now()->subDays(14)->format('Y-m-d'),
                            'quantity' => fake()->numberBetween(100, 500),
                            'reference' => 'PRD-' . fake()->bothify('??####')
                        ],
                        [
                            'date' => now()->subDays(7)->format('Y-m-d'),
                            'quantity' => fake()->numberBetween(100, 500),
                            'reference' => 'PRD-' . fake()->bothify('??####')
                        ]
                    ]),
                    'replenishment_history' => json_encode([
                        [
                            'date' => now()->subDays(21)->format('Y-m-d'),
                            'quantity' => fake()->numberBetween(1000, 2000),
                            'reference' => 'PO-' . fake()->bothify('??####')
                        ],
                        [
                            'date' => now()->subDays(10)->format('Y-m-d'),
                            'quantity' => fake()->numberBetween(1000, 2000),
                            'reference' => 'PO-' . fake()->bothify('??####')
                        ]
                    ]),
                    'last_consumed_at' => now()->subDays(7),
                    'last_replenished_at' => now()->subDays(10),

                    // Status and Flags
                    'is_active' => true,
                    'is_blocked' => $isBlocked = fake()->boolean(10),
                    'block_reason' => $isBlocked ? fake()->randomElement([
                        'Quality Check Pending',
                        'Batch Under Investigation',
                        'Documentation Incomplete'
                    ]) : null
                ]);
            }
        }
    }
}
