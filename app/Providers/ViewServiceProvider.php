<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Channel;

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
        View::composer(['client.3-templates.main'], function ($view) {
            $view->with('tagList', Cache::tags(['widgets', 'tags'])->remember('tagList', env('CACHE_TIME', 0), function () {
                return view('client.5-widgets.tags', [
                    'tagList' => Tag::all(),
                ])->render();
            }));
        });
        /*
         * badges
         */
        View::composer(['admin.3-pages.home'], function ($view) {
            $view->with('badgeComment', Cache::tags(['badges', 'comments'])->remember('badgeComment', env('CACHE_TIME', 0), function () {
                return Comment::where('status_id', 1)->count();
            }));
        });


        View::composer(['client.4-pages.thread-create', 'client.2-parts.header-navbar'], function ($view) {
            $view->with('channels', Channel::all());
        });
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
