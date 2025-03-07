<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispatch_processes', function (Blueprint $table) {
            $table->id();
            $table->string('dispatch_number')->unique();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            
            // Dispatch Details
            $table->date('dispatch_date');
            $table->date('expected_delivery_date');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', [
                'draft',
                'pending',
                'approved',
                'in_process',
                'dispatched',
                'delivered',
                'cancelled'
            ])->default('draft');
            
            // Shipping Details
            $table->string('shipping_address');
            $table->string('shipping_method');
            $table->string('tracking_number')->nullable();
            $table->string('carrier_name')->nullable();
            $table->json('shipping_documents')->nullable();
            
            // Vehicle Details
            $table->string('vehicle_number')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_contact')->nullable();
            $table->json('vehicle_details')->nullable();
            
            // Additional Information
            $table->text('special_instructions')->nullable();
            $table->json('quality_checklist')->nullable();
            $table->json('packaging_details')->nullable();
            
            // Approval Information
            $table->string('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->text('approval_remarks')->nullable();
            
            // Timestamps and Tracking
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('dispatch_number');
            $table->index(['customer_id', 'status']);
            $table->index('dispatch_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatch_processes');
    }
};