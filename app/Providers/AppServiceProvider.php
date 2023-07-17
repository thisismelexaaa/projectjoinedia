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
<<<<<<< HEAD
            URL::forceScheme(scheme: 'http');
=======
            URL::forceScheme(scheme: 'https');
>>>>>>> f89a811 (First Commit : Progress 80%)
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

<<<<<<< HEAD
        // currency blade directive
=======


>>>>>>> f89a811 (First Commit : Progress 80%)
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });
    }
}
