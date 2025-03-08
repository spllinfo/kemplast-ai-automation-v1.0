<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Material;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition(): array
    {
        $materialTypes = ['LD', 'LLD', 'HD', 'RD', 'MB', 'OTHER'];
        $selectedType = $this->faker->randomElement($materialTypes);

        $grades = [
            'LD' => ['2420D', '2426H', '2420H', 'M1810', 'G812'],
            'LLD' => ['218W', '218WJ', 'M3004', 'M2004', 'F2004'],
            'HD' => ['5000S', 'HF4760', 'HF0854', 'M6060', 'H5211'],
            'RD' => ['RLD100', 'RHD200', 'RPE150', 'RMB50', 'RPP75'],
            'MB' => ['White 100', 'Black 439', 'Blue 7001', 'Green 6002', 'Yellow 115'],
            'OTHER' => ['PP H200', 'PP K1011', 'ABS TR557', 'PS 535', 'EVA 210']
        ];

        $colors = [
            'Natural', 'White', 'Black', 'Blue', 'Green', 'Yellow', 'Red', 'Orange',
            'Grey', 'Brown', 'Purple', 'Transparent'
        ];

        $manufacturers = [
            'Reliance Industries', 'SABIC', 'DOW Chemical', 'BASF', 'LyondellBasell',
            'ExxonMobil', 'INEOS', 'Braskem', 'Formosa Plastics', 'Borealis'
        ];

        $uoms = ['KG', 'MT', 'PCS', 'BOX'];
        $selectedUOM = $this->faker->randomElement($uoms);

        // Base quantity in KG
        $baseQty = $this->faker->numberBetween(1000, 10000);

        // Convert quantity based on UOM
        $quantity = match($selectedUOM) {
            'MT' => $baseQty / 1000,
            'PCS' => $baseQty / 25, // Assuming 25kg per piece
            'BOX' => $baseQty / 250, // Assuming 250kg per box
            default => $baseQty
        };

        return [
            // Basic Information
            'material_code' => $selectedType . $this->faker->unique()->numberBetween(10000, 99999),
            'material_name' => $manufacturers[array_rand($manufacturers)] . ' ' .
                             $selectedType . ' ' .
                             $this->faker->randomElement($grades[$selectedType]),
            'material_type' => $selectedType,
            'material_grade' => $this->faker->randomElement($grades[$selectedType]),
            'material_category' => $this->faker->randomElement(['Raw Material', 'Finished Good', 'Semi-Finished', 'Packaging']),
            'material_color' => $this->faker->randomElement($colors),

            // Stock Information
            'opening_balance' => $quantity,
            'quantity' => $quantity,
            'uom' => $selectedUOM,
            'minimum_stock_level' => $baseQty * 0.1, // 10% of base quantity
            'maximum_stock_level' => $baseQty * 2,
            'reorder_point' => $baseQty * 0.2, // 20% of base quantity
            'safety_stock' => $baseQty * 0.15, // 15% of base quantity

            // Pricing
            'unit_price' => $this->faker->randomFloat(2, 80, 500),
            'last_purchase_price' => $this->faker->randomFloat(2, 75, 450),
            'currency' => 'INR',
            'tax_rate' => $this->faker->randomElement([5, 12, 18, 28]),
            'hsn_code' => '39' . $this->faker->numberBetween(011010, 269090),

            // Physical Properties
            'density' => $this->faker->randomFloat(3, 0.890, 1.400),
            'melt_flow_index' => $this->faker->randomFloat(3, 0.5, 25.0),
            'technical_properties' => [
                'tensile_strength' => $this->faker->randomFloat(2, 15, 60) . ' MPa',
                'elongation' => $this->faker->randomFloat(2, 100, 900) . '%',
                'impact_strength' => $this->faker->randomFloat(2, 2, 15) . ' kJ/m²',
                'vicat_softening_point' => $this->faker->randomFloat(1, 90, 130) . '°C',
                'flexural_modulus' => $this->faker->randomFloat(0, 500, 2500) . ' MPa'
            ],
            'standard_weight' => 25.000,
            'standard_length' => $this->faker->randomFloat(3, 500, 2000),
            'standard_width' => $this->faker->randomFloat(3, 500, 2000),

            // Storage
            'warehouse_location' => 'WH-' . $this->faker->randomLetter() . $this->faker->numberBetween(1, 99),
            'bin_location' => 'BIN-' . $this->faker->randomLetter() . $this->faker->numberBetween(1, 99),
            'storage_conditions' => [
                'temperature' => $this->faker->numberBetween(20, 30) . '°C',
                'humidity' => $this->faker->numberBetween(40, 60) . '%',
                'stacking_height' => $this->faker->numberBetween(3, 8) . ' pallets',
                'special_requirements' => $this->faker->randomElement([
                    'Keep away from direct sunlight',
                    'Store in dry conditions',
                    'Avoid contact with water',
                    'Maximum 3 months storage',
                    null
                ])
            ],
            'shelf_life_days' => $this->faker->randomElement([180, 365, 730, 1095]),

            // Quality
            'quality_grade' => $this->faker->randomElement(['Premium', 'Standard', 'Economy']),
            'quality_parameters' => [
                'appearance' => $this->faker->randomElement(['Clear', 'Translucent', 'Opaque']),
                'contamination' => $this->faker->randomElement(['None', 'Low', 'Medium']),
                'moisture_content' => $this->faker->randomFloat(2, 0.01, 0.5) . '%',
                'bulk_density' => $this->faker->randomFloat(2, 0.45, 0.65) . ' g/cm³'
            ],
            'manufacture_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'expiry_date' => $this->faker->dateTimeBetween('+6 months', '+2 years'),
            'requires_inspection' => $this->faker->boolean(70),
            'inspection_interval_days' => $this->faker->randomElement([30, 60, 90]),

            // Supplier Info
            'primary_supplier_id' => Supplier::factory(),
            'alternative_suppliers' => [
                ['name' => $this->faker->company(), 'contact' => $this->faker->phoneNumber()],
                ['name' => $this->faker->company(), 'contact' => $this->faker->phoneNumber()]
            ],
            'manufacturer_name' => $this->faker->randomElement($manufacturers),
            'brand_name' => function (array $attributes) {
                return $attributes['manufacturer_name'] . ' Polymers';
            },
            'lead_time_days' => $this->faker->numberBetween(7, 45),
            'minimum_order_quantity' => $this->faker->randomFloat(3, 500, 2000),

            // Documentation
            'material_image' => $this->faker->imageUrl(640, 480, 'industrial'),
            'msds_document' => $this->faker->url(),
            'technical_datasheet' => $this->faker->url(),
            'quality_certificate' => $this->faker->url(),
            'notes' => $this->faker->paragraph(),
            'certificates' => [
                'ISO9001' => $this->faker->boolean(80),
                'ISO14001' => $this->faker->boolean(60),
                'REACH' => $this->faker->boolean(70),
                'RoHS' => $this->faker->boolean(65),
                'FDA' => $this->faker->boolean(50)
            ],

            // Status and Control
            'status' => $this->faker->randomElement([
                'active', 'active', 'active', // Higher weight for active
                'inactive',
                'pending_approval',
                'discontinued',
                'out_of_stock',
                'expired'
            ]),
            'is_active' => $this->faker->boolean(80),
            'is_returnable' => $this->faker->boolean(30),
            'is_batch_tracked' => $this->faker->boolean(90),
            'requires_coa' => $this->faker->boolean(60),

            // Branch and Tracking
            'branch_id' => Branch::factory(),
            'created_by' => User::factory(),
            'updated_by' => User::factory(),
            'last_stock_update' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'last_price_update' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
