<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'push_notifications',
        'email_notifications',
        'sms_notifications',
        'in_app_notifications',
        'notification_preferences',
        'two_factor_auth',
        'preferred_2fa_method',
        'biometric_login',
        'user_management_access',
        'settings_access',
        'financial_reports_access',
        'production_plans_access',
        'inventory_management_access',
        'customer_management_access',
        'supplier_management_access',
        'employee_management_access',
        'stock_alerts_access',
        'theme_preference',
        'language_preference',
        'items_per_page',
        'dashboard_widgets',
        'compact_view',
        'preferred_contact_methods',
        'preferred_language',
        'receive_newsletter',
        'receive_marketing_emails',
        'calendar_view',
        'show_weekends',
        'working_days',
        'work_start_time',
        'work_end_time',
        'default_report_format',
        'report_preferences'
    ];

    protected $casts = [
        'notification_preferences' => 'array',
        'dashboard_widgets' => 'array',
        'preferred_contact_methods' => 'array',
        'report_preferences' => 'array',
        'push_notifications' => 'boolean',
        'email_notifications' => 'boolean',
        'sms_notifications' => 'boolean',
        'in_app_notifications' => 'boolean',
        'two_factor_auth' => 'boolean',
        'biometric_login' => 'boolean',
        'compact_view' => 'boolean',
        'receive_newsletter' => 'boolean',
        'receive_marketing_emails' => 'boolean',
        'show_weekends' => 'boolean',
        'work_start_time' => 'datetime',
        'work_end_time' => 'datetime'
    ];

    // Relationships
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    // Methods
    public function hasAccess($feature)
    {
        $accessField = "{$feature}_access";
        return $this->$accessField ?? false;
    }

    public function toggleNotification($type, $value = null)
    {
        $field = "{$type}_notifications";
        if (isset($this->$field)) {
            $this->$field = $value ?? !$this->$field;
            $this->save();
        }
    }

    public function getWorkingHours()
    {
        if ($this->work_start_time && $this->work_end_time) {
            return [
                'start' => $this->work_start_time->format('H:i'),
                'end' => $this->work_end_time->format('H:i')
            ];
        }
        return null;
    }

    public function getWorkingDaysArray()
    {
        return array_map('intval', explode(',', $this->working_days));
    }

    public function updateDashboardWidgets(array $widgets)
    {
        $this->dashboard_widgets = $widgets;
        $this->save();
    }

    public function setReportPreference($key, $value)
    {
        $preferences = $this->report_preferences ?? [];
        $preferences[$key] = $value;
        $this->report_preferences = $preferences;
        $this->save();
    }
}