<?php


namespace Tests\Feature;

use Tests\DatabaseTestCase;

class FavouriteTest extends DatabaseTestCase {

    /** @test */
    public function guest_could_not_favourite_anything () {

        $this->withExceptionHandling()
            ->post('replies/1/favourites')
            ->assertRedirect(route('client.auth.login'));

    }

    /** @test */
    public function an_authenticated_user_can_favourite_any_reply () {

        $this->signIn();
        //  route strategy "replies/id/favourites"

        //  create a reply
        //  it will create an associative thread as well according the factory structure
        $reply = create('App\Models\Reply');

        //  If I post to "favourite" endpoint
        $this->post('replies/' . $reply->id . '/favourites');

        //  It should be recorded in database
        $this->assertCount(1, $reply->favourites);
    }

    /** @test */
    public function an_authenticated_user_can_only_favourite_a_reply_once () {

        $this->signIn();

        //  create a reply
        $reply = create('App\Models\Reply');

        try {
            //  If I try to favourite the reply more than once
            $this->post('replies/' . $reply->id . '/favourites');
            $this->post('replies/' . $reply->id . '/favourites');
        } catch (\Exception $e) {
            //  tailor the failure message
            $this->fail('Did not expect to insert the same record set twice');
        }

        //  It should be only one record in database
        $this->assertCount(1, $reply->favourites);
    }
}