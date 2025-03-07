<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_stages', function (Blueprint $table) {
            $table->id();
            $table->string('stage_code', 20)->unique();
            $table->foreignId('production_plan_id')
                ->constrained('production_plans')
                ->onDelete('restrict');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->unsignedInteger('sequence');

            // Status and timing
            $table->enum('status', [
                'pending',
                'in_progress',
                'completed',
                'failed'
            ])->default('pending')->index();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->unsignedInteger('planned_duration')->comment('Duration in minutes');
            $table->integer('actual_duration')->nullable()->comment('Duration in minutes');

            // Quantity tracking
            $table->unsignedInteger('planned_quantity');
            $table->unsignedInteger('actual_quantity')->default(0);
            $table->unsignedInteger('rejected_quantity')->default(0);

            // Requirements and specifications
            $table->json('quality_parameters')->nullable();
            $table->json('machine_requirements')->nullable();
            $table->json('operator_requirements')->nullable();
            $table->json('material_requirements')->nullable();

            // Notes and metadata
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('stage_code');
            $table->index(['production_plan_id', 'sequence']);
            $table->index(['production_plan_id', 'status']);
            $table->index(['start_time', 'end_time']);
            $table->index('created_at');

            // Unique constraint for sequence within a production plan
            $table->unique(['production_plan_id', 'sequence'], 'unique_sequence_per_plan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_stages');
    }
};
