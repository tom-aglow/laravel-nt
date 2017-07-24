<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TagController extends AdminController
{
    private $validationRules = [
        'tag_name' => 'required',
    ];

    public function list() {

        $tags = Tag::all()
            ->sortByDesc('created_at');

        return view('admin.3-pages.tag-list', [
            'title' => 'Tag list',
            'tags' => $tags,
            'menuActive' => $this->menuActive,
            'msg' => session('msg') ?? '',
        ]);
    }

    public function update ($id, Request $request) {

        //  retrieve tag fromDB
        $tag = Tag::findOrFail($id);
        $msg = '';

        /*
         * check if 'update' button was clicked
         *      - validate data from form
         *      - pass data to DB
         *      - create the message
         */
        if ($request->input('button') === 'update') {
            $this->validate($request, $this->validationRules);

            $tag->fill($request->except('button'))
                ->save();
            $msg = 'Tag was updated';
        }

        /*
         * check if 'delete' button was clicked
         *      - delete tag from DB
         *      - delete data from intermediate table with articles
         *      - create the message
         */
        if ($request->input('button') === 'delete') {
            $tag->delete();
            $tag->articles()->detach();
            $msg = 'Tag was deleted';
        }

        //  call cache clean function
        $this->clearCache();

        //  return redirect to the tag list view
        return redirect()->route('admin.tag.list')
            ->with('msg', $msg);
    }

    public function add (Request $request) {

        //  validate data from form
        $this->validate($request, $this->validationRules);

        //  create model
        Tag::create($request->except('button'));

        //  call cache clean function
        $this->clearCache();

        //  return redirect to the tag list view
        return redirect()->route('admin.tag.list')
            ->with('msg', 'New tag was added');
    }

    /**
     * clear cache for tag list view on client side
     */
    protected function clearCache () {
        Cache::tags(['widgets', 'tags'])->flush();
    }
}
