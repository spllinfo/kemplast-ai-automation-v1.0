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
        Schema::create('job_parts', function (Blueprint $table) {
            $table->id();
            $table->string('job_unique_code')->unique();
                      $table->string('job_part_unique_code')->unique();
                      $table->string('job_part_profile_picture')->nullable();
                      $table->string('job_part_name');
                      $table->string('job_part_model')->nullable();
                      $table->string('job_part_customer_name')->nullable();
                      $table->string('hsn_no')->nullable();
                      $table->decimal('job_part_length', 8, 2)->nullable();
                      $table->decimal('job_part_width', 8, 2)->nullable();
                      $table->decimal('job_part_height', 8, 2)->nullable();
                      $table->decimal('job_part_thickness', 8, 2)->nullable();
                      $table->decimal('job_part_ld_ratio', 8, 2)->nullable();
                      $table->decimal('job_part_lld_ratio', 8, 2)->nullable();
                      $table->decimal('job_part_hd_ratio', 8, 2)->nullable();
                      $table->decimal('job_part_rd_ratio', 8, 2)->nullable();
                      $table->integer('job_part_no_ups')->nullable();
                      $table->decimal('job_part_weight', 8, 2)->nullable();
                      $table->string('job_part_no_sealing_type')->nullable();
                      $table->boolean('job_printing_status')->default(false);
                      $table->string('job_printing_colour')->nullable();
                      $table->integer('job_bundle_qty')->nullable();
                      $table->string('job_part_category')->nullable();
                      $table->text('job_part_description')->nullable();
                      $table->decimal('job_part_price', 10, 2)->nullable();
                      $table->integer('job_part_quantity')->nullable();
                      $table->boolean('job_bst')->default(false);
                      $table->boolean('job_lain')->default(false);
                      $table->boolean('job_flat')->default(false);
                      $table->boolean('job_gazzate')->default(false);
                      $table->boolean('job_bio')->default(false);
                      $table->boolean('job_normal')->default(false);
                      $table->boolean('job_milky')->default(false);
                      $table->boolean('job_roto_printing')->default(false);
                      $table->boolean('job_flexo_printing')->default(false);
                      $table->boolean('job_sideseal')->default(false);
                      $table->boolean('job_recycle_logo')->default(false);
                      $table->string('job_part_status')->default('active');
                      $table->text('job_part_documents')->nullable();
                      $table->text('job_part_tags')->nullable();
                      $table->string('branch_name')->nullable();
                      $table->string('machine_type')->nullable();
                      $table->string('job_status')->default('pending');
                      $table->unsignedBigInteger('user_id')->nullable();
                      $table->unsignedBigInteger('customer_id')->nullable();
                      $table->unsignedBigInteger('machine_id')->nullable();
                      $table->unsignedBigInteger('branch_id')->nullable();
                      $table->unsignedBigInteger('plan_id')->nullable();
                      $table->unsignedBigInteger('part_id')->nullable();
                      $table->timestamps();
                      $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                      $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
                      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
                      $table->foreign('machine_id')->references('id')->on('machines')->onDelete('set null');
                      $table->foreign('plan_id')->references('id')->on('production_plans')->onDelete('set null');
                      $table->foreign('part_id')->references('id')->on('parts')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_parts');
    }
};
