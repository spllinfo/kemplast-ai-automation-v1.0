<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('breakdowns', function (Blueprint $table) {
            $table->id();
            $table->string('breakdown_code', 20)->unique();
            $table->morphs('breakdownable'); // For polymorphic relationship with ProductionBatch and ProductionStage
            $table->string('description');
            $table->enum('severity', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['reported', 'in_progress', 'resolved', 'closed'])->default('reported');
            $table->text('resolution')->nullable();
            $table->timestamp('reported_at');
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('reported_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('resolved_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('breakdown_code');
            $table->index(['status', 'severity']);
            $table->index(['reported_at', 'resolved_at']);
            $table->index(['reported_by', 'status']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breakdowns');
    }
};
