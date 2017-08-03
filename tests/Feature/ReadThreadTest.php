<?php

namespace Tests\Feature;

use Tests\DatabaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Thread;

class ReadThreadTest extends DatabaseTestCase
{
    public function setUp () {
        parent::setUp();

        $this->thread = create('App\Models\Thread');
    }

    /** @test */
    public function a_user_can_see_all_threads()
    {

        $response = $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_see_a_single_thread()
    {
        $response = $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_the_thread () {
        //  Given we have a thread
        //  And that thread includes replies
        $reply = create('App\Models\Reply', ['thread_id' => $this->thread->id]);

        //  When we visit a thread page, then we should see the replies
        $response = $this->get($this->thread->path())
            ->assertSee($reply->body);

    }

    /** @test */
    public function a_user_can_read_thread_according_to_a_channel () {

        $channel = create('App\Models\Channel');

        $threadInChannel = create('App\Models\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Models\Thread');


        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);

    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username () {

        $this->signIn(create('App\Models\User', ['name' => 'JohnDoe']));

        $threadByJohn = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $threadByNotJohn = create('App\Models\Thread');


        $this->get('/threads?by=JohnDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadByNotJohn->title);

    }
}
