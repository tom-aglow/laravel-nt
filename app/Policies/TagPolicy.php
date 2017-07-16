<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function all(User $user)
    {
        return $user->role->privileges->whereIn('name', [
            'blog.tag.view',
            'blog.tag.edit',
            'blog.tag.add',
            'blog.tag.delete'
        ])->isNotEmpty();
    }
}
