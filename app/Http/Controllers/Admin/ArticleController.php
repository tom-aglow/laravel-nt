<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Upload;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Classes\Uploader;


class ArticleController extends AdminController
{

    public function list() {

        $articles = Article::all()
            ->sortByDesc('created_at');

        /*
         * return the view with parameters
         */

        return view('admin.3-pages.article-list', [
            'title' => 'Article list',
            'articles' => $articles,
            'menuActive' => $this->menuActive,
            'msg' => session('msg') ?? '',
        ]);

//        TODO revise list view in admin side
    }


    public function add(Upload $upload, Request $request) {

        /*
         * get the article image path from session if it was set before; otherwise load default image
         */
        $path = (session('image_id')) ? $upload->findOrFail(session('image_id'))->path : 'default';

        $imgPath = 'http://laravel-nt.local/image/widen/400/' . $path . '.jpg';


        /*
         * return the view with parameters
         */
        return view('admin.3-pages.article-one', [
            'title' => 'New article',
            'menuActive' => $this->menuActive,
            'article' => [],
            'imgPath' => $imgPath,
            'msg' => 'Add new article',
            'action' => route('admin.article.add'),
        ]);
    }

    public function addPost(Request $request, Uploader $uploader, Upload $uploadModel) {
        $request->flash();

        /*
         * check if the cancel button was clicked
         * if yes, then obtain file path, delete loaded image and clear the session if anything related to new article was stored there
         *
         * return redirect to the page with list of articles
         */
        if ($request->only('button')['button'] === 'cancel') {

            if (session('image_id')) {
                $path = $uploadModel->findOrFail(session('image_id'))->path;
                $pathParts = explode('.', $path);
                $fullPath = 'images/' . implode('/', $pathParts);
                Storage::disk('uploads')->delete($fullPath);

                $uploadModel->findOrFail(session('image_id'))->delete();
                $request->session()->forget(['image_id']);
            }

            return redirect()->route('admin.article.list');

        }

        /*
         * check if the upload button was pressed
         * if yes, upload image to the folder and save other data from form fields to session for displaying them after page reloading
         *
         * return redirect to the same page
         */
        if ($request->only('button')['button'] === 'upload') {
            $this->imageUpload($request,  $uploader,  $uploadModel);

            return redirect()->route('admin.article.add');
        }

        /*
         * if neither 'cancel' nor 'upload' button was pressed (= 'save' button was clicked), then...
         *
         * - validate form data
         * - create record in database
         * - clear session data
         * - return redirect to article list page
         */

        $this->validateFormData($request);

        Article::create([
            'user_id' => Auth::user()->id,
            'image_id' => session('image_id'),
            'title' => $request->input('title'),
            'subheading' => $request->input('subheading'),
            'content' => $request->input('content'),
            'is_active' => is_null($request->input('is-active')),
            'active_from' => $request->input('active_from'),
            'active_to' => $request->input('active_to'),
        ]);

        $request->session()->forget(['image_id']);

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was added');
    }

    public function edit($id, Request $request) {
        /*
         * try to find article in database by its id
         * figure out the path to the image and fit it to 400px wide
         */

        $article = Article::findOrFail($id);
        $imgPath = str_replace($request->path(), '', $request->url()) . 'image/widen/400/' . $article->image->path . '.jpg';

//        if (!$article) {
//            abort(404);
//        }

        /*
         * return the view with parameters
         */

        return view('admin.3-pages.article-one', [
            'title' => 'Article #' . $id,
            'menuActive' => $this->menuActive,
            'article' => $article,
            'imgPath' => $imgPath,
            'msg' => session('msg') ?? 'Edit article',
            'action' => route('admin.article.edit', $id),
        ]);
    }

    public function editPost($id, Request $request, Uploader $uploader, Upload $uploadModel) {

        $request->flash();

        /*
         * check if the cancel button was clicked
         *
         * return redirect to the page with list of articles
         */

        if ($request->only('button')['button'] === 'cancel') {
            return redirect()->route('admin.article.list');
        }

        /*
         * try to find article in database by its id
         */

        $article = Article::findOrFail($id);

        /*
         * check if the upload button was pressed
         * if yes, then upload image to the folder
         *
         * return redirect to the same page with message
         */

        if ($request->only('button')['button'] === 'upload') {
            $this->imageUpload($request,  $uploader,  $uploadModel, $article);
            return redirect()->route('admin.article.edit', $id)
                ->with('msg', 'Image was updated');
        }

        /*
         * if neither 'cancel' nor 'upload' button was pressed (= 'save' button was clicked), then...
         *
         * - validate form data
         * - update record in database
         * - return redirect to article list page with message
         */


        $this->validateFormData($request);

        $request->replace([
           'is_active' => !is_null($request->input('is_active'))
        ]);

        $article->fill($request->except('button'))
            ->save();

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was updated');
    }

    public function delete($id) {

       /*
        * try to find article in database by id and delete it
        */

        Article::findOrFail($id)
            ->delete();


        /*
         * return redirect to article list page with message
         */

        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was deleted');
    }


    /**
     *
     * Function for validating form values received from user
     *
     * @param Request $request
     */
    private function validateFormData (Request $request) {

//        TODO check if article has an image

        $this->validate($request, [
            'title' => 'required',
            'subheading' => 'required',
            'content' => 'required',
        ]);
    }

    /**
     * Function for uploading article image to storage and register image in database
     *
     * @param Request      $request
     * @param Uploader     $uploader
     * @param Upload       $uploadModel
     * @param Article|null $article
     *
     * @return array|string
     */

    private function imageUpload (Request $request, Uploader $uploader, Upload $uploadModel, Article $article = null) {

        /*
         * define validation rules
         */
        $rules = [
            'maxSize' => 10 * 1024 * 1024,
            'minSize' => 10 * 1024,
            'allowedExt' => [
                'jpeg',
                'jpg',
                'png',
            ],
            'allowedMime' => [
                'image/jpeg',
                'image/png',
            ],
        ];

        /*
         * check if data from request satisfy defined rules
         */
        if ($uploader->validate($request, 'file', $rules)) {

            /*
             * set the directory for uploading and try to upload file
             */
            $dir = 'images';
            $uploadedPath = $uploader->upload($dir);

            if ($uploadedPath !== false) {
                /*
                 * if upload was successful then register record in data base and get property of uploaded file
                 */
                $uploadedModel = $uploader->register($uploadModel);
                $uploadedProps = $uploader->getProps();

                /*
                 * if article has already exist in database (= instance of the article class was passed to the function),
                 * then update image_id in the table
                 * else save image_id in the session array
                 */
                if (!is_null($article)) {
                    $article->image_id = $uploadedModel->id;
                    $article->save();
                } else {
                    session(['image_id' => $uploadedModel->id]);
                }

            }

            /*
             * return 'OK' if success
             */
            return $uploadedPath !== false ? 'OK' : 'NOT OK';
        }
        else {
//            TODO change return response in case if there is any errors in file uploading process
            dump($uploader->getProps());
            dump($uploader->getErrors());
        }

        return $uploader->getErrors();
    }


    private function getArticleStatus () {

    }
}
