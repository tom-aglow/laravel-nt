<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use App\Models\Article;
use App\Models\Upload;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Classes\Uploader;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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


    /**
     * FILE UPLOADER
     */

    public function uploaderGet(Uploader $uploader)
    {
        return '<form enctype="multipart/form-data" method="POST">'.
            csrf_field() .
            '<input type="file" name="file" />
            <input type="submit" value="Go!" />
        </form>';
    }

    public function uploaderPost(Request $request, Uploader $uploader, Upload $uploadModel)
    {
        $rules = [
            'maxSize' => 10 * 1024 * 1024,
            'minSize' => 1 * 1024,
            'allowedExt' => [
                'jpeg',
                'jpg',
                'png',
                'gif',
                'bmp',
                'tiff',
                'pdf'
            ],
            'allowedMime' => [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/bmp',
                'image/tiff',
                'application/pdf'
            ],
        ];


        if ($uploader->validate($request, 'file', $rules)) {

            $dir = getFileUploadSection($request->file('file')->getMimeType());

            $uploadedPath = $uploader->upload($dir);
            if ($uploadedPath !== false) {
                $uploadsModel = $uploader->register($uploadModel);
                $uploadedProps = $uploader->getProps();
            }
            return $uploadedPath !== false ? 'OK' : 'NOT OK';
        }
        else {
            dump($uploader->getProps());
            dump($uploader->getErrors());
        }

        return $uploader->getErrors();
    }

    public function uploaderDelete (Uploader $uploader, Upload $uploadModel) {
        $id = 37;

        $path = $uploadModel->findOrFail($id)->path;
        $pathParts = explode('.', $path);
        $fullPath = 'images/' . implode('/', $pathParts);

        Storage::disk('uploads')->delete($fullPath);
        dump($fullPath);
        return 'OK';
    }


    /**
     * MODEL RELATIONSHIPS
     */

    public function testRel () {
        $articles = User::find(1)
            ->articles;

        dump($articles);


        return 'OK';
    }

    /**
     * CACHE
     */

    public function testCache () {
        Cache::add('fruit', 'apple', 5);

        $value = Cache::remember('users', 10, function () {
            return DB::table('users')->get();
        });

        dump($value);
        echo 'ok';
    }

    /**
     * MAIL
     */

    public function testMail () {

        $user = User::find(11)->email;
        Mail::to($user)->send(new FeedbackMail());

        echo 'ok';
    }
}
