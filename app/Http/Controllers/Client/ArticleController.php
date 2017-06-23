<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Client\ClientController;

class ArticleController extends ClientController
{
    public function list() {
        echo 'list of articles';
    }

    public function show($id) {
        echo 'this is the article #' . $id;
    }
}
