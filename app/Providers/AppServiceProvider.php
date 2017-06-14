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
        View::share('isAdmin', false);

        include app_path('helpers.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Awesome', function ($app) {
            return new AwesomeClass();
        });
    }
}
