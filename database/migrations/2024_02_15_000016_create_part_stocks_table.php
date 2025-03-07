<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('part_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            
            // Part Information
            $table->string('part_number')->unique();
            $table->string('part_name');
            $table->string('part_description')->nullable();
            $table->string('hsn_code');
            $table->enum('part_type', [
                'LDPE Bags',
                'Plastic Rolls',
                'Courier Bags',
                'Bio Degradable Bags',
                'Others'
            ]);
            
            // Customer Information
            $table->string('customer_code');
            $table->string('customer_name');
            
            // Technical Specifications
            $table->decimal('thickness', 8, 3)->comment('in mm');
            $table->decimal('width', 8, 2)->comment('in inches');
            $table->decimal('length', 8, 2)->comment('in inches');
            $table->json('technical_specifications')->nullable();
            
            // Material Requirements
            $table->json('material_composition')->comment('PE, HD, LLD ratios');
            $table->decimal('pe_requirement', 10, 2)->comment('in kg');
            $table->decimal('hd_requirement', 10, 2)->comment('in kg');
            $table->decimal('lld_requirement', 10, 2)->comment('in kg');
            
            // Stock Information
            $table->decimal('minimum_stock', 10, 2)->default(0);
            $table->decimal('maximum_stock', 10, 2)->default(0);
            $table->decimal('reorder_level', 10, 2)->default(0);
            $table->decimal('current_stock', 10, 2)->default(0);
            $table->decimal('in_process_quantity', 10, 2)->default(0);
            $table->decimal('allocated_quantity', 10, 2)->default(0);
            $table->decimal('available_quantity', 10, 2)->default(0);
            
            // Production Parameters
            $table->integer('standard_batch_size');
            $table->decimal('standard_cycle_time', 8, 2)->comment('in minutes');
            $table->json('process_parameters')->nullable();
            $table->json('quality_parameters')->nullable();
            
            // Pricing Information
            $table->decimal('standard_cost', 12, 2)->default(0);
            $table->decimal('last_purchase_price', 12, 2)->default(0);
            $table->decimal('moving_average_price', 12, 2)->default(0);
            
            // Location Information
            $table->string('primary_location')->nullable();
            $table->string('alternate_location')->nullable();
            $table->json('storage_conditions')->nullable();
            
            // Status and Categories
            $table->enum('status', [
                'active',
                'inactive',
                'obsolete',
                'in_development',
                'discontinued'
            ])->default('active');
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            
            // Tracking and History
            $table->json('movement_history')->nullable();
            $table->json('quality_history')->nullable();
            $table->json('price_history')->nullable();
            $table->datetime('last_receipt_date')->nullable();
            $table->datetime('last_issue_date')->nullable();
            $table->datetime('last_stock_count_date')->nullable();
            
            // Documents and References
            $table->json('documents')->nullable()->comment('Technical drawings, specifications, etc.');
            $table->json('certifications')->nullable();
            $table->string('remarks')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['branch_id', 'part_number']);
            $table->index(['customer_code', 'part_type']);
            $table->index('status');
            $table->index(['category', 'sub_category']);
            $table->index('primary_location');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('part_stocks');
    }
};