<?php

namespace App\Http\Controllers\Client;

use App\Models\Favourite;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavouriteReplyController extends ClientController
{

    public function __construct () {
        $this->middleware('auth');
    }

    public function store (Reply $reply) {

        $reply->favourite();

        return back();
    }
}
