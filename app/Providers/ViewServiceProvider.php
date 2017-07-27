<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Tag;
use App\Models\Comment;

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
        /*
         * widgets
         */

//        View::share('tagList', Cache::tags(['widgets', 'tags'])->remember('tagList', env('CACHE_TIME', 0), function () {
//
//            return view('client.5-widgets.tags', [
//                'tagList' => Tag::all(),
//            ])->render();
//        }));

        /*
         * badges
         */
//        TODO separate service provider for route groups
//        View::share('badgeComment', Cache::tags(['badges', 'comments'])->remember('badgeComment', env('CACHE_TIME', 0), function () {
//
//            return Comment::where('status_id', 1)->count();
//        }));
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
