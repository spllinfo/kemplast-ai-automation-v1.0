<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cutting_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('production_stage_id')->constrained();
            $table->foreignId('material_assignment_id')->constrained();

            // Job Information
            $table->string('job_number')->unique();
            $table->string('part_name');
            $table->string('part_id');
            $table->text('part_description')->nullable();
            $table->string('customer_code');
            $table->string('hsn_code');

            // Cutting Specifications
            $table->enum('seal_type', ['Side Seal', 'Bottom Seal', 'Center Seal']);
            $table->decimal('bag_length', 8, 2)->comment('in mm');
            $table->decimal('bag_width', 8, 2)->comment('in mm');
            $table->decimal('seal_width', 6, 2)->comment('in mm');
            $table->integer('bags_per_cycle')->comment('Number of bags cut per machine cycle');

            // Machine Assignment
            $table->string('machine_id');
            $table->string('machine_name');
            $table->json('machine_settings');

            // Process Parameters
            $table->integer('machine_speed')->comment('cycles per minute');
            $table->decimal('cutting_temperature', 6, 2)->nullable();
            $table->decimal('sealing_temperature', 6, 2)->nullable();
            $table->json('tension_settings');

            // Material Details
            $table->json('input_rolls')->comment('Array of input roll IDs');
            $table->decimal('total_input_weight', 10, 2);
            $table->integer('planned_quantity')->comment('Total bags to be produced');
            $table->integer('completed_quantity')->default(0);

            // Bundle Specifications
            $table->integer('bags_per_bundle');
            $table->integer('planned_bundles');
            $table->integer('completed_bundles')->default(0);
            $table->decimal('bundle_weight', 6, 2)->comment('Target weight per bundle in kg');

            // Quality Parameters
            $table->json('seal_quality_checks')->nullable();
            $table->json('size_measurements')->nullable();
            $table->json('visual_defects')->nullable();
            $table->boolean('quality_inspection_passed')->default(false);
            $table->json('quality_checkpoints');
            $table->string('quality_status')->default('pending');
            $table->text('quality_notes')->nullable();

            // Production Metrics
            $table->integer('total_runtime_minutes');
            $table->integer('setup_time_minutes');
            $table->integer('downtime_minutes')->default(0);
            $table->json('downtime_reasons')->nullable();
            $table->decimal('power_consumption', 10, 2)->nullable();

            // Output Tracking
            $table->decimal('good_output_quantity', 12, 3)->comment('Number of good bags');
            $table->decimal('waste_quantity', 12, 3)->default(0);
            $table->json('defect_categories')->nullable();
            $table->decimal('material_wastage', 10, 2)->default(0)->comment('in kg');
            $table->decimal('cr_weight', 10, 2)->comment('Core weight in kg');
            $table->decimal('net_weight', 10, 2)->comment('Net good production weight');

            // Process Status
            $table->enum('status', [
                'pending',
                'in_setup',
                'running',
                'paused',
                'completed',
                'on_hold',
                'cancelled'
            ])->default('pending');

            // Timestamps and Tracking
            $table->datetime('planned_start_time');
            $table->datetime('actual_start_time')->nullable();
            $table->datetime('completion_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['branch_id', 'job_number']);
            $table->index(['production_stage_id', 'status']);
            $table->index('customer_code');
            $table->index('machine_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cutting_processes');
    }
};