<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use App\Http\Livewire\SettingsManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));
        Schema::defaultStringLength(191);

        // Register Livewire components
        Livewire::component('settings-manager', SettingsManager::class);
    }
}
