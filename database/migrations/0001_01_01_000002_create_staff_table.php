<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            // User and Branch Relations
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null');

            // Basic Information
            $table->string('staff_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('alt_phone')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('marital_status')->nullable();

            // Professional Information
            $table->string('designation');
            $table->string('department');
            $table->string('profile_picture')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('joining_date');
            $table->date('confirmation_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->integer('experience_years')->nullable();
            $table->json('skills')->nullable();
            $table->json('certifications')->nullable();
            $table->string('employee_type')->default('permanent');
            $table->string('work_shift')->nullable();

            // Contact Information
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('pincode');

            // Emergency Contact Information
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->text('emergency_contact_address')->nullable();

            // Medical Information
            $table->string('blood_group')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('allergies')->nullable();
            $table->string('health_insurance_provider')->nullable();
            $table->string('health_insurance_id')->nullable();

            // Financial Information
            $table->decimal('basic_salary', 12, 2);
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('aadhar_number')->nullable();
            $table->string('pf_number')->nullable();
            $table->string('esi_number')->nullable();

            // Documents and Compliance
            $table->json('documents')->nullable();
            $table->date('last_background_check')->nullable();
            $table->date('last_medical_checkup')->nullable();
            $table->json('training_completed')->nullable();

            // Status and Hierarchy
            $table->enum('status', [
                'active',
                'inactive',
                'on_leave',
                'terminated',
                'suspended',
                'probation'
            ])->default('active');
            $table->unsignedBigInteger('reporting_to')->nullable();
            $table->integer('leave_balance')->default(0);
            $table->json('performance_ratings')->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('reporting_to')
                  ->references('id')
                  ->on('staff')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
