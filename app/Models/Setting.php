<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'description',
        'is_public',
        'is_system'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'json',
        'is_public' => 'boolean',
        'is_system' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * The cache prefix for settings.
     *
     * @var string
     */
    protected static $cachePrefix = 'settings:';

    /**
     * The cache TTL in minutes.
     *
     * @var int
     */
    protected static $cacheTTL = 60;

    /**
     * Get a setting value by its key.
     *
     * @param  string  $key
     * @param  mixed  $default  Default value if the setting is not found.
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        try {
            $cacheKey = static::$cachePrefix . $key;

            return Cache::remember($cacheKey, static::$cacheTTL, function () use ($key, $default) {
                $setting = static::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            });
        } catch (\Exception $e) {
            Log::error("Error getting setting value: {$e->getMessage()}");
            return $default;
        }
    }

    /**
     * Set or update a setting value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return \App\Models\Setting|null
     */
    public static function setValue(string $key, $value): ?Setting
    {
        try {
            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }

            $setting = static::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );

            Cache::forget(static::$cachePrefix . $key);
            return $setting;
        } catch (\Exception $e) {
            Log::error("Error setting value: {$e->getMessage()}");
            return null;
        }
    }

        /**
     * Get all settings as a key-value array.
     *
     * @return array
     */
    public static function getAllSettings(): array
    {
        try {
            return Cache::remember('settings:all', static::$cacheTTL, function () {
                return static::pluck('value', 'key')->toArray();
            });
        } catch (\Exception $e) {
            Log::error("Error getting all settings: {$e->getMessage()}");
            return [];
        }
    }

    public static function getByGroup(string $group): array
    {
        try {
            return Cache::remember("settings:group:{$group}", static::$cacheTTL, function () use ($group) {
                return static::where('group', $group)
                    ->pluck('value', 'key')
                    ->toArray();
            });
        } catch (\Exception $e) {
            Log::error("Error getting settings by group: {$e->getMessage()}");
            return [];
        }
    }

    public static function clearCache(): void
    {
        try {
            Cache::tags('settings')->flush();
        } catch (\Exception $e) {
            Log::error("Error clearing settings cache: {$e->getMessage()}");
        }
    }
}

