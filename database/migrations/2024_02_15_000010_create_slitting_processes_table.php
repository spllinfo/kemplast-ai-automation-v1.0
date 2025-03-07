<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slitting_processes', function (Blueprint $table) {
            $table->id();
            $table->string('job_number', 20)->unique();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('restrict');
            $table->foreignId('production_stage_id')->constrained('production_stages')->onDelete('restrict');
            $table->foreignId('material_assignment_id')->constrained('material_assignments')->onDelete('restrict');
            $table->string('part_name', 100);
            $table->string('part_id', 20)->index();
            $table->text('part_description')->nullable();
            $table->string('customer_code', 20)->index();

            // Input roll details
            $table->json('input_roll_details');
            $table->decimal('input_roll_width', 10, 2);
            $table->decimal('input_roll_length', 10, 2);
            $table->decimal('input_roll_weight', 10, 2);

            // Slitting specifications
            $table->json('slitting_pattern');
            $table->unsignedInteger('number_of_cuts');
            $table->json('cut_width_specifications');
            $table->decimal('trim_waste_width', 8, 2);
            $table->json('blade_details');
            $table->json('blade_positions');
            $table->decimal('blade_pressure', 8, 2);

            // Machine details
            $table->string('machine_id', 20)->index();
            $table->string('machine_name', 100);
            $table->json('machine_settings');
            $table->unsignedInteger('machine_speed');
            $table->json('tension_settings');

            // Production metrics
            $table->unsignedInteger('planned_rolls');
            $table->unsignedInteger('completed_rolls')->default(0);
            $table->decimal('total_input_weight', 10, 2);
            $table->decimal('total_output_weight', 10, 2)->default(0);
            $table->decimal('trim_waste_weight', 10, 2)->default(0);
            $table->json('quality_parameters')->nullable();
            $table->json('quality_checkpoints');
            $table->enum('quality_status', ['pending', 'approved', 'rejected'])->default('pending')->index();
            $table->boolean('quality_approved')->default(false);
            $table->text('quality_notes')->nullable();

            // Time tracking
            $table->unsignedInteger('total_runtime_minutes')->default(0);
            $table->unsignedInteger('setup_time_minutes')->default(0);
            $table->unsignedInteger('downtime_minutes')->default(0);
            $table->json('downtime_reasons')->nullable();

            // Performance metrics
            $table->decimal('power_consumption', 10, 2)->default(0);
            $table->decimal('good_output_quantity', 10, 3)->default(0);
            $table->decimal('waste_quantity', 10, 3)->default(0);
            $table->json('defect_categories')->nullable();
            $table->json('production_metrics')->nullable();
            $table->json('roll_inventory')->nullable();
            $table->json('roll_movement')->nullable();

            // Personnel
            $table->foreignId('operator_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('supervisor_id')->constrained('users')->onDelete('restrict');
            $table->json('operator_notes')->nullable();
            $table->json('shift_details');

            // Status and alerts
            $table->enum('status', [
                'pending', 'in_setup', 'running', 'paused',
                'completed', 'on_hold', 'cancelled'
            ])->default('pending')->index();
            $table->json('process_alerts')->nullable();
            $table->json('maintenance_alerts')->nullable();
            $table->json('quality_alerts')->nullable();

            // Timestamps
            $table->timestamp('planned_start_time')->nullable();
            $table->timestamp('actual_start_time')->nullable();
            $table->timestamp('completion_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Additional indexes
            $table->index(['branch_id', 'status']);
            $table->index(['production_stage_id', 'status']);
            $table->index(['actual_start_time', 'completion_time']);
            $table->index(['operator_id', 'status']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slitting_processes');
    }
};
