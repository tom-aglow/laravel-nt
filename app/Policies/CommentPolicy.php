<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->role->privileges->where('name', 'blog.comment.view')->isNotEmpty();
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user)
    {
        return $user->role->privileges->where('name', 'blog.comment.moderate')->isNotEmpty();
    }

    public function delete(User $user)
    {
        return $user->role->privileges->where('name', 'blog.comment.delete')->isNotEmpty();
    }
}
