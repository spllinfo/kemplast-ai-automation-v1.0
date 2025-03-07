<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_mixing_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_assignment_id')->constrained();
            $table->string('batch_number')->unique();

            // Batch Details
            $table->integer('batch_sequence')->comment('1, 2, 3 etc.');
            $table->decimal('batch_weight', 10, 2);
            $table->datetime('mixing_start_time');
            $table->datetime('mixing_end_time')->nullable();

            // Material Quantities
            $table->json('material_quantities')->comment('Actual quantities used in this batch');
            $table->json('mixing_parameters')->comment('Temperature, time, speed etc.');

            // Quality Checks
            $table->json('quality_parameters')->nullable();
            $table->string('quality_status')->default('pending');
            $table->text('quality_notes')->nullable();

            // Operator Details
            $table->foreignId('operator_id')->constrained('users');
            $table->text('operator_notes')->nullable();

            // Batch Status
            $table->enum('status', [
                'pending',
                'in_process',
                'completed',
                'rejected',
                'on_hold'
            ])->default('pending');

            // Tracking
            $table->string('current_location')->nullable();
            $table->json('movement_history')->nullable();

            $table->timestamps();

            // Indexes with shorter names
            $table->index(['material_assignment_id', 'batch_sequence'], 'idx_mmb_assignment_seq');
            $table->index('status', 'idx_mmb_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_mixing_batches');
    }
};
