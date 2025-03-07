<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('part_documents')) {
            Schema::create('part_documents', function (Blueprint $table) {
                $table->id();
                $table->foreignId('part_id')->constrained()->onDelete('cascade');
                $table->string('document_name');
                $table->string('file_path');
                $table->string('file_type');
                $table->integer('file_size')->comment('in bytes');
                $table->string('uploaded_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('part_documents');
    }
};
