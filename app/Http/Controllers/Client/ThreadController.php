<?php

namespace App\Http\Controllers\Client;

use App\Filters\ThreadFilters;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class ThreadController extends ClientController
{

    public function __construct () {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads;
        }

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

        return redirect($thread->path())
            ->with('flash', 'You thread has been published!');
    }

    public function show($channelId, Thread $thread)
    {
        return view('client.3-templates.single', [
            'thread' => $thread,
            'page' => 'client.4-pages.thread-one',
            'menu' => $this->menu,
            'replies' => $thread->replies()->paginate(10)
        ]);
    }

    public function edit(Thread $thread)
    {
        //
    }

    public function update(Request $request, Thread $thread)
    {
        //
    }

    public function destroy(Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect(route('client.threads.index'));
    }

    /**
     * @param Channel       $channel
     * @param ThreadFilters $filters
     *
     * @return mixed
     */
    protected function getThreads (Channel $channel, ThreadFilters $filters) {
        $threads = Thread::latest()->filter($filters);

        //  if request has channel slug, we select all thread of this channel
        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        $threads = $threads->get();

        return $threads;
    }
}
