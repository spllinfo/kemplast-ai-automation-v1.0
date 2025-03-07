<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_batches', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('batch_number', 50)->unique();
            $table->foreignId('production_plan_id')->constrained()->onDelete('restrict');
            $table->foreignId('part_id')->constrained('parts')->onDelete('restrict');
            $table->integer('version')->default(1); // For part version tracking

            // Personnel and machine
            $table->foreignId('machine_id')->constrained('machines')->onDelete('restrict');
            $table->foreignId('operator_id')->constrained('users')->onDelete('restrict');

            // Batch details
            $table->enum('status', [
                'pending', 'material_assigned', 'in_production',
                'quality_check', 'completed', 'rejected'
            ])->default('pending')->index();
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium')->index();
            $table->integer('planned_quantity');
            $table->integer('produced_quantity')->default(0);
            $table->integer('rejected_quantity')->default(0);
            $table->decimal('material_cost', 15, 2)->default(0);
            $table->decimal('labor_cost', 15, 2)->default(0);
            $table->decimal('overhead_cost', 15, 2)->default(0);

            // Scheduling
            $table->datetime('scheduled_start_time')->index();
            $table->datetime('actual_start_time')->nullable();
            $table->datetime('completed_time')->nullable();

            // Production metrics
            $table->decimal('efficiency_rate', 5, 2)->nullable();
            $table->integer('total_runtime_minutes')->default(0);
            $table->integer('total_downtime_minutes')->default(0);

            // JSON columns for flexible attributes
            $table->json('quality_parameters')->nullable();
            $table->json('machine_settings')->nullable();
            $table->json('process_parameters')->nullable();
            $table->text('notes')->nullable();

            // Timestamps and tracking
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['status', 'scheduled_start_time']);
            $table->index(['production_plan_id', 'status']);
            $table->index(['part_id', 'version']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_batches');
    }
};
