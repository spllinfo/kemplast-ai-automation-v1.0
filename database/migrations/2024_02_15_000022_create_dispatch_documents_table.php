<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispatch_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispatch_process_id')->constrained();
            
            // Document Details
            $table->string('document_type');
            $table->string('document_number')->unique();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type');
            $table->integer('file_size');
            
            // Document Status
            $table->enum('status', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending');
            
            // Additional Details
            $table->text('remarks')->nullable();
            $table->string('uploaded_by');
            $table->string('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('document_number');
            $table->index(['dispatch_process_id', 'document_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispatch_documents');
    }
};