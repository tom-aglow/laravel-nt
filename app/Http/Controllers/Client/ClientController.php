<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index () {
        return view('client.pages.index');
    }

    public function showArticle ($id) {
        return view('client.pages.article', [
            'id' => $id
        ]);
    }

    public function showAbout () {
        return view('client.pages.about');
    }

    public function showContact () {
        return view('client.pages.contact');
    }
}
