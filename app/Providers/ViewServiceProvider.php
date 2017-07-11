<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Tag;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * Shared variables for all views
     *
     * @return void
     */
    public function boot()
    {
        View::share('tagList', Cache::tags(['widgets', 'tags'])->remember('tagList', env('CACHE_TIME', 0), function () {

            return view('client.5-widgets.tags', [
                'tagList' => Tag::all(),
            ])->render();
        }));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
