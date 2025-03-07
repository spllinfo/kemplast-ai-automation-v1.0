<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('extrusion_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('production_stage_id')->constrained();
            $table->foreignId('material_assignment_id')->constrained();

            // Job Information (from blade)
            $table->string('job_number')->unique();
            $table->string('part_name');
            $table->text('part_description')->nullable();
            $table->string('customer_code')->nullable();

            // Material Specifications
            $table->decimal('ld_ratio', 5, 2)->comment('percentage');
            $table->decimal('lld_ratio', 5, 2)->comment('percentage');
            $table->decimal('hd_ratio', 5, 2)->comment('percentage');
            $table->decimal('rd_ratio', 5, 2)->comment('percentage');
            $table->decimal('total_material_weight', 10, 2);

            // Process Parameters
            $table->decimal('film_thickness', 8, 3)->comment('in microns');
            $table->decimal('film_width', 8, 2)->comment('in mm');
            $table->decimal('film_weight', 8, 2)->comment('in kg');
            $table->integer('line_speed')->comment('meters per minute');

            // Temperature Control
            $table->json('temperature_zones')->comment('Array of temperature readings');
            $table->decimal('melt_temperature', 6, 2);
            $table->decimal('die_temperature', 6, 2);
            $table->json('temperature_history')->nullable()->comment('Temperature logs over time');

            // Machine Settings
            $table->string('machine_id');
            $table->string('machine_name');
            $table->decimal('screw_speed', 6, 2);
            $table->decimal('pressure', 8, 2);
            $table->decimal('blow_up_ratio', 5, 2);
            $table->decimal('frost_line_height', 6, 2);
            $table->json('machine_parameters')->nullable();

            // Output Management
            $table->integer('planned_rolls')->comment('Number of rolls planned');
            $table->integer('completed_rolls')->default(0);
            $table->decimal('target_roll_weight', 8, 2);
            $table->json('roll_details')->nullable()->comment('Individual roll specifications');

            // Quality Control
            $table->decimal('thickness_variance', 5, 2)->nullable();
            $table->json('quality_measurements')->nullable();
            $table->json('quality_checkpoints')->nullable();
            $table->boolean('quality_approved')->default(false);
            $table->string('quality_status')->default('pending');

            // Production Metrics
            $table->integer('total_runtime_minutes');
            $table->integer('downtime_minutes')->default(0);
            $table->text('downtime_reasons')->nullable();
            $table->decimal('power_consumption', 10, 2)->nullable();
            $table->json('production_metrics')->nullable();

            // Output Tracking
            $table->decimal('good_output_quantity', 12, 3);
            $table->decimal('waste_quantity', 12, 3)->default(0);
            $table->json('defect_details')->nullable();

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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extrusion_processes');
    }
};
