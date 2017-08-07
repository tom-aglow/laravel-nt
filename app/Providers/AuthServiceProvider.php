<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Thread;
use App\Models\Role;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use App\Policies\TagPolicy;
use App\Policies\ThreadPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Comment::class => CommentPolicy::class,
        Tag::class => TagPolicy::class,
        Thread::class => ThreadPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-access', function ($user) {
            return in_array($user->role->name, config('admin.panel_roles'));
        });

        Gate::before(function ($user) {
            if ($user->role_id == Role::where('name', config('admin.admin_role'))->first()->id) {
                return true;
            }
        });


    }
}
