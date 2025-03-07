<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    private const CACHE_KEY = 'app_settings';
    private const CACHE_TTL = 3600; // 1 hour

    /**
     * Display the settings page
     */
    public function index()
    {
        try {
            $settings = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
                return Setting::all();
            });

            if ($settings->isEmpty()) {
                // Return an empty array with the expected structure
                return view('settings', ['settings' => [], 'error' => 'No settings found.']);
            }

            // Group settings by their group key and prepare for view
            $settings = $settings->groupBy('group')->map(function ($group) {
                return $group->map(function ($setting) {
                    return [
                        'value' => $this->formatSettingValue($setting->value, $setting->type),
                        'type' => $setting->type,
                        'description' => $setting->description,
                        'is_public' => $setting->is_public,
                        'is_system' => $setting->is_system,
                        'group' => $setting->group,
                        'key' => $setting->key
                    ];
                });
            });

            return view('settings', [
                'settings' => $settings->toArray()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in settings index: ' . $e->getMessage());
            return view('settings', ['settings' => [], 'error' => 'Error loading settings.']);
        }
    }

    /**
     * Update the settings
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'settings' => 'required|array',
                'settings.*' => 'nullable'
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            foreach ($request->except('_token') as $key => $value) {
                $setting = Setting::where('key', $key)->first();
                if (!$setting) continue;

                if ($setting->is_system && !auth()->user()->hasRole('admin')) {
                    continue; // Skip system settings for non-admin users
                }

                $value = $this->handleBooleanType($setting, $value);
                $value = $this->handleJsonArrayType($setting, $value);

                if ($setting->type === 'integer') {
                    $value = (int) $value;
                } elseif ($setting->type === 'url' && !empty($value)) {
                    if (!filter_var($value, FILTER_VALIDATE_URL)) {
                        return redirect()->back()->with('error', "Invalid URL format for {$key}");
                    }
                }

                $oldValue = $setting->value;
                $setting->value = $value;
                $setting->save();

                // Log the change for audit purposes
                Log::info('Setting updated', [
                    'key' => $key,
                    'old_value' => $oldValue,
                    'new_value' => $value,
                    'user_id' => auth()->id()
                ]);

                // Clear the cache for this setting
                Cache::forget('settings:' . $key);
            }

            // Clear the global settings cache
            Cache::forget(self::CACHE_KEY);

            return redirect()->back()->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update settings', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Failed to update settings. Please try again.');
        }
    }

    /**
     * Format setting value based on type
     */
    private function formatSettingValue($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'array':
                return is_array($value) ? $value : json_decode($value, true) ?? [];
            case 'integer':
                return (int) $value;
            default:
                return $value;
        }
    }

    /**
     * Handle boolean type settings
     */
    private function handleBooleanType($setting, $value)
    {
        return $setting->type === 'boolean' ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : $value;
    }

    /**
     * Handle JSON/array type settings
     */
    private function handleJsonArrayType($setting, $value)
    {
        if (!in_array($setting->type, ['json', 'array']) || !is_string($value)) {
            return $value;
        }

        try {
            return json_decode($value, true) ?? $value;
        } catch (\Exception $e) {
            Log::warning("Failed to decode JSON for setting {$setting->key}", ['error' => $e->getMessage()]);
            return $value;
        }
    }

    /**
     * Get all settings from cache or database
     */
    private function getAllSettings(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Display the website settings page
     */
    public function website()
    {
        try {
            $settings = Cache::remember('website_settings', self::CACHE_TTL, function () {
                return Setting::where('group', 'website')->get();
            });

            // Convert settings to associative array
            $websiteSettings = [];
            foreach ($settings as $setting) {
                $websiteSettings[$setting->key] = $this->formatSettingValue($setting->value, $setting->type);
            }

            return view('settings.website', [
                'settings' => ['website' => $websiteSettings]
            ]);

        } catch (\Exception $e) {
            Log::error('Error in website settings: ' . $e->getMessage());
            return view('settings.website', ['settings' => [], 'error' => 'Error loading settings.']);
        }
    }

    /**
     * Update website settings
     */
    public function websiteUpdate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'social.facebook' => 'nullable|url',
                'social.twitter' => 'nullable|url',
                'social.pinterest' => 'nullable|url',
                'social.linkedin' => 'nullable|url',
                'notifications.*' => 'nullable|string|in:on,off',
                'security.*' => 'nullable',
                'security.min_password_length' => 'nullable|integer|min:6|max:50',
                'security.max_password_length' => 'nullable|integer|min:8|max:100',
                'security.max_login_attempts' => 'nullable|integer|min:1|max:10',
                'security.account_freeze_time_format' => 'nullable|string|in:1 Day,12 Hours,6 Hours',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Update social settings
            if ($request->has('social')) {
                foreach ($request->social as $key => $value) {
                    Setting::updateOrCreate(
                        ['key' => "social.{$key}", 'group' => 'website'],
                        ['value' => $value, 'type' => 'url']
                    );
                }
            }

            // Update notification settings
            if ($request->has('notifications')) {
                foreach ($request->notifications as $key => $value) {
                    Setting::updateOrCreate(
                        ['key' => "notifications.{$key}", 'group' => 'website'],
                        ['value' => $value, 'type' => 'boolean']
                    );
                }
            }

            // Update security settings
            if ($request->has('security')) {
                foreach ($request->security as $key => $value) {
                    $type = in_array($key, ['min_password_length', 'max_password_length', 'max_login_attempts'])
                        ? 'integer'
                        : (in_array($key, ['password_require_number', 'password_require_special', 'password_require_capital', 'two_step_verification'])
                            ? 'boolean'
                            : 'string');

                    Setting::updateOrCreate(
                        ['key' => "security.{$key}", 'group' => 'website'],
                        ['value' => $value, 'type' => $type]
                    );
                }
            }

            // Clear the cache
            Cache::forget('website_settings');

            return redirect()->back()->with('success', 'Website settings updated successfully.');

        } catch (\Exception $e) {
            Log::error('Error updating website settings: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update settings. Please try again.');
        }
    }
}
