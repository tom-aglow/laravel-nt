<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends AdminController
{

    /**
     *
     * Rendering the comment list view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list() {

        //  check if user has permission to view comments
        $this->authorize('view', Comment::class);

        //  retrieve all comments from DB and group it by article
        $comments = Comment::withTrashed()
            ->with(['user', 'article', 'status'])
            ->latest()
            ->get()
            ->groupBy('article_id');

        //  paginate comments
        $commentsPag = $this->paginate($comments, 5);

        //  return view with parameters
        return view('admin.3-pages.comment-list', [
            'title' => 'Comments list',
            'comments' => $commentsPag,
            'menuActive' => $this->menuActive,
            'msg' => session('msg') ?? '',
        ]);
    }

    /**
     *
     * Handling actions with comments: accept, return, delete, restore, kill
     *
     * @param $id
     * @param $action
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function action ($id, $action) {

        //  check if user has permission to update comment
        $this->authorize('update', Comment::class);

        //  retrieve comment from DB
        $comment = Comment::withTrashed()
            ->findOrFail($id);

        //  make action according clicked button
        switch ($action) {
            case 'accept':
                $this->authorize('update', Comment::class);
                $comment->status_id = 2;
                $comment->save();
                $msg = 'The comment was accepted';
                break;

            case 'return':
                $this->authorize('update', Comment::class);
                $comment->status_id = 1;
                $comment->save();
                $msg = 'The comment was returned to moderation';
                break;

            case 'delete':
                $this->authorize('update', Comment::class);
                $comment->status_id = 3;
                $comment->save();
                $comment->delete();
                $msg = 'The comment was temporary deleted';
                break;

            case 'restore':
                $this->authorize('update', Comment::class);
                $comment->status_id = 1;
                $comment->save();
                $comment->restore();
                $msg = 'The comment was restored';
                break;

            case 'kill':
                $this->authorize('delete', Comment::class);
                $comment->forceDelete();
                $msg = 'The comment was permanently deleted';
                break;

            default:
                $msg = 'Oops. The action is unavailable';
        }

        //  redirect to comment's list view with message
        return redirect()->route('admin.comment.list')
            ->with('msg', $msg ?? '');
    }

    /**
     * Create a length aware custom paginator instance.
     *
     * @param  Collection  $items
     * @param  int  $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginate($items, $perPage = 12)
    {
        //  Get current page form url e.g. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //  Create collection from input array
        $col = new Collection($items);

        //  Slice the collection to get the items to display in current page
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();

        //  Create paginator and pass it to the view
        return new LengthAwarePaginator($currentPageItems, count($col), $perPage);
    }
}
