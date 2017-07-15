<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Tag.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tag  $tag
     * @return mixed
     */
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
