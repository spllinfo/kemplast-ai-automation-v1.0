<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispatch_stock_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispatch_process_id')->constrained();
            $table->foreignId('part_stock_id')->constrained();
            
            // Stock Update Details
            $table->string('reference_number')->unique();
            $table->decimal('quantity', 12, 3);
            $table->string('uom');
            $table->enum('update_type', [
                'dispatch_allocation',
                'dispatch_confirmation',
                'return',
                'adjustment'
            ]);
            
            // Location Details
            $table->string('from_location');
            $table->string('to_location')->nullable();
            
            // Batch Information
            $table->string('batch_number');
            $table->json('batch_details')->nullable();
            
            // Quality Information
            $table->boolean('quality_checked')->default(false);
            $table->json('quality_parameters')->nullable();
            $table->string('quality_status')->nullable();
            
            // Additional Details
            $table->text('remarks')->nullable();
            $table->string('processed_by');
            $table->timestamp('processed_at');
            
            $table->timestamps();

            // Indexes
            $table->index('reference_number');
            $table->index(['dispatch_process_id', 'part_stock_id']);
            $table->index('batch_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatch_stock_updates');
    }
};