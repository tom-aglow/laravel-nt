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
        $this->signIn();

        //  And an existing thread
        $thread = create('App\Models\Thread');

        //  When the user add a reply to the thread
        $reply = make('App\Models\Reply');
        $this->post($thread->path() . '/replies', $reply->toArray());

        //  Then his reply should be visible  on the page
//        $this->get($thread->path())
//            ->assertSee($reply->body);

        //  Reply should be stored in database
        $this->assertDatabaseHas('replies', ['body' => $reply->body]);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    /** @test */
    public function a_reply_requires_a_body () {

        $this->withExceptionHandling()->signIn();

        $thread = create('App\Models\Thread');
        $reply = make('App\Models\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');

    }

    /** @test */
    public function unauthorized_user_cannot_update_reply () {

        $this->withExceptionHandling();

        //  Given we have reply
        $reply = create('App\Models\Reply');

        //  we submit delete request to the endpoint and should be redirected to login page
//        $this->delete("replies/{$reply->id}")
//            ->assertRedirect(route('client.auth.login'));

        $this->signIn()->patch("replies/{$reply->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_delete_reply () {

        $this->signIn();

        $reply = create('App\Models\Reply', ['user_id' => auth()->id()]);

        $this->delete("replies/{$reply->id}")->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);

    }


    /** @test */
    public function unauthorized_user_cannot_delete_reply () {

        $this->withExceptionHandling();

        //  Given we have reply
        $reply = create('App\Models\Reply');

        //  we submit delete request to the endpoint and should be redirected to login page
//        $this->delete("replies/{$reply->id}")
//            ->assertRedirect(route('client.auth.login'));

        $this->signIn()->delete("replies/{$reply->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_update_reply () {

        $this->signIn();

        $reply = create('App\Models\Reply', ['user_id' => auth()->id()]);
 
        $updatedReply = 'You\'ve been changed, fool.';
        $this->patch("replies/{$reply->id}", ['body' => $updatedReply]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $updatedReply]);
    }
}
