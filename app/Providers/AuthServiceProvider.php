<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use App\Policies\TagPolicy;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        gate example (replaced by policy, can be deleted)
        Gate::define('moderate-comment', function ($user) {
            return in_array($user->id, [12]);
        });
    }
}
