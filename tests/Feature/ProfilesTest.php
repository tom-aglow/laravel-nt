<?php

namespace Tests\Feature;

use Tests\DatabaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfilesTest extends DatabaseTestCase
{
    /** @test */
    public function a_user_has_a_profile () {

        $user = create('App\Models\User');

        $this->get('/profiles/' . $user->username)
            ->assertSee($user->name);

    }

    /** @test */
    public function profiles_display_all_threads_created_by_associated_user () {

        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);

        $this->get('/profiles/' . auth()->user()->username)
            ->assertSee(auth()->user()->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }
}
