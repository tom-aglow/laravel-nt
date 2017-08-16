<?php

namespace App\Http\Controllers\Client;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadSubscriptionController extends ClientController
{
    public function __construct () {
        $this->middleware('auth');
    }

    public function store ($channelId,Thread $thread) {

        $thread->subscribe();
    }

    public function destroy ($channelId,Thread $thread) {

        $thread->unsubscribe();
    }
}
