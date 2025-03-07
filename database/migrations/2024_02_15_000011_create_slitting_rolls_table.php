<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slitting_rolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slitting_process_id')
                ->constrained('slitting_processes')
                ->onDelete('restrict');
            $table->foreignId('parent_roll_id')
                ->nullable()
                ->constrained('lamination_rolls')
                ->onDelete('restrict');

            // Roll identification
            $table->string('roll_batch_number', 20)->unique();
            $table->string('barcode', 50)->unique();
            $table->uuid('qr_code')->unique();
            $table->unsignedInteger('slit_number')->comment('Position number in slitting sequence');

            // Physical properties
            $table->decimal('weight', 10, 2)->comment('Weight in kg');
            $table->decimal('length', 10, 2)->comment('Length in meters');
            $table->decimal('width', 10, 2)->comment('Width in mm');
            $table->decimal('diameter', 10, 2)->comment('Diameter in mm');

            // Core and edge details
            $table->json('core_details');
            $table->json('edge_quality');
            $table->decimal('edge_trim_width', 8, 2)->comment('Width in mm');
            $table->json('tension_values');

            // Quality information
            $table->json('quality_measurements')->nullable();
            $table->enum('quality_status', ['pending', 'passed', 'failed'])->default('pending')->index();
            $table->boolean('quality_approved')->default(false);
            $table->text('quality_notes')->nullable();
            $table->json('defects_found')->nullable();

            // Machine details
            $table->string('machine_id', 20)->index();
            $table->json('machine_settings');
            $table->json('process_parameters');

            // Status and location
            $table->enum('status', [
                'in_production',
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
            $table->index(['slitting_process_id', 'status']);
            $table->index(['quality_status', 'quality_approved']);
            $table->index(['status', 'current_location']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slitting_rolls');
    }
};
