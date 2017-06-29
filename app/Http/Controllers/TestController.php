<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function getUsers () {
        $users = (bool) DB::table('users')->count();

        debug($users);

        return trans('custom.hello');
    }

//    testing ORM

    public function testORM () {

//        $newArticle = new Article();
//        $newArticle->title = 'test ORM';
//        $newArticle->author = 'tom';
//        $newArticle->content = 'hello orm hello';
//        $newArticle->save();



        $articles = Article::all();

        foreach ($articles as $article) {
            echo $article->title . '<br>';
            echo $article->content . '<br>';
            echo '<hr>';
        }

        return 'OK';
    }
}
