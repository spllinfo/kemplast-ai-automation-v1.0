<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispatch_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispatch_invoice_id')->constrained();
            
            // Payment Details
            $table->string('payment_number')->unique();
            $table->decimal('amount', 12, 2);
            $table->date('payment_date');
            $table->enum('payment_mode', [
                'cash',
                'cheque',
                'bank_transfer',
                'upi',
                'credit_card',
                'other'
            ]);
            
            // Transaction Details
            $table->string('transaction_id')->nullable();
            $table->string('reference_number')->nullable();
            $table->json('payment_details')->nullable();
            
            // Bank Details
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('cheque_number')->nullable();
            $table->date('cheque_date')->nullable();
            
            // Status
            $table->enum('status', [
                'pending',
                'completed',
                'failed',
                'reversed'
            ])->default('pending');
            
            // Additional Details
            $table->text('remarks')->nullable();
            $table->string('processed_by');
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('payment_number');
            $table->index(['dispatch_invoice_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatch_payments');
    }
};