<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view, edit, add or delete the articles.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $article
     * @return mixed
     */
    public function all(User $user)
    {
        return $user->role->privileges->whereIn('name', [
            'blog.article.view',
            'blog.article.edit',
            'blog.article.add',
            'blog.article.delete'
        ])->isNotEmpty();
    }
}
