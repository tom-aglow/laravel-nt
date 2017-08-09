<?php

namespace Tests\Feature;

use App\Models\Activity;
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

    /*
     * Threads deleting
     */
    /** @test */
    public function unauthorized_user_may_not_delete_thread () {

        $this->withExceptionHandling();

        $thread = create('App\Models\Thread');

        //  if user is not signed in, he should be redirected to login page
        $this->delete($thread->path())
            ->assertRedirect(route('client.auth.login'));

        //  if user is signed in, ...
        $this->signIn();
        $this->delete($thread->path())
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_user_can_delete_thread () {

        $this->signIn();

        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Models\Reply', ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, Activity::count());

    }

    /** @test */
    public function threads_can_only_be_deleted_by_those_who_has_permission () {

        //TODO

    }


    /*
     * Methods
     */
    public function publishThread ($overrides = []) {

        $this->withExceptionHandling()->signIn();

        $thread = make('App\Models\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
