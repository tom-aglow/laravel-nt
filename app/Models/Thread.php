<?php

namespace App\Models;

use App\Http\Traits\RecordsActivity;
use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['creator', 'channel'];

    protected $appends = ['isSubscribedTo'];

    /*
     * Global scopes
     */
    public static function boot () {
        parent::boot();

        //  when we delete a thread, all associated replies should be deleted as well
        static::deleting(function ($thread) {
            $thread->replies->each->delete();   //  instead of each function
        });
    }

    /*
    * Accessors
    */

    public function getIsSubscribedToAttribute () {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }
    
    /*
     * Methods
     */
    public function path () {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function addReply ($reply) {
        $reply = $this->replies()->create($reply);

        //  prepare notifications for all subscribers

        $this->subscriptions
            ->filter(function ($sub) use ($reply) {
                return $sub->user_id != $reply->user_id;
            })
            ->each->notify($reply);

        return $reply;
    }

    public function subscribe ($userId = null) {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id(),
        ]);

        return $this;
    }

    public function unsubscribe ($userId = null) {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    /*
     * Scopes
     */

    public function scopeFilter ($query, $filters) {
        return $filters->apply($query);
    }


    /*
     * Relationships
     */

    public function replies () {
        return $this->hasMany('App\Models\Reply');
    }

    public function creator () {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function channel () {
        return $this->belongsTo('App\Models\Channel');
    }

    public function subscriptions () {
        return $this->hasMany(ThreadSubscription::class);
    }

}
