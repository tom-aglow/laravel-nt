<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Thread;

class ReplyController extends ClientController
{
    public function __constructor () {
        $this->middleware('auth');
    }

    public function store (Thread $thread) {

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        return back();
    }
}
