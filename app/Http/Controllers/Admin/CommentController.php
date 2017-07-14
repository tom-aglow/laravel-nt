<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends AdminController
{

    public function list() {

        dump(config('app.url'));

        $this->authorize('view', Comment::class);

        $comments = Comment::withTrashed()
            ->with(['user', 'article', 'status'])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('article_id');

        return view('admin.3-pages.comment-list', [
            'title' => 'Comments list',
            'comments' => $comments,
            'menuActive' => $this->menuActive,
            'msg' => session('msg') ?? '',
        ]);
    }

    public function action ($id, $action) {

        $this->authorize('update', Comment::class);

        $comment = Comment::withTrashed()
            ->findOrFail($id);

        switch ($action) {
            case 'accept':
                $comment->status_id = 2;
                $comment->save();
                $msg = 'The comment was accepted';
                break;
            case 'return':
                $comment->status_id = 1;
                $comment->save();
                $msg = 'The comment was returned to moderation';
                break;
            case 'delete':
                $comment->status_id = 3;
                $comment->save();
                $comment->delete();
                $msg = 'The comment was temporary deleted';
                break;
            case 'restore':
                $comment->status_id = 1;
                $comment->save();
                $comment->restore();
                $msg = 'The comment was restored';
                break;
            case 'kill':
                $comment->forceDelete();
                $msg = 'The comment was permanently deleted';
                break;
            default:
                $msg = 'Oops. The action is unavailable';
        }


        return redirect()->route('admin.comment.list')
            ->with('msg', $msg ?? '');
    }
}
