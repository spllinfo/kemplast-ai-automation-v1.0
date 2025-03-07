<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('printing_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('production_stage_id')->constrained();
            $table->foreignId('material_assignment_id')->constrained();

            // Job Information (from blade)
            $table->string('job_number')->unique();
            $table->string('part_name');
            $table->string('part_id');
            $table->text('part_description')->nullable();
            $table->string('customer_code');

            // Print Specifications
            $table->enum('print_type', ['flexo', 'roto'])->index();
            $table->integer('number_of_colors');
            $table->json('color_details')->comment('Array of colors and their positions');
            $table->string('artwork_reference')->nullable();
            $table->json('artwork_files')->nullable();

            // Machine Assignment
            $table->string('machine_id');
            $table->string('machine_name');
            $table->json('machine_settings')->nullable();

            // Process Parameters
            $table->integer('printing_speed')->comment('meters per minute');
            $table->json('tension_settings')->nullable();
            $table->json('registration_marks')->nullable();
            $table->json('print_parameters')->nullable();

            // Material Details
            $table->json('input_rolls')->comment('Array of input roll IDs');
            $table->decimal('total_input_weight', 10, 2);
            $table->integer('planned_rolls')->comment('Number of output rolls planned');
            $table->integer('completed_rolls')->default(0);

            // Ink Management
            $table->json('ink_consumption')->comment('Per color ink usage in kg');
            $table->json('ink_batch_numbers')->nullable();
            $table->decimal('total_ink_cost', 10, 2);
            $table->json('ink_inventory')->nullable();

            // Quality Control
            $table->json('color_density_readings')->nullable();
            $table->json('registration_accuracy')->nullable();
            $table->boolean('adhesion_test_passed')->nullable();
            $table->json('quality_checkpoints')->nullable();
            $table->string('quality_status')->default('pending');
            $table->boolean('quality_approved')->default(false);
            $table->text('quality_notes')->nullable();

            // Production Metrics
            $table->integer('total_runtime_minutes');
            $table->integer('setup_time_minutes');
            $table->integer('downtime_minutes')->default(0);
            $table->text('downtime_reasons')->nullable();
            $table->decimal('power_consumption', 10, 2)->nullable();

            // Output Tracking
            $table->decimal('good_output_quantity', 12, 3);
            $table->decimal('waste_quantity', 12, 3)->default(0);
            $table->json('defect_categories')->nullable();
            $table->json('production_metrics')->nullable();

            // Roll Tracking
            $table->json('roll_inventory')->nullable()->comment('Current status of each roll');
            $table->json('roll_movement')->nullable()->comment('Movement history of rolls');

            // Operator Management
            $table->foreignId('operator_id')->constrained('users');
            $table->foreignId('supervisor_id')->nullable()->constrained('users');
            $table->json('operator_notes')->nullable();
            $table->json('shift_details')->nullable();

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

            // Monitoring and Alerts
            $table->json('process_alerts')->nullable();
            $table->json('maintenance_alerts')->nullable();
            $table->json('quality_alerts')->nullable();

            // Timestamps and Tracking
            $table->datetime('planned_start_time');
            $table->datetime('actual_start_time')->nullable();
            $table->datetime('completion_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['branch_id', 'job_number']);
            $table->index(['machine_id', 'status']);
            $table->index('customer_code');
            $table->index(['production_stage_id', 'print_type']);
            $table->index(['production_stage_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('printing_processes');
    }
};
