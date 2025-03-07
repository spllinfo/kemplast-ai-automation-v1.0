<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\DispatchDocument;
use App\Models\DispatchProcess;
use App\Models\User;
use Illuminate\Database\Seeder;

class DispatchDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $branches = Branch::all();
        $dispatchProcesses = DispatchProcess::all();
        $users = User::all();

        $documentTypes = [
            'Invoice',
            'Delivery Challan',
            'Packing List',
            'E-Way Bill',
            'Insurance Certificate',
            'Quality Certificate',
            'Transport Permit'
        ];

        foreach ($branches as $branch) {
            $branchDispatchProcesses = $dispatchProcesses->where('branch_id', $branch->id);

            foreach ($branchDispatchProcesses as $process) {
                // Create 3-5 documents for each dispatch process
                $numDocuments = fake()->numberBetween(3, 5);

                for ($i = 1; $i <= $numDocuments; $i++) {
                    $documentType = fake()->randomElement($documentTypes);
                    $status = fake()->randomElement(['draft', 'generated', 'signed', 'verified']);

                    DispatchDocument::create([
                        'branch_id' => $branch->id,
                        'dispatch_process_id' => $process->id,
                        'document_number' => strtoupper(substr($documentType, 0, 3)) . '-' .
                            $branch->id . date('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT),

                        // Document Details
                        'document_type' => $documentType,
                        'title' => $documentType . ' for ' . $process->dispatch_number,
                        'description' => fake()->sentence(),
                        'version' => '1.0',

                        // File Information
                        'file_name' => strtolower(str_replace(' ', '_', $documentType)) . '_' .
                            fake()->bothify('??###') . '.pdf',
                        'file_path' => 'documents/dispatch/' . date('Y/m/d'),
                        'file_size' => fake()->numberBetween(100, 5000) . ' KB',
                        'file_type' => 'application/pdf',

                        // Status Information
                        'status' => $status,
                        'generated_by' => $users->random()->id,
                        'verified_by' => $status === 'verified' ? $users->random()->id : null,
                        'generated_at' => $generatedAt = fake()->dateTimeBetween('-1 week', 'now'),
                        'verified_at' => $status === 'verified' ? fake()->dateTimeBetween($generatedAt, 'now') : null,

                        // Document Content
                        'content_summary' => json_encode([
                            'sections' => [
                                'header' => [
                                    'company_details' => true,
                                    'document_info' => true,
                                    'date' => true
                                ],
                                'body' => [
                                    'item_details' => true,
                                    'quantity' => true,
                                    'specifications' => true
                                ],
                                'footer' => [
                                    'terms' => true,
                                    'signatures' => true,
                                    'notes' => true
                                ]
                            ],
                            'page_count' => fake()->numberBetween(1, 5),
                            'has_attachments' => fake()->boolean(30)
                        ]),

                        // Validation Details
                        'validation_status' => json_encode([
                            'content_check' => fake()->boolean(95),
                            'format_check' => fake()->boolean(90),
                            'signature_check' => fake()->boolean(85),
                            'compliance_check' => fake()->boolean(100)
                        ]),

                        // Access Control
                        'access_permissions' => json_encode([
                            'roles' => ['admin', 'manager', 'dispatcher'],
                            'departments' => ['dispatch', 'accounts'],
                            'actions' => ['view', 'download', 'print']
                        ]),

                        // Additional Information
                        'notes' => fake()->boolean(30) ? fake()->sentence() : null,
                        'tags' => json_encode(fake()->words(3)),

                        // Metadata
                        'metadata' => json_encode([
                            'template_version' => '2.0',
                            'generated_from' => 'System',
                            'retention_period' => '7 years',
                            'archival_reference' => fake()->bothify('AR##??###'),
                            'digital_signature' => fake()->boolean(70) ? fake()->sha256() : null
                        ])
                    ]);
                }
            }
        }
    }
}
