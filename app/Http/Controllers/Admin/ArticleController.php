<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Upload;
use App\Models\User;
use App\Models\Tag;
use App\Models\Role;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Classes\Uploader;


class ArticleController extends AdminController
{
    private $validationRules = [
        'title' => 'required',
        'subheading' => 'required',
        'content' => 'required',
    ];

    /**
     *
     * Rendering the article list view
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articleList(Request $request) {

        //  retrieve data from DB
        $articles = Article::latest()->get();

        //  define article status
        $articles = $articles->map(function ($item) {
            $now = \Carbon\Carbon::now();

            if (!$item['is_active']) {
                $item['status'] = 'inactive';
            } elseif($now < $item['active_from']) {
                $item['status'] = 'scheduled';
            } elseif (is_null($item['active_to']) || $now < $item['active_to']) {
                $item['status'] = 'active';
            } else {
                $item['status'] = 'overdue';
            }

            return $item;
        });

        //  paginate modified collection
        $articles = $this->paginate($articles, 5, route('admin.article.list'));

        // return the view with parameters
        return view('admin.3-pages.article-list', [
            'title' => 'Article list',
            'articles' => $articles,
            'menuActive' => $this->menuActive,
            'msg' => session('msg') ?? '',
        ]);
    }

    /**
     *
     * Rendering the view for article creating
     *
     * @param Upload  $upload
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Upload $upload) {

        /*
         * get the article image path from session if it was set before; otherwise load default image
         */
        if ((session('image_id')) !== null) {
            $upload = $upload->findOrFail(session('image_id'));
        }

        /*
         * return the view with parameters
         */
        return view('admin.3-pages.article-one', [
            'title' => 'New article',
            'menuActive' => $this->menuActive,
            'article' => [],
            'tags' => Tag::all(),
            'img' => [
                'path' => $upload->path ?? 'default',
                'ext' => $upload->ext ?? 'jpg',
            ],
            'msg' => 'Add new article',
            'action' => route('admin.article.add'),
        ]);
    }

    /**
     *
     * Handling post request for article creating
     *
     * @param Request  $request
     * @param Uploader $uploader
     * @param Upload   $uploadModel
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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
         * check if the upload button was clicked
         * if yes, upload image to the folder and save other data from form fields to session for displaying them after page reloading
         *
         * return redirect to the same page
         */
        if ($request->only('button')['button'] === 'upload') {
            $this->validate($request, [
                'file' => 'required'
            ]);
            $this->imageUpload($request,  $uploader,  $uploadModel);

            return redirect()->route('admin.article.add');
        }

        /*
         * if neither 'cancel' nor 'upload' button was pressed (= 'save' button was clicked), then...
         *
         * - validate form data
         * - create record in database
         * - get correct slug and update it in database
         * - clear session data
         * - return redirect to article list page
         */

        $this->validate($request, $this->validationRules);


        $article = Article::create([
            'user_id' => Auth::user()->id,
            'image_id' => session('image_id') ?? 1,
            'title' => $request->input('title'),
            'slug' => sha1(str_random(16) . microtime(true)),
            'subheading' => $request->input('subheading'),
            'content' => $request->input('content'),
            'is_active' => is_null($request->input('is-active')),
            'active_from' => date_create($request->input('active_from')),
            'active_to' => date_create($request->input('active_to')),
        ]);


        $article->slug = $article->id . ':' . str_slug($article->title, '-');
        $article->save();


        $newTag = [];
        if (!empty($request->input('tags'))) {
            foreach ($request->input('tags') as $tag) {
                array_push($newTag, (int)$tag);
            }
        }
        $article->tags()->sync($newTag);


        $request->session()->forget(['image_id']);


        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was added');
    }

    /**
     *
     * Rendering the view for article editing
     *
     * @param         $id
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Request $request) {
        /*
         * try to find article in database by its id
         * figure out the path to the image and fit it to 400px wide
         * get list of all tags
         */

        $article = Article::findOrFail($id);

        /*
         * return the view with parameters
         */

        return view('admin.3-pages.article-one', [
            'title' => 'Article #' . $id,
            'menuActive' => $this->menuActive,
            'article' => $article,
            'tags' => Tag::all(),
            'img' => [
                'path' => $article->image->path ?? 'default',
                'ext' => $article->image->ext ?? 'jpg',
            ],
            'msg' => session('msg') ?? 'Edit article',
            'action' => route('admin.article.edit', $id),
        ]);
    }

    /**
     *
     * Handling post request for article editing
     *
     * @param          $id
     * @param Request  $request
     * @param Uploader $uploader
     * @param Upload   $uploadModel
     *
     * @return \Illuminate\Http\RedirectResponse
     */

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
            $this->validate($request, [
                'file' => 'required'
            ]);
            $this->imageUpload($request,  $uploader,  $uploadModel, $article);
            return redirect()->route('admin.article.edit', $id)
                ->with('msg', 'Image was updated');
        }

        /*
         * if neither 'cancel' nor 'upload' button was pressed (= 'save' button was clicked), then...
         *
         * - validate form data
         * - update intermediate table with tags
         * - get 'is-active' and 'slug' attributes and update record in database
         * - return redirect to article list page with message
         */


        $this->validate($request, $this->validationRules);


        $newTag = [];
        if (!empty($request->input('tags'))) {
            foreach ($request->input('tags') as $tag) {
                array_push($newTag, (int)$tag);
            }
        }
        $article->tags()->sync($newTag);


        //  : set 'is-active' attribute to true if request has it, else set to false
        //  :   cannot be done with mutator since if input field is unchecked, the value is not in request and not passing to DB
        //  : replace slug with slug from new article title
        //  : replace sting values of dates by date objects




        $article->slug = $article->id . ':' . str_slug($request->input('title'), '-');
        $article->is_active = ($request->has('is_active')) ? true : false;
        $request->replace([
            'active_from' => date_create($request->input(['active_from'])),
            'active_to' => date_create($request->input(['active_to'])),
        ]);

        $article->fill($request->except(['button', 'tags', 'is_active']))
            ->save();



        return redirect()->route('admin.article.list')
            ->with('msg', 'Article was updated');
    }


    /**
     *
     * Handling post request for article deleting
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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
}
