<?php

namespace Tests\Unit;

use Tests\DatabaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends DatabaseTestCase
{
    protected $thread;

    public function setUp () {
        parent::setUp();
        $this->thread = create('App\Models\Thread');
    }

    /** @test */
    public function a_thread_can_make_a_string_path () {

        $this->assertEquals("/threads/{$this->thread->channel->slug}/{$this->thread->id}", $this->thread->path());
    }


    /** @test */
    public function a_thread_has_creator () {

        $this->assertInstanceOf('App\Models\User', $this->thread->creator);
    }

    /** @test */
    public function a_thread_has_reply () {

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function a_thread_can_add_a_reply () {

        $this->thread->addReply([
            'body' => 'foobar',
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function a_thread_belongs_to_a_channel () {

        $this->assertInstanceOf('App\Models\Channel', $this->thread->channel);
    }

    /** @test */
    public function a_thread_can_be_subscribe_to () {

        //  Given we have a thread
        //  $this->thread;


        //  when the user subscribes to thread
        $this->thread->subscribe($userId = 1);

        //  then we should be able to fetch all threads that the user has subscribed to
        $this->assertEquals(1, $this->thread->subscriptions()->where('user_id', $userId)->count());
    }

    /** @test */
    public function a_thread_can_be_unsubscribe_from () {

        $this->thread->subscribe($userId = 1);

        $this->thread->unsubscribe($userId);

        $this->assertEquals(0, $this->thread->subscriptions()->where('user_id', $userId)->count());
    }
}
