<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('level', function ($value) {
            return strtolower(session('level')) == strtolower($value);
        });

        Blade::directive('idr', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        Blade::directive('idr_sign', function ($expression) {
            return "Rp <?php echo number_format($expression, 0, ',', '.'); ?>";
        });
    }
}
