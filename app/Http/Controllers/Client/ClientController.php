<?php

namespace App\Http\Controllers\Client;

use App\Events\FeedbackSending;
use App\Models\Article;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ClientController extends Controller
{
    protected $menu = [
        'home' => [
            'active' => false,
            'path' => 'client.client.index',
        ],
        'about' => [
            'active' => false,
            'path' => 'client.about.show',
        ],
        'posts' => [
            'active' => false,
            'path' => 'client.client.index',
        ],
        'contact' => [
            'active' => false,
            'path' => 'client.contact.show',
        ],
    ];

    public function home () {
        $articles = Article::active()
            ->inTime()
            ->latest()
            ->paginate(5);

        $this->menu['home']['active'] = true;

        return view('client.3-templates.main', [
            'page' => 'client.4-pages.index',
            'title' => 'Index',
            'articles' => $articles,
            'menu' => $this->menu,
        ]);
    }

    public function listByTag ($tag) {

        $articles = Article::active()
            ->inTime()
            ->hasTag($tag)
            ->orderBy('articles.created_at', 'desc')
            ->paginate(5);

        $this->menu['posts']['active'] = true;

        return view('client.3-templates.main', [
            'page' => 'client.4-pages.index',
            'title' => 'Index',
            'articles' => $articles,
            'menu' => $this->menu,
        ]);
    }

    public function showAbout () {

        $this->menu['about']['active'] = true;

        return view('client.3-templates.main', [
            'page' => 'client.4-pages.about',
            'title' => 'About us',
            'menu' => $this->menu,
        ]);
    }

    
    public function showContact () {

        $this->menu['contact']['active'] = true;

        return view('client.3-templates.main', [
            'page' => 'client.4-pages.contact',
            'title' => 'Contact us',
            'menu' => $this->menu,
        ]);
    }

    public function sendFeedback (Request $request) {

        //  flash current input to the session
        $request->flash();

        //  validating request data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // send message to blog's author
        event(new FeedbackSending($request->all()));


        return redirect()->route('client.contact.show')
            ->with('wasMessageSent', 'true');
    }

    public function show404 () {

        $this->menu['home']['active'] = true;

        return view('client.3-templates.single', [
            'page' => 'client.4-pages.404',
            'title' => 'Page not found',
            'menu' => $this->menu,
        ]);
    }


    // TODO add attribute for menu

}
