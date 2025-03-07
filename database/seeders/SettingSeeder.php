<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // System Preferences
            ['key' => 'keyboard_shortcuts', 'value' => 'off', 'group' => 'preferences', 'type' => 'string', 'description' => 'Enable/disable keyboard shortcuts', 'is_public' => true],
            ['key' => 'menu_view', 'value' => 'advanced', 'group' => 'preferences', 'type' => 'string', 'description' => 'Default menu view mode', 'is_public' => true],
            ['key' => 'mail_send_actions', 'value' => json_encode(['on-buttonclick']), 'group' => 'preferences', 'type' => 'json', 'description' => 'Mail sending trigger actions', 'is_public' => true],
            
            // Company Information
            ['key' => 'company_name', 'value' => 'Kemplast Systems', 'group' => 'company', 'type' => 'string', 'description' => 'Company name', 'is_public' => true],
            ['key' => 'company_email', 'value' => 'info@kemplast.com', 'group' => 'company', 'type' => 'string', 'description' => 'Company email address', 'is_public' => true],
            ['key' => 'company_address', 'value' => 'Bainguinim, Baingini, Goa 403402', 'group' => 'company', 'type' => 'text', 'description' => 'Company address', 'is_public' => true],
            ['key' => 'company_description', 'value' => 'Leading manufacturer of plastic products and innovative solutions', 'group' => 'company', 'type' => 'text', 'description' => 'Company description', 'is_public' => true],
            ['key' => 'contact_person', 'value' => 'John Doe', 'group' => 'company', 'type' => 'string', 'description' => 'Primary contact person', 'is_public' => true],
            ['key' => 'company_phone', 'value' => '+91 832-123-4567', 'group' => 'company', 'type' => 'string', 'description' => 'Company phone number', 'is_public' => true],
            
            // Social Media Settings
            ['key' => 'social_media_enabled', 'value' => json_encode(['facebook', 'linkedin']), 'group' => 'social', 'type' => 'json', 'description' => 'Enabled social media platforms', 'is_public' => true],
            ['key' => 'facebook', 'value' => 'https://www.facebook.com/kemplast', 'group' => 'social', 'type' => 'url', 'description' => 'Facebook page URL', 'is_public' => true],
            ['key' => 'twitter', 'value' => 'https://twitter.com/kemplast', 'group' => 'social', 'type' => 'url', 'description' => 'Twitter profile URL', 'is_public' => true],
            ['key' => 'pinterest', 'value' => 'https://in.pinterest.com/kemplast', 'group' => 'social', 'type' => 'url', 'description' => 'Pinterest profile URL', 'is_public' => true],
            ['key' => 'linkedin', 'value' => 'https://www.linkedin.com/kemplast', 'group' => 'social', 'type' => 'url', 'description' => 'LinkedIn company page URL', 'is_public' => true],
            
            // Security Settings
            ['key' => 'max_login_attempts', 'value' => '3', 'group' => 'security', 'type' => 'integer', 'description' => 'Maximum login attempts before account lockout', 'is_public' => false],
            ['key' => 'account_freeze_time_format', 'value' => '1 Day', 'group' => 'security', 'type' => 'string', 'description' => 'Account freeze duration after max login attempts', 'is_public' => false],
            ['key' => 'min_password_length', 'value' => '8', 'group' => 'security', 'type' => 'integer', 'description' => 'Minimum password length requirement', 'is_public' => false],
            ['key' => 'password_require_number', 'value' => 'on', 'group' => 'security', 'type' => 'string', 'description' => 'Require numbers in password', 'is_public' => false],
            ['key' => 'password_require_special', 'value' => 'on', 'group' => 'security', 'type' => 'string', 'description' => 'Require special characters in password', 'is_public' => false],
            ['key' => 'password_require_capital', 'value' => 'on', 'group' => 'security', 'type' => 'string', 'description' => 'Require capital letters in password', 'is_public' => false],
            ['key' => 'max_password_length', 'value' => '32', 'group' => 'security', 'type' => 'integer', 'description' => 'Maximum password length limit', 'is_public' => false],
            
            // Email Notification Settings
            ['key' => 'email_stock_alerts', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable email notifications for stock alerts', 'is_public' => true],
            ['key' => 'email_dispatch_plans', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable email notifications for dispatch plans', 'is_public' => true],
            ['key' => 'email_dues_payments', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable email notifications for payment dues', 'is_public' => true],
            ['key' => 'email_pending_orders', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable email notifications for pending orders', 'is_public' => true],
            ['key' => 'email_system_announcements', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable email notifications for system announcements', 'is_public' => true],
            
            // Push Notification Settings
            ['key' => 'push_stock_updates', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable push notifications for stock updates', 'is_public' => true],
            ['key' => 'push_dispatch_updates', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable push notifications for dispatch updates', 'is_public' => true],
            ['key' => 'push_overdue_payments', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable push notifications for overdue payments', 'is_public' => true],
            ['key' => 'push_order_status', 'value' => 'on', 'group' => 'notifications', 'type' => 'string', 'description' => 'Enable push notifications for order status changes', 'is_public' => true],
            
            // Authentication Settings
            ['key' => 'two_step_verification', 'value' => 'off', 'group' => 'security', 'type' => 'string', 'description' => 'Enable two-step verification', 'is_public' => false],
            ['key' => 'authentication_method', 'value' => 'password', 'group' => 'security', 'type' => 'string', 'description' => 'Default authentication method', 'is_public' => false],
            ['key' => 'recovery_mail_enabled', 'value' => 'on', 'group' => 'security', 'type' => 'string', 'description' => 'Enable recovery email option', 'is_public' => false],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}