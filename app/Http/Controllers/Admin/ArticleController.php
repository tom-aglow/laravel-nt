<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends AdminController
{
    private $table = 'articles';

    public function list() {

        $articles = DB::table($this->table)
            ->orderBy('created_at', 'desc')
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

        DB::table($this->table)->insert([
            'author' => 'tom',
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'created_at' => \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::createFromTimestamp(time())->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was added');
    }

    public function edit($id) {
        $article = DB::table($this->table)
            ->where('id', $id)
            ->get();

        return view('admin.3-pages.article-one', [
            'title' => 'Article #' . $id,
            'article' => $article[0],
            'msg' => 'Edit article',
        ]);
    }

    public function editPost($id, Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        DB::table($this->table)
            ->where('id', $id)
            ->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was updated');
    }

    public function delete($id) {
        DB::table($this->table)
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was deleted');
    }
}
