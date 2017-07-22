<?php

namespace App\Http\Controllers\Client;

use App\Events\FeedbackSending;
use App\Models\Article;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ClientController extends Controller
{

    public function index () {
        $articles = Article::active()
            ->inTime()
            ->latest()
            ->paginate(5);

        return view('client.3-templates.main', [
            'page' => 'client.4-pages.index',
            'title' => 'Index',
            'articles' => $articles,
        ]);
    }

    public function listByTag ($tag) {

        $articles = Article::active()
            ->inTime()
            ->hasTag($tag)
            ->orderBy('articles.created_at', 'desc')
            ->paginate(5);

        return view('client.3-templates.main', [
            'page' => 'client.4-pages.index',
            'title' => 'Index',
            'articles' => $articles,
        ]);
    }

    public function showAbout () {
        return view('client.3-templates.main', [
            'page' => 'client.4-pages.about',
            'title' => 'About us',
        ]);
    }

    
    public function showContact () {
//        dump(session('wasMessageSent'));
        return view('client.3-templates.main', [
            'page' => 'client.4-pages.contact',
            'title' => 'Contact us',
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
        return view('client.3-templates.single', [
            'page' => 'client.4-pages.404',
            'title' => 'Page not found',
        ]);
    }


    // TODO add attribute for menu

}
