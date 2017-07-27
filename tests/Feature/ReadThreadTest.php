<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Thread;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp () {
        parent::setUp();

        $this->thread = factory('App\Models\Thread')->create();
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
        $response = $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_the_thread () {
        //  Given we have a thread
        //  And that thread includes replies
        $reply = factory('App\Models\Reply')->create(['thread_id' => $this->thread->id]);

        //  When we visit a thread page, then we should see the replies
        $response = $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);

    }
}
