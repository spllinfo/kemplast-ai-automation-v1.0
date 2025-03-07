<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('supplier_id')->nullable()->constrained();
            
            // Material Basic Info
            $table->string('material_code')->unique();
            $table->string('material_name');
            $table->string('material_grade')->nullable();
            $table->string('material_category');
            $table->string('material_type')->nullable();
            $table->text('material_description')->nullable();
            
            // Stock Metrics
            $table->decimal('quantity', 12, 3);
            $table->string('uom'); // Unit of Measure
            $table->decimal('minimum_stock_level', 12, 3);
            $table->decimal('maximum_stock_level', 12, 3);
            $table->decimal('reorder_level', 12, 3);
            
            // Financial Details
            $table->decimal('unit_price', 12, 2);
            $table->string('currency')->default('INR');
            $table->decimal('total_value', 15, 2);
            $table->json('price_history')->nullable();
            
            // Location & Storage
            $table->string('warehouse_location');
            $table->string('rack_number')->nullable();
            $table->string('bin_number')->nullable();
            $table->json('storage_conditions')->nullable();
            
            // Tracking
            $table->string('batch_number')->nullable();
            $table->string('barcode')->unique();
            $table->string('qr_code')->unique();
            $table->date('manufacturing_date')->nullable();
            $table->date('expiry_date')->nullable();
            
            // Quality Parameters
            $table->string('quality_status')->default('pending');
            $table->json('quality_parameters')->nullable();
            $table->json('certificates')->nullable();
            
            // Usage Tracking
            $table->json('consumption_history')->nullable();
            $table->json('replenishment_history')->nullable();
            $table->timestamp('last_consumed_at')->nullable();
            $table->timestamp('last_replenished_at')->nullable();
            
            // Status and Flags
            $table->boolean('is_active')->default(true);
            $table->boolean('is_blocked')->default(false);
            $table->string('block_reason')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['branch_id', 'material_category']);
            $table->index(['material_code', 'batch_number']);
            $table->index('warehouse_location');
            $table->index('quality_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_stocks');
    }
};