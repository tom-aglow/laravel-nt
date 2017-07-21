<?php

namespace App\Http\Controllers\Client;

use App\Models\Comment;
use App\Models\CommentStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Client\ClientController;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends ClientController
{
    private $request;
    private $article;

    public function __construct (Request $request) {
        $this->request = $request;

        $slug = $this->request->route()->parameter('slug');
        $this->article = Article::with('comments.user')->where('slug', $slug)->firstOrFail();
    }
    
    public function showArticle () {

        $idAccepted = CommentStatus::where('status', config('blog.commentStatus.accepted'))->first()->id;

        return view('client.3-templates.single', [
            'page' => 'client.4-pages.article',
            'title' => $this->article->title,
            'article' => $this->article,
            'comments' => $this->article->comments->where('status_id', $idAccepted)
        ]);
    }

    public function processComment () {

        $this->validate($this->request, [
            'comment' => 'required'
        ]);

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'article_id' => $this->article->id,
            'user_comment' => $this->request->input('comment'),
            'status_id' => CommentStatus::where('status', config('blog.commentStatus.new'))->first()->id
        ]);

        return redirect()->route('client.article.show', $this->article->slug);
    }
}
