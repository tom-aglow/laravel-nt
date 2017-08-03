<?php

namespace App\Http\Controllers\Client;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;
use App\Models\User;

class ThreadController extends ClientController
{

    public function __construct () {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index(Channel $channel)
    {
        //  if request has channel slug, we should make a filter by provided channel
        if ($channel->exists) {
            $threads = $channel->threads()->latest();
        } else {
            $threads = Thread::latest();
        }

        //  if request('by'), we should filter by given username
        if ($username = request('by')) {
            $user = User::where('name', $username)->firstOrFail();
            $threads->where('user_id', $user->id);
        }

        $threads = $threads->get();

        $page = 'client.4-pages.thread-list';
        $menu = $this->menu;
        return view('client.3-templates.single', compact('threads', 'page', 'menu'));
    }

    public function create()
    {
        $page = 'client.4-pages.thread-create';
        $menu = $this->menu;
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
