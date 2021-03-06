<?php

namespace App\Providers;

use App\Models\Comment;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;



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
        $lang = app()->setLocale(env('SITE_LANG'));
        $lang = app()->getLocale();

        if($lang == 'en') View::share('ltr', true);
        else View::share('ltr', false);

        //
        Blade::directive('convertCurrency', function ($money) {
            return "<?php echo number_format($money); ?>";
        });


        view()->composer('admin/*', function () {
            $commentCount = Comment::where('status','',0)->count();
            View::share('commentCount', $commentCount);
        });

    }
}
