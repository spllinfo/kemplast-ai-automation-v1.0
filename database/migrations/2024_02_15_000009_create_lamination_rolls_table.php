<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamination_rolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamination_process_id')
                ->constrained('lamination_processes')
                ->onDelete('restrict');

            // Roll identification
            $table->string('roll_batch_number', 20)->unique();
            $table->string('barcode', 50)->unique();
            $table->uuid('qr_code')->unique();

            // Physical properties
            $table->decimal('weight', 10, 2)->comment('Weight in kg');
            $table->decimal('length', 10, 2)->comment('Length in meters');
            $table->decimal('width', 10, 2)->comment('Width in mm');
            $table->unsignedInteger('number_of_layers');
            $table->json('layer_details');

            // Quality measurements
            $table->decimal('bond_strength', 10, 2)->comment('Strength in gf/25mm');
            $table->boolean('delamination_test_passed')->default(false);
            $table->json('coating_uniformity');
            $table->json('quality_measurements')->nullable();
            $table->enum('quality_status', ['pending', 'passed', 'failed'])->default('pending')->index();
            $table->boolean('quality_approved')->default(false);
            $table->text('quality_notes')->nullable();

            // Process details
            $table->enum('lamination_type', ['solvent_based', 'solventless', 'water_based', 'thermal'])->index();
            $table->json('adhesive_details');
            $table->decimal('adhesive_consumption', 8, 2)->comment('Consumption in kg');
            $table->timestamp('curing_start_time')->nullable();
            $table->timestamp('curing_end_time')->nullable();

            // Machine details
            $table->string('machine_id', 20)->index();
            $table->json('machine_settings');
            $table->json('process_parameters');

            // Status and location
            $table->enum('status', [
                'in_production',
                'in_curing',
                'curing_completed',
                'in_quality_check',
                'approved',
                'rejected',
                'in_transit',
                'at_next_stage'
            ])->default('in_production')->index();
            $table->string('current_location', 100)->index();
            $table->json('movement_history');
            $table->string('next_process', 50)->nullable()->index();
            $table->timestamp('next_process_scheduled_time')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Additional indexes
            $table->index(['lamination_process_id', 'status']);
            $table->index(['quality_status', 'quality_approved']);
            $table->index(['status', 'current_location']);
            $table->index(['curing_start_time', 'curing_end_time']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamination_rolls');
    }
};
