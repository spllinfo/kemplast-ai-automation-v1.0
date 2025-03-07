<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('extrusion_rolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extrusion_process_id')->constrained();
            $table->string('roll_number')->unique();
            $table->string('barcode')->unique();
            $table->string('qr_code')->unique();
            
            // Roll Specifications
            $table->decimal('weight', 10, 2)->comment('in kg');
            $table->decimal('length', 10, 2)->comment('in meters');
            $table->decimal('width', 8, 2)->comment('in mm');
            $table->decimal('thickness', 8, 3)->comment('in microns');
            
            // Quality Parameters
            $table->json('quality_measurements')->nullable();
            $table->string('quality_status')->default('pending');
            $table->boolean('quality_approved')->default(false);
            $table->text('quality_notes')->nullable();
            
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
            $table->index(['extrusion_process_id', 'roll_number']);
            $table->index(['barcode', 'qr_code']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extrusion_rolls');
    }
};