<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('production_stage_id')->constrained();
            $table->string('assignment_number')->unique();

            // Material Composition (from your blade form)
            $table->json('ld_details')->comment('JSON containing: material_id, ratio, weight, used_weight');
            $table->json('lld_details')->comment('JSON containing: material_id, ratio, weight, used_weight');
            $table->json('hd_details')->comment('JSON containing: material_id, ratio, weight, used_weight');
            $table->json('rd_details')->comment('JSON containing: material_id, ratio, weight, used_weight');

            // Product Specifications
            $table->decimal('thickness', 8, 3)->comment('in mm');
            $table->decimal('width', 8, 2)->comment('in cm');
            $table->decimal('height', 8, 2)->comment('in cm');
            $table->decimal('target_weight', 10, 2)->comment('in grams');

            // Batch Information
            $table->string('batch_number')->index();
            $table->datetime('mixing_date');
            $table->string('mixing_operator')->nullable();

            // Material Status
            $table->enum('status', [
                'pending',
                'in_mixing',
                'mixed',
                'in_process',
                'completed',
                'rejected'
            ])->default('pending');

            // Quality Parameters
            $table->json('mixing_parameters')->nullable()->comment('temperature, humidity, mixing time');
            $table->boolean('quality_checked')->default(false);
            $table->json('quality_results')->nullable();

            // Material Tracking
            $table->decimal('total_assigned_weight', 12, 3);
            $table->decimal('total_consumed_weight', 12, 3)->default(0);
            $table->decimal('total_waste', 12, 3)->default(0);
            $table->decimal('total_returned', 12, 3)->default(0);

            // Batch Processing
            $table->integer('number_of_batches')->default(1);
            $table->json('batch_details')->nullable()->comment('Individual batch mixing details');
            $table->json('batch_status')->nullable();

            // Documentation
            $table->json('mixing_instructions')->nullable();
            $table->text('special_notes')->nullable();
            $table->json('operator_notes')->nullable();

            // Monitoring and Alerts
            $table->json('process_alerts')->nullable();
            $table->json('quality_alerts')->nullable();
            $table->json('inventory_alerts')->nullable();

            // Approval and Verification
            $table->foreignId('assigned_by')->constrained('users');
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->datetime('verified_at')->nullable();

            // Timestamps and Tracking
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['branch_id', 'batch_number']);
            $table->index('status');
            $table->index('mixing_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_assignments');
    }
};
