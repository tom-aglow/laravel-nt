<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ajax() {
        return view('client.3-templates.main', [
            'page' => 'client.4-pages.ajax-upload',
            'title' => 'Index',
        ]);
    }

    public function ajaxPost(Request $request) {
        return $request->input('title');
    }
}
