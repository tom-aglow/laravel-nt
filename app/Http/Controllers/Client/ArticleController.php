<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends AdminController
{
    public function list() {
        echo 'list of articles';
    }

    public function show($id) {
        echo 'this is the article #' . $id;
    }
}
