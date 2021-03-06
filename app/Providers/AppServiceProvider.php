<?php

namespace App\Providers;

use App\Classes\AwesomeClass;
use App\Classes\TestHandler;
use App\Classes\Uploader;
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

        $this->app->singleton('Uploader', function ($app) {
            return new Uploader();
        });

        $this->app->singleton('Handler', function ($app) {
            return new TestHandler();
        });
    }

}
