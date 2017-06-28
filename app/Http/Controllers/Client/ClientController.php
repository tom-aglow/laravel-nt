<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index () {
        return view('client.3-templates.main', [
            'page' => 'client.4-pages.index',
            'title' => 'Index',
        ]);
    }

//    TODO move to ArticleController (maybe ???)
    public function showArticle ($id ) {
        return view('client.3-templates.single', [
            'page' => 'client.4-pages.article',
            'title' => 'Article #' . $id,
            'id' => $id
        ]);
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
