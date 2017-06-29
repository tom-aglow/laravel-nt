<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends AdminController
{
    public function list() {

        $articles = Article::all()
            ->sortByDesc('created_at');

        return view('admin.3-pages.article-list', [
            'title' => 'Article list',
            'articles' => $articles,
            'msg' => session('msg') ?? '',
        ]);
    }


    public function add() {
        return view('admin.3-pages.article-one', [
            'title' => 'New article',
            'article' => [],
            'msg' => 'Add new article',
        ]);
    }

    public function addPost(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        Article::create([
            'author' => 'tom',
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was added');
    }

    public function edit($id) {
        $article = Article::findOrFail($id);

//        if (!$article) {
//            abort(404);
//        }

        return view('admin.3-pages.article-one', [
            'title' => 'Article #' . $id,
            'article' => $article,
            'msg' => 'Edit article',
        ]);
    }

    public function editPost($id, Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $requestAll = $request->all();
        unset($requestAll['save']);
        unset($requestAll['cancel']);

        $article = Article::findOrFail($id);
        $article->fill($requestAll)
            ->save();

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was updated');
    }

    public function delete($id) {
        $article = Article::findOrFail($id)
            ->delete();

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was deleted');
    }

}
