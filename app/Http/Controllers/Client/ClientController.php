<?php

namespace App\Http\Controllers\Client;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class ClientController extends Controller
{

    public function index () {
        $articles = Article::active()
            ->inTime()
            ->latest()
            ->get();

//        TODO add pagination
//        TODO for widgets make function in service provider or base controller to render shared view data

        foreach ($articles as $article) {
            $article->comments;
        }

        return view('client.3-templates.main', [
            'page' => 'client.4-pages.index',
            'title' => 'Index',
            'articles' => $articles,
        ]);
    }

//    TODO move to ArticleController (maybe ???)
    public function showArticle ($id ) {
        $article = Article::with('comments.user')->findOrFail($id);

        return view('client.3-templates.single', [
            'page' => 'client.4-pages.article',
            'title' => $article->title,
            'id' => $id,
            'article' => $article
        ]);
//        TODO add slug (web friendly url) for one article view
    }

    public function showAbout () {
        return view('client.3-templates.main', [
            'page' => 'client.4-pages.about',
            'title' => 'About us',

        ]);
    }

    public function showContact () {
        return view('client.3-templates.main', [
            'page' => 'client.4-pages.contact',
            'title' => 'Contact us',
        ]);
    }

    public function show404 () {
        return view('client.3-templates.single', [
            'page' => 'client.4-pages.404',
            'title' => 'Page not found',
        ]);
    }

    // TODO add method for menu (or wait ORM???)

}
