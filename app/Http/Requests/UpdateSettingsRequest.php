<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // SECURITY: Only authenticated users with proper permissions can update settings
        return auth()->check() && auth()->user()->can('manage_settings');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Company Settings
            'company_name' => 'nullable|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_address' => 'nullable|string|max:500',
            'company_description' => 'nullable|string|max:1000',
            'contact_person' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:20',
            
            // Social Media Settings
            'social_media_enabled' => 'nullable|array',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'pinterest' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            
            // Security Settings
            'max_login_attempts' => 'nullable|integer|min:1|max:20',
            'min_password_length' => 'nullable|integer|min:6|max:20',
            'max_password_length' => 'nullable|integer|min:8|max:50',
            'password_require_number' => 'nullable|in:on,off',
            'password_require_special' => 'nullable|in:on,off',
            'password_require_capital' => 'nullable|in:on,off',
            'two_step_verification' => 'nullable|in:on,off',
            'authentication_method' => 'nullable|in:password,2fa,biometric',
            'recovery_mail_enabled' => 'nullable|in:on,off',
            
            // Notification Settings
            'email_stock_alerts' => 'nullable|in:on,off',
            'email_dispatch_plans' => 'nullable|in:on,off',
            'email_dues_payments' => 'nullable|in:on,off',
            'email_pending_orders' => 'nullable|in:on,off',
            'email_system_announcements' => 'nullable|in:on,off',
            'push_stock_updates' => 'nullable|in:on,off',
            'push_dispatch_updates' => 'nullable|in:on,off',
            'push_overdue_payments' => 'nullable|in:on,off',
            'push_order_status' => 'nullable|in:on,off',
            
            // UI Settings
            'keyboard_shortcuts' => 'nullable|in:on,off',
            'menu_view' => 'nullable|in:default,advanced',
            'mail_send_actions' => 'nullable|array'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'company_email.email' => 'Please enter a valid email address.',
            'max_login_attempts.min' => 'Maximum login attempts must be at least 1.',
            'min_password_length.min' => 'Minimum password length must be at least 6 characters.',
            'max_password_length.min' => 'Maximum password length must be at least 8 characters.',
        ];
    }
}