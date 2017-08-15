<?php

namespace Tests\Feature;

use App\Models\Activity;
use Tests\DatabaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubscribeToThreadsTest extends DatabaseTestCase
{
    /** @test */
    public function a_user_can_subscribe_to_threads () {

        $this->signIn();

        //  Given we have a thread
        $thread = create('App\Models\Thread');

        //  user subscribes to the thread
        $this->post($thread->path() . '/subscriptions');

        $this->assertCount(1, $thread->fresh()->subscriptions);
    }

    /** @test */
    public function a_user_can_unsubscribe_from_a_thread () {

        $this->signIn();

        $thread = create('App\Models\Thread');

        $thread->subscribe();

        $this->delete($thread->path() . '/subscriptions');

        $this->assertCount(0, $thread->subscriptions);
    }
}
