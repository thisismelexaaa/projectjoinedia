<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env(key: 'APP_ENV') !== 'local') {
            URL::forceScheme(scheme: 'http');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Setting carbon ke bahasa indonesia
        setlocale(LC_ALL, 'IND');
        Carbon::setLocale('id');

        // currency blade directive
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });
    }
}
