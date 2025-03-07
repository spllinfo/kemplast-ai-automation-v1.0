<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('part_unique_code', 50)->unique();
            $table->string('part_name', 100);
            $table->string('part_category', 50)->nullable();
            $table->string('part_model', 50)->nullable();
            $table->string('hsn_no', 20)->nullable();
            $table->string('reel_size', 20)->nullable();

            // Dimensions
            $table->decimal('part_length', 10, 3)->nullable();
            $table->decimal('part_width', 10, 3)->nullable();
            $table->decimal('part_height', 10, 3)->nullable();
            $table->decimal('part_thickness', 10, 3)->nullable();

            // Material Ratios
            $table->decimal('part_ld_ratio', 8, 3)->nullable();
            $table->decimal('part_lld_ratio', 8, 3)->nullable();
            $table->decimal('part_hd_ratio', 8, 3)->nullable();
            $table->decimal('part_rd_ratio', 8, 3)->nullable();
            $table->decimal('part_weight', 12, 3)->nullable();
            $table->decimal('part_price', 12, 2)->nullable();

            // Production Details
            $table->unsignedInteger('no_ups')->nullable();
            $table->string('sealing_type', 50)->nullable();
            $table->boolean('printing_status')->default(false);
            $table->string('printing_colour', 50)->nullable();
            $table->unsignedInteger('bundle_qty')->nullable();
            $table->unsignedInteger('part_quantity')->nullable();

            // Toggle Properties
            $table->boolean('bst')->default(false);
            $table->boolean('plain')->default(false);
            $table->boolean('flat')->default(false);
            $table->boolean('gazzate')->default(false);
            $table->boolean('bio')->default(false);
            $table->boolean('normal')->default(false);
            $table->boolean('milky')->default(false);
            $table->boolean('roto_printing')->default(false);
            $table->boolean('flexo_printing')->default(false);
            $table->boolean('recycle_logo')->default(false);

            // Basic Properties
            $table->text('part_description')->nullable();
            $table->string('part_profile_picture')->nullable();
            $table->json('part_tags')->nullable();
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');

            // Foreign Keys
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes with shorter names
            $table->index('part_unique_code', 'idx_part_code');
            $table->index('part_category', 'idx_part_category');
            $table->index('status', 'idx_part_status');
            $table->index(['created_at', 'deleted_at'], 'idx_part_timestamps');
            $table->index(['part_name', 'part_category'], 'idx_part_name_cat');

            // Foreign key constraints with shorter names
            $table->foreign('branch_id', 'fk_part_branch')
                ->references('id')
                ->on('branches')
                ->onDelete('set null');

            $table->foreign('customer_id', 'fk_part_customer')
                ->references('id')
                ->on('customers')
                ->onDelete('set null');

            $table->foreign('user_id', 'fk_part_user')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parts');
    }
};
