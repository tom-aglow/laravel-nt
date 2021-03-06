<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\Thread;
use App\Models\Role;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use App\Policies\ReplyPolicy;
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
        Reply::class => ReplyPolicy::class,
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

        //  admin can do anything
        //  TODO change hard-coded id to name of the role
        //  Role::where('name', config('admin.admin_role'))->first()->id -- broke test, because we don't create instance of role in them
        Gate::before(function ($user) {
            if ($user->role_id == 1) {
                return true;
            }
        });


    }
}
