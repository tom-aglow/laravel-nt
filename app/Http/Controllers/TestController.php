<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
//        $str = route('getUser', [123]);

        return redirect()->route('getUser', [123]);
    }

    public function index2 (Request $request) {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";

        echo $request->input('name', 'name not assigned');
    }

    public function user($id, $name) {
        return [$id, $name];
    }
}
