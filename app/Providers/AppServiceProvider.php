<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Make settings available to all views
        view()->composer('*', function ($view) {
            static $settings = null;
            if ($settings === null) {
                try {
                    $settings = \App\Models\Setting::all()->keyBy('key');
                } catch (\Throwable $e) {
                    $settings = collect();
                }
            }
            $view->with('globalSettings', $settings);
        });
    }
}
