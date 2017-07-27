<?php

namespace Tests\Feature;

use Tests\DatabaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends DatabaseTestCase
{
    /** @test */
    public function an_authenticated_user_can_participate_in_forum_threads () {
        //  Given we have an authenticated user
        $this->be($user = factory('App\Models\User')->create());

        //  And an existing thread
        $thread = factory('App\Models\Thread')->create();

        //  When the user add a reply to the thread
        $reply = factory('App\Models\Reply')->make();
        $this->post($thread->path() . '/replies', $reply->toArray());

        //  Then his reply should be visible  on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
