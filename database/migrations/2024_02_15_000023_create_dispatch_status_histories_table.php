<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispatch_status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispatch_process_id');

            // Status Change Details
            $table->string('from_status');
            $table->string('to_status');
            $table->text('remarks')->nullable();

            // Location and Timestamp
            $table->string('location')->nullable();
            $table->json('location_details')->nullable();
            $table->timestamp('status_timestamp');

            // User Information
            $table->string('changed_by');
            $table->json('additional_info')->nullable();

            $table->timestamps();

            // Foreign key with shorter name
            $table->foreign('dispatch_process_id', 'fk_dsh_process')
                ->references('id')
                ->on('dispatch_processes')
                ->onDelete('cascade');

            // Indexes with shorter names
            $table->index(['dispatch_process_id', 'status_timestamp'], 'idx_dsh_proc_time');
            $table->index('from_status', 'idx_dsh_from_status');
            $table->index('to_status', 'idx_dsh_to_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatch_status_histories');
    }
};
