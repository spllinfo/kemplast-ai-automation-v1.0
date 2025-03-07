<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispatch_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('dispatch_process_id')->constrained();
            
            // Invoice Information
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('due_date');
            $table->enum('status', [
                'draft',
                'pending',
                'approved',
                'paid',
                'partially_paid',
                'overdue',
                'cancelled'
            ])->default('draft');
            
            // Customer Information
            $table->foreignId('customer_id')->constrained();
            $table->string('billing_address');
            $table->string('shipping_address');
            $table->json('contact_details');
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
            
            // Amount Details
            $table->decimal('sub_total', 12, 2);
            $table->decimal('tax_amount', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('shipping_charges', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('balance_amount', 12, 2);
            
            // Payment Terms
            $table->string('payment_terms')->nullable();
            $table->integer('credit_days')->default(0);
            $table->json('payment_schedule')->nullable();
            
            // Additional Details
            $table->text('notes')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->json('attachments')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('invoice_number');
            $table->index(['customer_id', 'status']);
            $table->index('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatch_invoices');
    }
};