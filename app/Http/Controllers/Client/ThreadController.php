<?php

namespace App\Http\Controllers\Client;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends ClientController
{

    public function __construct () {
        $this->menu['forum']['active'] = true;
    }
    public function index()
    {
        $threads = Thread::latest()->get();
        $page = 'client.4-pages.thread-list';
        $menu = $this->menu;

        return view('client.3-templates.single', compact('threads', 'page', 'menu'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Thread $thread)
    {
        $page = 'client.4-pages.thread-one';
        $menu = $this->menu;

        return view('client.3-templates.single', compact('thread', 'page', 'menu'));
    }

    public function edit(Thread $thread)
    {
        //
    }

    public function update(Request $request, Thread $thread)
    {
        //
    }

    public function destroy(Thread $thread)
    {
        //
    }
}
