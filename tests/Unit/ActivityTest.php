<?php

namespace Tests\Unit;

use App\Models\Activity;
use Carbon\Carbon;
use Tests\DatabaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityTest extends DatabaseTestCase
{
    /** @test */
    public function it_records_activity_when_a_thread_was_created () {

        $this->signIn();

        $thread = create('App\Models\Thread');

        $this->assertDatabaseHas('activities', [
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Models\Thread',
            'type' => 'created-thread',
        ]);

        //  check if activity subject and thread are the same
        //  considering that activity table has only one record that was created right before
        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_was_created () {

        $this->signIn();

        //  if we create a new reply, we expect two activities to happen
        //      - reply was created
        //      - thread was updated
        $reply = create('App\Models\Reply');


        $this->assertEquals(2, Activity::count());
    }

    /** @test */
    public function it_fetches_a_feed_for_any_user () {

        $this->signIn();

        //  Given we have a thread
        create('App\Models\Thread', ['user_id' => auth()->id()], 2);

        //  And another thread from a week ago
        auth()->user()->activities()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        //  When we fetch their feed
        $feed = Activity::feed(auth()->user());

        //  It should be returned in the proper format
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));
    }
}
