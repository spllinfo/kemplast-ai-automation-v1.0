<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_quality_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_stock_id')->constrained();
            $table->foreignId('transaction_id')->nullable()->constrained('material_stock_transactions');
            $table->foreignId('inspector_id')->constrained('users');
            
            // Check Details
            $table->string('check_type'); // inward, periodic, pre-production
            $table->string('batch_number');
            $table->datetime('check_date');
            
            // Parameters
            $table->json('parameters_checked');
            $table->json('test_results');
            $table->string('overall_status');
            
            // Documentation
            $table->json('certificates')->nullable();
            $table->json('test_reports')->nullable();
            $table->text('remarks')->nullable();
            
            // Follow-up
            $table->boolean('requires_action')->default(false);
            $table->string('action_type')->nullable();
            $table->text('action_notes')->nullable();
            $table->datetime('action_deadline')->nullable();
            $table->string('action_status')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['material_stock_id', 'check_type']);
            $table->index('batch_number');
            $table->index('overall_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_quality_checks');
    }
};