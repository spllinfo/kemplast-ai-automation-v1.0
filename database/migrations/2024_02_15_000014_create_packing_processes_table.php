<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packing_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('production_stage_id')->constrained();
            $table->foreignId('cutting_process_id')->constrained();

            // Job Information
            $table->string('job_number')->unique();
            $table->string('part_name');
            $table->string('part_id');
            $table->text('part_description')->nullable();
            $table->string('customer_code');
            $table->string('customer_name');
            $table->string('hsn_code');

            // Packing Specifications
            $table->integer('bags_per_bundle');
            $table->integer('bundles_per_box')->nullable();
            $table->decimal('target_box_weight', 8, 2)->nullable()->comment('in kg');
            $table->string('packing_type')->comment('Bundle/Box/Carton');
            $table->json('packing_instructions')->nullable();

            // Input Materials
            $table->json('input_bundles')->comment('Array of cutting bundle IDs');
            $table->decimal('total_input_weight', 10, 2);
            $table->integer('total_input_bags');

            // Output Specifications
            $table->integer('planned_boxes')->nullable();
            $table->integer('completed_boxes')->default(0);
            $table->integer('planned_bundles');
            $table->integer('completed_bundles')->default(0);

            // Quality Parameters
            $table->json('quality_checkpoints');
            $table->json('visual_inspection_points')->nullable();
            $table->boolean('quality_inspection_passed')->default(false);
            $table->string('quality_status')->default('pending');
            $table->text('quality_notes')->nullable();

            // Packaging Materials
            $table->json('packaging_materials')->comment('Array of materials used (boxes, tapes, etc)');
            $table->json('material_consumption')->nullable();

            // Production Metrics
            $table->integer('total_runtime_minutes');
            $table->integer('setup_time_minutes');
            $table->integer('downtime_minutes')->default(0);
            $table->json('downtime_reasons')->nullable();

            // Output Tracking
            $table->decimal('good_output_quantity', 12, 3)->comment('Number of good packed units');
            $table->decimal('rejected_quantity', 12, 3)->default(0);
            $table->json('rejection_reasons')->nullable();
            $table->decimal('material_wastage', 10, 2)->default(0)->comment('in kg');
            $table->decimal('net_packed_weight', 10, 2)->comment('Total good packed weight');

            // FG Store Details
            $table->string('fg_store_location')->nullable();
            $table->string('storage_area')->nullable();
            $table->string('rack_number')->nullable();
            $table->json('storage_conditions')->nullable();

            // Process Status
            $table->enum('status', [
                'pending',
                'in_progress',
                'quality_check',
                'completed',
                'on_hold',
                'cancelled'
            ])->default('pending');

            // Timestamps and Tracking
            $table->datetime('planned_start_time');
            $table->datetime('actual_start_time')->nullable();
            $table->datetime('completion_time')->nullable();
            $table->string('shift_id')->nullable();
            $table->string('operator_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['branch_id', 'job_number']);
            $table->index(['production_stage_id', 'status']);
            $table->index('customer_code');
            $table->index('fg_store_location');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packing_processes');
    }
};