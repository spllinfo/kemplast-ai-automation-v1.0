<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('material_stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_stock_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('user_id')->constrained();

            // Transaction Details
            $table->string('transaction_type'); // inward, outward, transfer, adjustment
            $table->string('reference_number')->unique();
            $table->decimal('quantity', 12, 3);
            $table->string('uom');
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->decimal('total_amount', 15, 2)->nullable();

            // Source/Destination
            $table->string('source_location');
            $table->string('destination_location')->nullable();
            $table->foreignId('source_branch_id')->nullable()->constrained('branches');
            $table->foreignId('destination_branch_id')->nullable()->constrained('branches');

            // Document References
            $table->string('po_number')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('grn_number')->nullable();
            $table->json('document_references')->nullable();

            // Quality Checks
            $table->boolean('quality_check_required')->default(false);
            $table->string('quality_status')->nullable();
            $table->json('quality_parameters')->nullable();

            // Additional Info
            $table->text('remarks')->nullable();
            $table->json('additional_details')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes with shorter names
            $table->index(['material_stock_id', 'transaction_type'], 'idx_mst_stock_type');
            $table->index('reference_number', 'idx_mst_ref_num');
            $table->index(['source_branch_id', 'destination_branch_id'], 'idx_mst_branches');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_stock_transactions');
    }
};
