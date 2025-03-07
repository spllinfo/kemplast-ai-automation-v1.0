<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('part_stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('part_stock_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            
            // Transaction Details
            $table->string('transaction_number')->unique();
            $table->enum('transaction_type', [
                'receipt',
                'issue',
                'return',
                'adjustment',
                'transfer',
                'quality_hold',
                'quality_release'
            ]);
            
            // Quantity Information
            $table->decimal('quantity', 12, 3);
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->string('uom')->comment('Unit of Measure');
            
            // Reference Information
            $table->string('reference_number')->nullable();
            $table->string('reference_type')->nullable();
            $table->json('reference_details')->nullable();
            
            // Location Information
            $table->string('from_location')->nullable();
            $table->string('to_location')->nullable();
            
            // Quality Information
            $table->string('batch_number')->nullable();
            $table->string('quality_status')->nullable();
            $table->json('quality_parameters')->nullable();
            
            // Additional Details
            $table->text('remarks')->nullable();
            $table->string('processed_by');
            $table->string('authorized_by')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['part_stock_id', 'transaction_type']);
            $table->index('transaction_number');
            $table->index('reference_number');
            $table->index('batch_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('part_stock_transactions');
    }
};