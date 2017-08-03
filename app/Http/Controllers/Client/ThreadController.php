<?php

namespace App\Http\Controllers\Client;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends ClientController
{

    public function __construct () {
        $this->menu['all threads']['active'] = true;
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index(Channel $channel)
    {
        if ($channel->exists) {
            $threads = $channel->threads()->latest()->get();
        } else {
            $threads = Thread::latest()->get();
        }
        $page = 'client.4-pages.thread-list';
        $menu = $this->menu;

        return view('client.3-templates.single', compact('threads', 'page', 'menu'));
    }

    public function create()
    {
        $this->menu['new thread']['active'] = true;
        $this->menu['all threads']['active'] = false;
        $menu = $this->menu;
        $page = 'client.4-pages.thread-create';
        return view('client.3-templates.single', compact( 'page', 'menu'));
    }

    public function store(Request $request)
    {
        $request->flash();

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id',
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body'),
        ]);

        return redirect($thread->path());
    }

    public function show($channelId, Thread $thread)
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
