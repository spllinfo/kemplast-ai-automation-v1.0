<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('machine_code', 20)->unique();
            $table->string('name');
            $table->string('model_number', 191)->nullable();
            $table->string('serial_number', 191)->nullable();
            $table->string('manufacturer', 191)->nullable();
            $table->timestamp('manufacturing_date')->nullable();
            $table->timestamp('purchase_date')->nullable();
            $table->timestamp('warranty_start_date')->nullable();
            $table->timestamp('warranty_end_date')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->decimal('current_value', 12, 2)->nullable();
            $table->foreignId('branch_id')->constrained()->onDelete('restrict');
            $table->string('location', 191)->nullable();
            $table->enum('status', ['active', 'maintenance', 'inactive', 'repair', 'scrapped'])->default('active');
            $table->decimal('capacity', 10, 2)->nullable();
            $table->string('capacity_unit', 191)->nullable();
            $table->decimal('power_consumption', 10, 2)->nullable();
            $table->string('power_unit', 191)->nullable();
            $table->decimal('operating_pressure', 10, 2)->nullable();
            $table->string('pressure_unit', 191)->nullable();
            $table->decimal('operating_temperature', 10, 2)->nullable();
            $table->string('temperature_unit', 191)->nullable();
            $table->json('specifications')->nullable();
            $table->json('maintenance_schedule')->nullable();
            $table->json('spare_parts')->nullable();
            $table->json('documents')->nullable();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('machine_code');
            $table->index(['branch_id', 'status']);
            $table->index('location');
            $table->index('manufacturer');
            $table->index(['warranty_start_date', 'warranty_end_date']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
