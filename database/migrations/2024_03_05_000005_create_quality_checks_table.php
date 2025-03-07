<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quality_checks', function (Blueprint $table) {
            $table->id();
            $table->string('check_code', 20)->unique();
            $table->morphs('checkable'); // For polymorphic relationship with ProductionBatch and ProductionStage
            $table->json('parameters');
            $table->decimal('score', 5, 2);
            $table->text('notes')->nullable();
            $table->foreignId('checked_by')->constrained('users')->onDelete('restrict');
            $table->timestamp('checked_at');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('check_code');
            $table->index('checked_at');
            $table->index(['checked_by', 'checked_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quality_checks');
    }
};
