<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

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
