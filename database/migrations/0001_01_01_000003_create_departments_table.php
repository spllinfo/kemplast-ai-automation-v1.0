<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->string('main_department');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('head_of_department')->nullable();
            $table->integer('head_count')->default(0);
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->json('settings')->nullable();
            $table->json('metadata')->nullable();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('departments')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('name');
            $table->index('code');
            $table->index('status');
            $table->index('main_department');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
