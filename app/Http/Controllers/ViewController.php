<?php

namespace App\Http\Controllers;

use App\Classes\AwesomeClass;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function page1() {

        $awesomeClass = resolve('Awesome');

        return view('page1', [
            'name' => '<h1>' . $awesomeClass->getCounter() . '</h1>'
        ]);
    }

    public function page2() {


        return view('pages.secondPage', [
            'title' => 'PAGE 2'
        ]);
    }
}
