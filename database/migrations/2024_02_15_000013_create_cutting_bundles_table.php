<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cutting_bundles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cutting_process_id')->constrained();
            $table->string('bundle_batch_number')->unique()->comment('Format: CBmm/dd/yyyy/xxxxxxxxx');
            $table->string('barcode')->unique();
            $table->string('qr_code')->unique();

            // Bundle Specifications
            $table->integer('bag_count')->comment('Number of bags in bundle');
            $table->decimal('bundle_weight', 6, 2)->comment('in kg');
            $table->integer('bundle_number')->comment('Sequential number within the process');

            // Bag Specifications
            $table->decimal('bag_length', 8, 2)->comment('in mm');
            $table->decimal('bag_width', 8, 2)->comment('in mm');
            $table->decimal('seal_width', 6, 2)->comment('in mm');
            $table->enum('seal_type', ['Side Seal', 'Bottom Seal', 'Center Seal']);

            // Quality Parameters
            $table->boolean('seal_quality_passed')->nullable();
            $table->json('size_measurements')->nullable();
            $table->boolean('visual_inspection_passed')->nullable();
            $table->json('quality_checks')->nullable();
            $table->string('quality_status')->default('pending');
            $table->boolean('quality_approved')->default(false);
            $table->text('quality_notes')->nullable();

            // Process Details
            $table->string('machine_id');
            $table->json('machine_settings')->nullable();
            $table->json('process_parameters')->nullable();
            $table->string('operator_id')->nullable();

            // Status and Location
            $table->enum('status', [
                'in_production',
                'completed',
                'in_quality_check',
                'approved',
                'rejected',
                'in_transit',
                'at_next_stage'
            ])->default('in_production');
            $table->string('current_location')->nullable();
            $table->json('movement_history')->nullable();

            // Next Process Assignment
            $table->string('next_process')->nullable();
            $table->datetime('next_process_scheduled_time')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['cutting_process_id', 'bundle_batch_number']);
            $table->index(['barcode', 'qr_code']);
            $table->index('status');
            $table->index('machine_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cutting_bundles');
    }
};