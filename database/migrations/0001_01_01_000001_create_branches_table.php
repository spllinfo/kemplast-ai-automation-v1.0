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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('type', ['headquarters', 'manufacturing', 'warehouse', 'distribution', 'retail', 'office']);
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');

            // Location details
            $table->text('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country')->default('India');
            $table->string('pincode', 10)->nullable();

            // Contact details
            $table->string('phone', 20);
            $table->string('email')->unique();
            $table->string('website')->nullable();

            // Tax details
            $table->string('gst_number', 15)->nullable();
            $table->string('pan_number', 10)->nullable();
            $table->string('tin_number', 30)->nullable();
            $table->string('cst_number', 30)->nullable();

            // Contact person details
            $table->string('contact_person')->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->string('contact_email')->nullable();

            // Operational details
            $table->json('operating_hours')->nullable();
            $table->json('facilities')->nullable();
            $table->json('settings')->nullable();
            $table->json('metadata')->nullable();
            $table->integer('max_capacity')->nullable();
            $table->integer('current_employees')->nullable();

            // Relationships
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('parent_branch_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('manager_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->foreign('parent_branch_id')
                  ->references('id')
                  ->on('branches')
                  ->onDelete('set null');

            // Indexes
            $table->index(['type', 'status']);
            $table->index(['city', 'state', 'country']);
            $table->index('manager_id');
            $table->index('parent_branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
