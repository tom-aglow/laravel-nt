<?php

namespace App\Providers;

use App\Classes\AwesomeClass;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

//        share variable for all views
//        View::share('isAuth', false);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /**
         * bind your own class
         */
        $this->app->singleton('Awesome', function ($app) {
            return new AwesomeClass();
        });
    }
}
