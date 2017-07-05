<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends AdminController
{

    public function list() {

//        if (Gate::denies('moderate-comment')) {
//            return abort(403);
//        }

        $this->authorize('view', Comment::class);

        $comments = Comment::all()
            ->sortByDesc('created_at');

        return view('admin.3-pages.comment-list', [
            'title' => 'Comments list',
            'comments' => $comments,
            'menuActive' => $this->menuActive,
            'msg' => session('msg') ?? '',
        ]);
    }
}
