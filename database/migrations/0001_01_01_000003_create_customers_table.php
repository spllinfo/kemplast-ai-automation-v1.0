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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_unique_code')->unique();
            $table->string('company_profile_picture')->nullable();
            $table->string('company_name');
            $table->string('contact_person');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('alt_phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode', 10)->nullable();

            // Tax Information
            $table->string('gst_number', 15)->nullable();
            $table->string('pan_number', 10)->nullable();
            $table->string('tin_number', 20)->nullable();
            $table->string('cst_number', 20)->nullable();
            $table->string('website')->nullable();

            // Business Information
            $table->decimal('credit_limit', 12, 2)->nullable();
            $table->enum('payment_terms', ['advance', '15_days', '30_days', '45_days', '60_days'])->nullable();
            $table->string('tax_registration_number', 20)->nullable();
            $table->string('tax_exemption_number', 20)->nullable();
            $table->enum('business_type', ['manufacturer', 'distributor', 'retailer', 'wholesaler', 'importer', 'exporter'])->nullable();
            $table->string('industry_type')->nullable();
            $table->enum('customer_group', ['retail', 'wholesale', 'corporate', 'government'])->nullable();
            $table->enum('company_size', ['Startup', 'Micro Business', 'Small Business', 'Medium Size', 'Corporate', 'Large Enterprise'])->nullable();
            $table->enum('status', ['active', 'inactive', 'blacklisted'])->default('active');
            $table->text('notes')->nullable();


            // Documents and Details
            $table->json('documents')->nullable();
            $table->json('bank_details')->nullable();
            $table->json('preferences')->nullable();
            $table->json('metadata')->nullable();

            // Relationships
            $table->unsignedBigInteger('sales_person_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('sales_person_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->foreign('branch_id')
                  ->references('id')
                  ->on('branches')
                  ->onDelete('set null');

            // Indexes
            $table->index(['status', 'customer_group']);
            $table->index(['city', 'state', 'country']);
            $table->index('sales_person_id');
            $table->index('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
