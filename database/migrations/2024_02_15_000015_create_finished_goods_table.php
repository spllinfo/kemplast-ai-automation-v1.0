<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finished_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('packing_process_id')->constrained();
            $table->string('fg_batch_number')->unique()->comment('Format: FGmm/dd/yyyy/xxxxxxxxx');
            $table->string('barcode')->unique();
            $table->string('qr_code')->unique();

            // Package Information
            $table->enum('package_type', ['Bundle', 'Box', 'Carton']);
            $table->integer('units_count')->comment('Number of bags/pieces');
            $table->decimal('package_weight', 8, 2)->comment('in kg');
            $table->integer('package_number')->comment('Sequential number within the process');

            // Product Details
            $table->string('part_name');
            $table->string('part_id');
            $table->string('customer_code');
            $table->json('product_specifications');

            // Quality Parameters
            $table->boolean('final_inspection_passed')->default(false);
            $table->json('quality_checks')->nullable();
            $table->string('quality_status')->default('pending');
            $table->text('quality_notes')->nullable();

            // Storage Information
            $table->string('fg_store_location');
            $table->string('storage_area')->nullable();
            $table->string('rack_number')->nullable();
            $table->json('storage_conditions')->nullable();
            $table->datetime('storage_date')->nullable();

            // Dispatch Planning
            $table->string('dispatch_reference')->nullable();
            $table->datetime('planned_dispatch_date')->nullable();
            $table->string('customer_po_number')->nullable();

            // Status and Movement
            $table->enum('status', [
                'in_packing',
                'quality_check',
                'ready_for_storage',
                'in_storage',
                'allocated',
                'dispatched',
                'rejected'
            ])->default('in_packing');
            $table->json('movement_history')->nullable();

            // Operator and Shift
            $table->string('packing_operator')->nullable();
            $table->string('quality_inspector')->nullable();
            $table->string('shift_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['packing_process_id', 'fg_batch_number']);
            $table->index(['barcode', 'qr_code']);
            $table->index('status');
            $table->index(['customer_code', 'customer_po_number']);
            $table->index('fg_store_location');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finished_goods');
    }
};