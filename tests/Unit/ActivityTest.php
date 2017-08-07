<?php

namespace Tests\Unit;

use App\Models\Activity;
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
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Models\Thread'
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
}
