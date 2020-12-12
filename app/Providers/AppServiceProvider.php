<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


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
        $lang = app()->setLocale(env('LANG'));
        $lang = app()->getLocale();

        if($lang == 'en') View::share('ltr', true);
        else View::share('ltr', false);

        //
        \Blade::directive('convertCurrency', function ($money) {
            return "<?php echo number_format($money); ?>";
        });
    }
}
