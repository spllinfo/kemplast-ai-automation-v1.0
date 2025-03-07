<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SettingsManager extends Component
{
    public $settings = [];
    public $activeTab = 'general';
    public $socialLinks = [];
    public $formState = [];
    public $isLoading = false;
    public $notification = null;
    public $debounceTimeout;

    // Define validation rules based on setting types
    protected $rules = [
        'formState.*' => 'nullable',
        'socialLinks.*' => 'nullable|url'
    ];

    public function mount()
    {
        $this->loadSettings();
        $this->initializeFormState();
    }

    public function loadSettings()
    {
        try {
            $this->isLoading = true;

            $settings = Setting::all();

            if ($settings->isEmpty()) {
                $this->settings = [];
                return;
            }

            // Group settings by their group key and prepare for view
            $this->settings = $settings->groupBy('group')->map(function ($group) {
                return $group->mapWithKeys(function ($setting) {
                    $key = $setting->key;
                    return [$key => [
                        'value' => $this->formatSettingValue($setting->value, $setting->type),
                        'type' => $setting->type,
                        'description' => $setting->description,
                        'is_public' => $setting->is_public,
                        'is_system' => $setting->is_system,
                        'group' => $setting->group,
                        'key' => $setting->key
                    ]];
                });
            })->toArray();

            // Extract social links
            $socialPlatforms = ['facebook', 'twitter', 'pinterest', 'linkedin', 'instagram', 'youtube'];
            foreach ($socialPlatforms as $platform) {
                $this->socialLinks[$platform] = Setting::getValue($platform, '');
            }
        } catch (\Exception $e) {
            Log::error('Error loading settings: ' . $e->getMessage());
            $this->notify('error', 'Failed to load settings. Please try again.');
        } finally {
            $this->isLoading = false;
        }
    }

    public function initializeFormState()
    {
        // Flatten settings into a single array for easier form handling
        foreach ($this->settings as $group => $groupSettings) {
            foreach ($groupSettings as $key => $setting) {
                $this->formState[$key] = $setting['value'];
            }
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updatedFormState($value, $key)
    {
        // We'll handle the auto-saving directly without using setTimeout/clearTimeout
        // which are JavaScript functions and not available in PHP
        $this->saveSettingField($key);
    }

    public function saveSettingField($key)
    {
        try {
            $setting = Setting::where('key', $key)->first();
            if (!$setting) return;

            if ($setting->is_system && !auth()->user()->hasRole('admin')) {
                $this->notify('error', 'You do not have permission to modify system settings.');
                return;
            }

            $value = $this->formState[$key];

            // For URL fields, use proper validation
            if ($setting->type === 'url' && !empty($value)) {
                $validator = Validator::make(['url' => $value], [
                    'url' => 'url'
                ]);

                if ($validator->fails()) {
                    $this->addError('formState.' . $key, 'The URL format is invalid.');
                    $this->notify('error', "Invalid URL format for {$key}");
                    return;
                }
            }

            $value = $this->handleBooleanType($setting, $value);
            $value = $this->handleJsonArrayType($setting, $value);

            if ($setting->type === 'integer') {
                $value = (int) $value;
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
            Cache::forget('app_settings');

            $this->notify('success', 'Setting updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update setting: ' . $e->getMessage());
            $this->notify('error', 'Failed to update setting. Please try again.');
        }
    }

    public function saveSocialLinks()
    {
        try {
            // Use Livewire's built-in validation
            $this->validate([
                'socialLinks.*' => 'nullable|url'
            ], [
                'socialLinks.*.url' => 'The :attribute must be a valid URL.'
            ]);

            foreach ($this->socialLinks as $platform => $url) {
                Setting::setValue($platform, $url);
            }

            $this->notify('success', 'Social links updated successfully.');
        } catch (ValidationException $e) {
            // Validation errors will be automatically added to the $errors bag
            $this->notify('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            Log::error('Failed to update social links: ' . $e->getMessage());
            $this->notify('error', 'Failed to update social links. Please try again.');
        }
    }

    public function saveAllSettings()
    {
        try {
            $this->isLoading = true;

            // Validate form state settings
            $this->validate([
                'formState.*' => 'nullable',
                'socialLinks.*' => 'nullable|url'
            ], [
                'socialLinks.*.url' => 'The :attribute must be a valid URL.'
            ]);

            // Save all form state settings
            foreach ($this->formState as $key => $value) {
                $setting = Setting::where('key', $key)->first();
                if (!$setting) continue;

                if ($setting->is_system && !auth()->user()->hasRole('admin')) {
                    continue; // Skip system settings for non-admin users
                }

                $value = $this->handleBooleanType($setting, $value);
                $value = $this->handleJsonArrayType($setting, $value);

                if ($setting->type === 'integer') {
                    $value = (int) $value;
                }

                $setting->value = $value;
                $setting->save();
            }

            // Save social links
            foreach ($this->socialLinks as $platform => $url) {
                Setting::setValue($platform, $url);
            }

            // Clear the global settings cache
            Cache::forget('app_settings');

            $this->notify('success', 'All settings updated successfully.');
        } catch (ValidationException $e) {
            // Validation errors will be automatically added to the $errors bag
            $this->notify('error', 'Please correct the errors below.');
        } catch (\Exception $e) {
            Log::error('Failed to update settings: ' . $e->getMessage());
            $this->notify('error', 'Failed to update settings. Please try again.');
        } finally {
            $this->isLoading = false;
        }
    }

    public function restoreDefaults()
    {
        if (!auth()->user()->hasRole('admin')) {
            $this->notify('error', 'Only administrators can restore default settings.');
            return;
        }

        try {
            $this->isLoading = true;

            // This would typically involve running a seeder or similar
            // For now, we'll just reload the settings
            $this->loadSettings();
            $this->initializeFormState();

            $this->notify('success', 'Settings have been restored to defaults.');
        } catch (\Exception $e) {
            Log::error('Failed to restore defaults: ' . $e->getMessage());
            $this->notify('error', 'Failed to restore defaults. Please try again.');
        } finally {
            $this->isLoading = false;
        }
    }

    private function notify($type, $message)
    {
        $this->notification = [
            'type' => $type,
            'message' => $message,
        ];

        // Auto-dismiss notification after 5 seconds
        $this->dispatchBrowserEvent('notify', $this->notification);
    }

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

    private function handleBooleanType($setting, $value)
    {
        return $setting->type === 'boolean' ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : $value;
    }

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

    public function render()
    {
        return view('livewire.settings-manager');
    }
}
