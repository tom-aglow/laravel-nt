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

//        if (Gate::denies('moderate-comment')) {
//            return abort(403);
//        }

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

        $tag = Tag::findOrFail($id);
        $msg = '';

        if ($request->input('button') === 'update') {
            $this->validate($request, $this->validationRules);

            $tag->fill($request->except('button'))
                ->save();
            $msg = 'Tag was updated';
        }

        if ($request->input('button') === 'delete') {
            $tag->delete();
            $tag->articles()->detach();
            $msg = 'Tag was deleted';
        }

        $this->clearCache();

        return redirect()->route('admin.tag.list')
            ->with('msg', $msg);
    }

    public function add (Request $request) {
        $this->validate($request, $this->validationRules);

        Tag::create($request->except('button'));
        $this->clearCache();

        return redirect()->route('admin.tag.list')
            ->with('msg', 'New tag was added');
    }

    protected function clearCache () {
        Cache::tags(['widgets', 'tags'])->flush();
    }
}
