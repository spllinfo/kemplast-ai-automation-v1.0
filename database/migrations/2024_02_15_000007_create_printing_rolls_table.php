<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('printing_rolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('printing_process_id')->constrained();
            $table->string('roll_batch_number')->unique()->comment('Format: PRmm/dd/yyyy/xxxxxxxxx');
            $table->string('barcode')->unique();
            $table->string('qr_code')->unique();

            // Roll Specifications
            $table->decimal('weight', 10, 2)->comment('in kg');
            $table->decimal('length', 10, 2)->comment('in meters');
            $table->decimal('width', 8, 2)->comment('in mm');
            $table->string('material_type');

            // Print Quality Parameters
            $table->json('color_density_readings')->nullable();
            $table->json('registration_accuracy')->nullable();
            $table->boolean('adhesion_test_passed')->nullable();
            $table->json('print_defects')->nullable();
            $table->json('quality_measurements')->nullable();
            $table->string('quality_status')->default('pending');
            $table->boolean('quality_approved')->default(false);
            $table->text('quality_notes')->nullable();

            // Print Details
            $table->enum('print_type', ['flexo', 'roto']);
            $table->integer('number_of_colors');
            $table->json('color_details');
            $table->json('ink_consumption')->nullable();
            $table->string('artwork_reference')->nullable();

            // Machine Details
            $table->string('machine_id');
            $table->json('machine_settings')->nullable();
            $table->integer('printing_speed')->nullable();
            $table->json('process_parameters')->nullable();

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
            $table->index(['printing_process_id', 'roll_batch_number']);
            $table->index(['barcode', 'qr_code']);
            $table->index('status');
            $table->index('machine_id');
            $table->index('print_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('printing_rolls');
    }
};
