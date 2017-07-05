<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends AdminController
{

    public function list() {

        $articles = Article::all()
            ->sortByDesc('created_at');

        return view('admin.3-pages.article-list', [
            'title' => 'Article list',
            'articles' => $articles,
            'menuActive' => $this->menuActive,
            'msg' => session('msg') ?? '',
        ]);

//        TODO revise list view in admin side
//        TODO make feature to add picture to article
    }


    public function add() {
        return view('admin.3-pages.article-one', [
            'title' => 'New article',
            'menuActive' => $this->menuActive,
            'article' => [],
            'msg' => 'Add new article',
            'action' => route('admin.article.add'),
        ]);
    }

    public function addPost(Request $request) {

        if ($request->only('button')['button'] === 'cancel') {
            return redirect()->route('admin.article.list');
        } else {
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
            ]);

            Article::create([
                'user_id' => Auth::user()->id,
                'title' => $request->input('title'),
                'subheading' => '',
                'content' => $request->input('content'),
                'is_active' => 1,
                'active_from' => \Carbon\Carbon::now()
            ]);

            return redirect()->route('admin.article.list')
                ->with('msg', 'Article was added');
        }
    }

    public function edit($id) {
        $article = Article::findOrFail($id);

//        if (!$article) {
//            abort(404);
//        }

        return view('admin.3-pages.article-one', [
            'title' => 'Article #' . $id,
            'menuActive' => $this->menuActive,
            'article' => $article,
            'msg' => 'Edit article',
            'action' => route('admin.article.edit', $id),
        ]);
    }

    public function editPost($id, Request $request) {

        if ($request->only('button')['button'] === 'cancel') {
            return redirect()->route('admin.article.list');
        } else {
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
            ]);

            Article::findOrFail($id)
                ->fill($request->except('button'))
                ->save();

            return redirect()->route('admin.article.list')
                ->with('msg', 'Article was updated');
        }
    }

    public function delete($id) {
        Article::findOrFail($id)
            ->delete();

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was deleted');
    }

}
