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

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

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

        return back();
    }
}
