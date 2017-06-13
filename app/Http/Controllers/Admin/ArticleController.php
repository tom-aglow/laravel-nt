<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends AdminController
{
    public function list() {
        echo 'list of articles';
    }

    public function add() {
        echo 'add an article';
    }

    public function edit($id) {
        echo 'edit article #' . $id;
    }

    public function delete($id) {
        echo 'delete article #' . $id;
    }
}
