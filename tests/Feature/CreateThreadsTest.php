<?php

namespace Tests\Feature;

use Tests\DatabaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends DatabaseTestCase
{
    /** @test */
    public function guests_can_not_create_a_thread () {

        $this->withExceptionHandling();

        $this->post('/threads')
            ->assertRedirect(route('client.auth.login'));

        $this->get('/threads/create')
            ->assertRedirect(route('client.auth.login'));

    }


    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads () {

        //  Given we have an signed in user
        //**** using method of parent class ****
        $this->signIn();

        //  When we hit an endpoint to create a new thread
        //**** raw() returns an array of user attribute, while make() returns the actual object ****
        //**** we need to pass to post request an array not an object ****
        //**** but later we want to use an object, so we use make() and convert it to array when submitting post request ****

        //$thread = factory('App\Models\Thread')->raw();
        //**** using make() helper to simplify the code (see Utilities/functions.php) ****
        $thread = make('App\Models\Thread');

        $response = $this->post('/threads', $thread->toArray());

        //  Then, when we visit the thread page
        //  We should see the new thread
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }

    /** @test */
    public function a_thread_requiers_a_title () {

        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requiers_a_body () {

        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requiers_a_valid_channel () {

        factory('App\Models\Channel', 2);

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }


    public function publishThread ($overrides = []) {

        $this->withExceptionHandling()->signIn();

        $thread = make('App\Models\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
