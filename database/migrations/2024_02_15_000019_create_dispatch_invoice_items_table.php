<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispatch_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispatch_invoice_id')->constrained();
            $table->foreignId('part_stock_id')->constrained();
            
            // Item Details
            $table->string('item_code');
            $table->string('description');
            $table->string('hsn_code');
            
            // Quantity and Pricing
            $table->decimal('quantity', 12, 3);
            $table->string('uom');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('tax_percentage', 5, 2);
            $table->decimal('tax_amount', 12, 2);
            $table->decimal('total_amount', 12, 2);
            
            // Additional Details
            $table->json('specifications')->nullable();
            $table->text('remarks')->nullable();
            
            $table->timestamps();

            // Indexes
            $table->index(['dispatch_invoice_id', 'part_stock_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatch_invoice_items');
    }
};