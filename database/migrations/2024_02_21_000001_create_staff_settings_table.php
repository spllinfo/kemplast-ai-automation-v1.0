<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');

            // Notification Settings
            $table->boolean('push_notifications')->default(true);
            $table->boolean('email_notifications')->default(true);
            $table->boolean('sms_notifications')->default(true);
            $table->boolean('in_app_notifications')->default(true);
            $table->json('notification_preferences')->nullable();

            // Security Settings
            $table->boolean('two_factor_auth')->default(false);
            $table->string('preferred_2fa_method')->nullable();
            $table->boolean('biometric_login')->default(false);

            // Access Control Settings
            $table->boolean('user_management_access')->default(false);
            $table->boolean('settings_access')->default(false);
            $table->boolean('financial_reports_access')->default(false);
            $table->boolean('production_plans_access')->default(false);
            $table->boolean('inventory_management_access')->default(false);
            $table->boolean('customer_management_access')->default(false);
            $table->boolean('supplier_management_access')->default(false);
            $table->boolean('employee_management_access')->default(false);
            $table->boolean('stock_alerts_access')->default(false);

            // UI Preferences
            $table->string('theme_preference')->default('light');
            $table->string('language_preference')->default('en');
            $table->integer('items_per_page')->default(10);
            $table->json('dashboard_widgets')->nullable();
            $table->boolean('compact_view')->default(false);

            // Communication Preferences
            $table->json('preferred_contact_methods')->nullable();
            $table->string('preferred_language')->default('en');
            $table->boolean('receive_newsletter')->default(true);
            $table->boolean('receive_marketing_emails')->default(false);

            // Calendar Settings
            $table->string('calendar_view')->default('month');
            $table->boolean('show_weekends')->default(true);
            $table->string('working_days')->default('1,2,3,4,5');
            $table->time('work_start_time')->nullable();
            $table->time('work_end_time')->nullable();

            // Report Settings
            $table->string('default_report_format')->default('pdf');
            $table->json('report_preferences')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_settings');
    }
};
