<?php

namespace App\Http\Controllers\Client;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Models\Thread;

class ReplyController extends ClientController
{
    public function __constructor () {
        $this->middleware('auth');
    }

    public function store ($channelId, Thread $thread) {

        $this->validate(request(), [
            'body' => 'required'
        ]);

        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        if (request()->expectsJson()) {
            return $reply->load('owner');
        }

        return back()
            ->with('flash', 'You reply has been left!');
    }

    public function update (Reply $reply) {

        $this->authorize('update', $reply);

        $reply->update(request(['body']));
    }

    public function destroy (Reply $reply) {

        $this->authorize('update', $reply);

        $reply->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }
}
