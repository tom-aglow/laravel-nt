<?php

namespace App\Models;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Model;

class ThreadSubscription extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function notify (Reply $reply) {
        $this->user->notify(new ThreadWasUpdated($this->thread, $reply));
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function thread () {
        return $this->belongsTo(Thread::class);
    }
}
