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
        $this->singIn();

        //  And an existing thread
        $thread = create('App\Models\Thread');

        //  When the user add a reply to the thread
        $reply = make('App\Models\Reply');
        $this->post($thread->path() . '/replies', $reply->toArray());

        //  Then his reply should be visible  on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requiers_a_body () {

        $this->withExceptionHandling()->signIn();

        $thread = create('App\Models\Thread');
        $reply = make('App\Models\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');

    }
}