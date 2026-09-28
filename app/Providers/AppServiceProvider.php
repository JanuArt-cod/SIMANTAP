<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

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
        // Menyediakan variabel $setting secara global ke seluruh file view (.blade.php)
        view()->composer('*', function ($view) {
            $view->with('setting', Setting::first());
        });
    }
}
