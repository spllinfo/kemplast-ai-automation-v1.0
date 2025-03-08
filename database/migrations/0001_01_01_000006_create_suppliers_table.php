<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('supplier_code', 20)->unique();
            $table->string('company_name', 100);
            $table->string('contact_person', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20);
            $table->string('alt_phone', 20)->nullable();

            // Address Information
            $table->text('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('country', 50)->default('India');
            $table->string('pincode', 10)->nullable();

            // Tax Information
            $table->string('gst_number', 20)->nullable();
            $table->string('pan_number', 20)->nullable();
            $table->string('tin_number', 20)->nullable();
            $table->string('cst_number', 20)->nullable();

            // Additional Information
            $table->string('website')->nullable();
            $table->decimal('credit_limit', 12, 2)->nullable();
            $table->string('payment_terms', 50)->nullable();
            $table->string('tax_registration_number', 30)->nullable();
            $table->string('tax_exemption_number', 30)->nullable();

            // Classification
            $table->enum('business_type', ['manufacturer', 'distributor', 'wholesaler', 'retailer', 'importer', 'other'])
                  ->default('other');
            $table->string('industry_type', 50)->nullable();
            $table->string('supplier_group', 50)->nullable();

            // Status and Notes
            $table->enum('status', ['active', 'inactive', 'blacklisted', 'pending'])->default('active');
            $table->text('notes')->nullable();

            // JSON Fields
            $table->json('documents')->nullable(); // Store document URLs
            $table->json('bank_details')->nullable();
            $table->json('preferences')->nullable(); // Communication preferences, etc.
            $table->json('metadata')->nullable(); // Additional dynamic data

            // Tracking
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->foreign('updated_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            // Indexes
            $table->index('supplier_code');
            $table->index('company_name');
            $table->index('status');
            $table->index(['city', 'state', 'country']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
