<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends AdminController
{
    private $table = 'articles';

    public function list() {

        $articles = Article::orderBy('created_at', 'desc')
            ->get();

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
        $article = Article::find($id);

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

        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->save();

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was updated');
    }

    public function delete($id) {
        $article = Article::find($id);
        $article->delete();

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was deleted');
    }

}
