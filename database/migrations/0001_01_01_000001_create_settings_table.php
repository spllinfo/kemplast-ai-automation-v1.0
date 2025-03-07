<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->string('type')->default('string');
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false);
            $table->boolean('is_system')->default(false);
            $table->timestamps();
        });

        // Pre-populate the settings table with initial values.  This is much
        // better than putting this in the migration's `up` method, because it's
        // separate from the schema definition and can be easily modified.  It
        // also makes it clear that these are *default* settings, not required
        // parts of the table structure.  You can also put this in a seeder
        // (e.g., `SettingsSeeder`) if you prefer.
        $initialSettings = [
            ['key' => 'keyboard_shortcuts', 'value' => 'off'],
            ['key' => 'menu_view', 'value' => 'advanced'],
            ['key' => 'mail_send_actions', 'value' => json_encode([])], // Empty array
            ['key' => 'company_name', 'value' => 'Kemplast Systems'],
            ['key' => 'company_email', 'value' => 'info@kemplast.com'],
            ['key' => 'company_address', 'value' => 'Bainguinim, Baingini, Goa 403402'],
            ['key' => 'company_description', 'value' => 'This is an example company description.'],
            ['key' => 'contact_person', 'value' => 'Contact Person'],
            ['key' => 'company_phone', 'value' => '123-456-7890'],
            ['key' => 'social_media_enabled', 'value' => json_encode([])], // Empty array to store enabled social media
            ['key' => 'facebook', 'value' => 'https://www.facebook.com/kemplast'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/kemplast'],
            ['key' => 'pinterest', 'value' => 'https://in.pinterest.com/kemplast'],
            ['key' => 'linkedin', 'value' => 'https://www.linkedin.com/kemplast'],
            ['key' => 'max_login_attempts', 'value' => '3'],
            ['key' => 'account_freeze_time_format', 'value' => '1 Day'],
            ['key' => 'min_password_length', 'value' => '8'],
            ['key' => 'password_require_number', 'value' => 'on'],
            ['key' => 'password_require_special', 'value' => 'on'],
            ['key' => 'password_require_capital', 'value' => 'on'],
            ['key' => 'max_password_length', 'value' => '16'],
            ['key' => 'email_stock_alerts', 'value' => 'on'],
            ['key' => 'email_dispatch_plans', 'value' => 'off'],
            ['key' => 'email_dues_payments', 'value' => 'on'],
            ['key' => 'email_pending_orders', 'value' => 'on'],
            ['key' => 'email_system_announcements', 'value' => 'on'],
            ['key' => 'push_stock_updates', 'value' => 'on'],
            ['key' => 'push_dispatch_updates', 'value' => 'off'],
            ['key' => 'push_overdue_payments', 'value' => 'off'],
            ['key' => 'push_order_status', 'value' => 'on'],
            ['key' => 'two_step_verification', 'value' => 'on'],
            ['key' => 'authentication_method', 'value' => 'password'], // Default to password
            ['key' => 'recovery_mail_enabled', 'value' => 'on'],
        ];

       DB::table('settings')->insert($initialSettings);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
