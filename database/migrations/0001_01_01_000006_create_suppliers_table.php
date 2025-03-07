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
            $table->string('supplier_unique_code')->unique();
            $table->string('supplier_profile_picture')->nullable();
            $table->string('supplier_name');
            $table->string('supplier_mail')->nullable();
            $table->string('supplier_phone')->nullable();
            $table->string('supplier_alt_phone')->nullable();
            $table->string('supplier_gst')->nullable();

            // Contact Information
            $table->string('key_contact')->nullable();
            $table->string('key_contact_designation')->nullable();
            $table->string('key_contact_phone')->nullable();
            $table->string('key_contact_email')->nullable();

            // Secondary Contact
            $table->string('secondary_contact')->nullable();
            $table->string('secondary_contact_designation')->nullable();
            $table->string('secondary_contact_phone')->nullable();
            $table->string('secondary_contact_email')->nullable();

            // Business Details
            $table->string('supplier_business_type')->nullable();
            $table->text('supplier_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pincode')->nullable();
            $table->string('supplier_website')->nullable();

            // Terms and Conditions
            $table->string('supplier_delivery_terms')->nullable();
            $table->string('supplier_payment_terms')->nullable();
            $table->decimal('credit_limit', 12, 2)->nullable();
            $table->integer('lead_time_days')->nullable();
            $table->string('minimum_order_quantity')->nullable();

            // Banking Details
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_ifsc_code')->nullable();
            $table->string('bank_branch')->nullable();

            // Quality and Compliance
            $table->string('quality_certification')->nullable();
            $table->date('quality_certification_expiry')->nullable();
            $table->boolean('iso_certified')->default(false);
            $table->string('iso_certification_number')->nullable();

            // Additional Information
            $table->text('social_media_links')->nullable();
            $table->text('additional_notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'blacklisted'])->default('active');
            $table->decimal('supplier_rating', 2, 1)->nullable();

            // Documents
            $table->string('gst_certificate')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('msme_certificate')->nullable();
            $table->string('other_documents')->nullable();

            // Relationships
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assigned_purchaser_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_purchaser_id')->references('id')->on('users')->onDelete('set null');
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
