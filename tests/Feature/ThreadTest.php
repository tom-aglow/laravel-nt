<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Thread;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_see_all_threads()
    {
        $thread = factory('App\Models\Thread')->create();

        $response = $this->get('/threads');
        $response->assertSee($thread->title);
    }

    /** @test */
    public function a_user_can_see_a_single_thread()
    {
        $thread = factory('App\Models\Thread')->create();

        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
