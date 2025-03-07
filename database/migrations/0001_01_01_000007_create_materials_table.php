<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('material_code', 20)->unique();
            $table->string('material_name', 100);
            $table->enum('material_type', ['LD', 'LLD', 'HD', 'RD', 'MB', 'OTHER'])->default('OTHER');
            $table->string('material_grade', 50)->nullable();
            $table->enum('material_category', ['Raw Material', 'Finished Good', 'Semi-Finished', 'Packaging'])->default('Raw Material');
            $table->string('material_color', 50)->nullable();

            // Stock Information
            $table->decimal('opening_balance', 12, 3)->default(0);
            $table->decimal('quantity', 12, 3)->default(0);
            $table->string('uom', 10); // Unit of Measure
            $table->decimal('minimum_stock_level', 12, 3)->default(0);
            $table->decimal('maximum_stock_level', 12, 3)->nullable();
            $table->decimal('reorder_point', 12, 3)->default(0);
            $table->decimal('safety_stock', 12, 3)->default(0);

            // Pricing
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->decimal('last_purchase_price', 12, 2)->nullable();
            $table->string('currency', 3)->default('INR');
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->string('hsn_code', 20)->nullable();

            // Physical Properties
            $table->decimal('density', 8, 3)->nullable();
            $table->decimal('melt_flow_index', 8, 3)->nullable();
            $table->json('technical_properties')->nullable();
            $table->decimal('standard_weight', 12, 3)->nullable();
            $table->decimal('standard_length', 12, 3)->nullable();
            $table->decimal('standard_width', 12, 3)->nullable();

            // Storage
            $table->string('warehouse_location', 50)->nullable();
            $table->string('bin_location', 50)->nullable();
            $table->json('storage_conditions')->nullable();
            $table->integer('shelf_life_days')->nullable();

            // Quality
            $table->string('quality_grade', 20)->nullable();
            $table->json('quality_parameters')->nullable();
            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->boolean('requires_inspection')->default(false);
            $table->integer('inspection_interval_days')->nullable();

            // Supplier Info
            $table->unsignedBigInteger('primary_supplier_id')->nullable();
            $table->json('alternative_suppliers')->nullable();
            $table->string('manufacturer_name', 100)->nullable();
            $table->string('brand_name', 100)->nullable();
            $table->integer('lead_time_days')->nullable();
            $table->decimal('minimum_order_quantity', 12, 3)->nullable();

            // Documentation
            $table->string('material_image')->nullable();
            $table->string('msds_document')->nullable(); // Material Safety Data Sheet
            $table->string('technical_datasheet')->nullable();
            $table->string('quality_certificate')->nullable();
            $table->text('notes')->nullable();
            $table->json('certificates')->nullable();

            // Status and Control
            $table->enum('status', [
                'active',
                'inactive',
                'pending_approval',
                'discontinued',
                'out_of_stock',
                'expired'
            ])->default('active');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_returnable')->default(false);
            $table->boolean('is_batch_tracked')->default(true);
            $table->boolean('requires_coa')->default(false); // Certificate of Analysis

            // Tracking
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->timestamp('last_stock_update')->nullable();
            $table->timestamp('last_price_update')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('material_code', 'idx_mat_code');
            $table->index(['material_category', 'material_type'], 'idx_mat_cat_type');
            $table->index('warehouse_location', 'idx_mat_location');
            $table->index('status', 'idx_mat_status');
            $table->index('expiry_date', 'idx_mat_expiry');

            // Foreign Keys
            $table->foreign('primary_supplier_id', 'fk_mat_supplier')
                  ->references('id')
                  ->on('suppliers')
                  ->onDelete('set null');

            $table->foreign('branch_id', 'fk_mat_branch')
                  ->references('id')
                  ->on('branches')
                  ->onDelete('cascade');

            $table->foreign('created_by', 'fk_mat_creator')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->foreign('updated_by', 'fk_mat_updater')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
