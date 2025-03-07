<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_plans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('plan_code', 50)->unique();
            $table->string('title');
            $table->text('description')->nullable();

            // Planning Details
            $table->enum('type', ['regular', 'rush', 'prototype', 'custom'])->default('regular')->index();
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium')->index();
            $table->enum('status', [
                'draft', 'pending', 'approved', 'in_progress',
                'completed', 'cancelled', 'on_hold'
            ])->default('draft')->index();

            // Dates
            $table->date('planned_start_date')->index();
            $table->date('planned_end_date')->index();
            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();

            // Financial tracking
            $table->decimal('estimated_cost', 15, 2);
            $table->decimal('actual_cost', 15, 2)->default(0);
            $table->decimal('budget', 15, 2);
            $table->decimal('material_cost', 15, 2)->default(0);
            $table->decimal('labor_cost', 15, 2)->default(0);
            $table->decimal('overhead_cost', 15, 2)->default(0);

            // Production metrics
            $table->integer('total_quantity');
            $table->integer('completed_quantity')->default(0);
            $table->integer('rejected_quantity')->default(0);
            $table->integer('estimated_hours');
            $table->integer('actual_hours')->default(0);
            $table->decimal('completion_percentage', 5, 2)->default(0);
            $table->decimal('efficiency_rate', 5, 2)->nullable();

            // Location and assignment
            $table->string('production_line')->nullable();
            $table->string('location');
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('department_id')->nullable()->constrained();

            // Stakeholders
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('project_manager_id')->nullable()->constrained('users');

            // Additional data
            $table->json('quality_parameters')->nullable();
            $table->json('machine_requirements')->nullable();
            $table->json('material_requirements')->nullable();
            $table->json('metadata')->nullable();
            $table->text('notes')->nullable();

            // Timestamps with soft deletes
            $table->timestamps();
            $table->softDeletes();

            // Additional indexes
            $table->index(['status', 'planned_start_date']);
            $table->index(['created_at', 'status']);
            $table->index(['branch_id', 'status']);
            $table->index(['type', 'priority']);
            $table->index(['customer_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_plans');
    }
};
