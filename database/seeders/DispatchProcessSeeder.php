<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\DispatchProcess;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DispatchProcessSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $customers = Customer::all();
        $dispatchers = User::where('role', 'dispatcher')->get();
        $supervisors = User::where('role', 'supervisor')->get();

        $transportModes = ['Road', 'Rail', 'Air', 'Sea'];
        $vehicleTypes = ['Truck', 'Container', 'Van', 'Mini Truck'];
        $packagingTypes = ['Boxes', 'Pallets', 'Bags', 'Rolls'];

        foreach ($branches as $branch) {
            // Create 10 dispatch processes for each branch
            for ($i = 1; $i <= 10; $i++) {
                $status = fake()->randomElement(['pending', 'preparing', 'ready', 'in_transit', 'delivered']);
                $transportMode = fake()->randomElement($transportModes);
                $customer = $customers->random();

                DispatchProcess::create([
                    'branch_id' => $branch->id,
                    'dispatch_number' => 'DSP-' . $branch->id . date('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'reference_number' => 'REF-' . fake()->bothify('??###'),

                    // Customer Information
                    'customer_id' => $customer->id,
                    'customer_po_number' => 'PO-' . fake()->bothify('??####'),
                    'delivery_address' => json_encode([
                        'street' => fake()->streetAddress(),
                        'city' => fake()->city(),
                        'state' => fake()->state(),
                        'postal_code' => fake()->postcode(),
                        'country' => fake()->country(),
                        'contact_person' => fake()->name(),
                        'contact_number' => fake()->phoneNumber()
                    ]),

                    // Shipment Details
                    'transport_mode' => $transportMode,
                    'vehicle_type' => fake()->randomElement($vehicleTypes),
                    'vehicle_number' => fake()->bothify('??-##-??-####'),
                    'driver_name' => fake()->name(),
                    'driver_contact' => fake()->phoneNumber(),
                    'route_details' => json_encode([
                        'origin' => fake()->city(),
                        'destination' => fake()->city(),
                        'estimated_distance' => fake()->numberBetween(50, 1000) . ' km',
                        'route_map_link' => 'https://maps.example.com/' . Str::random(10)
                    ]),

                    // Packaging Information
                    'packaging_type' => fake()->randomElement($packagingTypes),
                    'total_packages' => fake()->numberBetween(10, 100),
                    'total_weight' => fake()->randomFloat(2, 100, 5000),
                    'total_volume' => fake()->randomFloat(2, 1, 50),
                    'packaging_details' => json_encode([
                        'package_dimensions' => [
                            'length' => fake()->numberBetween(20, 100),
                            'width' => fake()->numberBetween(20, 100),
                            'height' => fake()->numberBetween(20, 100)
                        ],
                        'special_handling' => fake()->boolean(30) ? fake()->words(3, true) : null,
                        'stacking_instructions' => 'Maximum 3 layers'
                    ]),

                    // Timing Information
                    'planned_dispatch_date' => $plannedDate = fake()->dateTimeBetween('now', '+1 week'),
                    'actual_dispatch_date' => $status !== 'pending' ? fake()->dateTimeBetween($plannedDate, '+2 days') : null,
                    'estimated_delivery_date' => fake()->dateTimeBetween($plannedDate, '+1 week'),
                    'actual_delivery_date' => $status === 'delivered' ? fake()->dateTimeBetween($plannedDate, '+1 week') : null,

                    // Documentation
                    'documents' => json_encode([
                        'invoice_number' => 'INV-' . fake()->bothify('??####'),
                        'e_way_bill' => 'EWB-' . fake()->bothify('??####'),
                        'packing_list' => 'PL-' . fake()->bothify('??####'),
                        'insurance_details' => fake()->boolean(70) ? [
                            'policy_number' => 'POL-' . fake()->bothify('??####'),
                            'coverage_amount' => fake()->numberBetween(10000, 100000)
                        ] : null
                    ]),

                    // Status Information
                    'status' => $status,
                    'dispatcher_id' => $dispatchers->random()->id,
                    'supervisor_id' => $supervisors->random()->id,
                    'tracking_number' => 'TRK-' . fake()->bothify('??####'),
                    'tracking_url' => 'https://track.example.com/' . Str::random(10),

                    // Quality and Compliance
                    'quality_checks' => json_encode([
                        'packaging_inspection' => fake()->boolean(90),
                        'quantity_verification' => fake()->boolean(95),
                        'documentation_check' => fake()->boolean(100)
                    ]),
                    'compliance_details' => json_encode([
                        'transport_permit' => fake()->boolean(80) ? 'PRMT-' . fake()->bothify('??####') : null,
                        'safety_certification' => fake()->boolean(70) ? 'SFTY-' . fake()->bothify('??####') : null,
                        'environmental_compliance' => fake()->boolean(60) ? 'ENV-' . fake()->bothify('??####') : null
                    ]),

                    // Cost Information
                    'cost_details' => json_encode([
                        'transport_cost' => fake()->randomFloat(2, 1000, 10000),
                        'packaging_cost' => fake()->randomFloat(2, 500, 5000),
                        'insurance_cost' => fake()->randomFloat(2, 200, 2000),
                        'additional_charges' => fake()->randomFloat(2, 0, 1000),
                        'total_cost' => fake()->randomFloat(2, 2000, 15000)
                    ]),

                    // Additional Information
                    'notes' => fake()->boolean(70) ? fake()->paragraph() : null,
                    'special_instructions' => fake()->boolean(40) ? fake()->sentence() : null,
                    'issues_encountered' => fake()->boolean(20) ? fake()->sentence() : null,

                    // Metadata
                    'metadata' => json_encode([
                        'weather_conditions' => fake()->randomElement(['Clear', 'Rainy', 'Cloudy']),
                        'temperature_requirements' => fake()->boolean(30) ? [
                            'min_temp' => fake()->numberBetween(15, 20),
                            'max_temp' => fake()->numberBetween(25, 30)
                        ] : null,
                        'priority_level' => fake()->randomElement(['Normal', 'High', 'Urgent']),
                        'dispatch_tags' => fake()->words(3)
                    ])
                ]);
            }
        }
    }
}
