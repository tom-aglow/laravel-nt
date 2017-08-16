<?php

namespace Tests\Feature;

use Illuminate\Notifications\DatabaseNotification;
use Tests\DatabaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationTest extends DatabaseTestCase
{
    public function setUp () {
        parent::setUp();

        $this->signIn();
    }
    
    /** @test */
    public function a_notification_is_prepared_when_subscribed_thread_receives_a_new_reply_that_is_not_by_a_current_user () {

        $thread = create('App\Models\Thread');

        $thread->subscribe();

        //  and there is no notifications yet
        $this->assertCount(0, auth()->user()->notifications);


        //  then each time a new reply is left in that thread
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'some reply here',
        ]);

        //  no notifications should be prepared for the user
        $this->assertCount(0, auth()->user()->fresh()->notifications);

        //  but if we add a reply from somebody else
        $thread->addReply([
            'user_id' => create('App\Models\User')->id,
            'body' => 'some reply here',
        ]);

        //  there should be a notification the user
        $this->assertCount(1, auth()->user()->fresh()->notifications);

    }

    /** @test */
    public function a_user_can_fetch_his_unread_notifications () {

        create(DatabaseNotification::class);

        $user = auth()->user();

        $this->assertCount(1, $user->unreadNotifications);

        $response = $this->getJson("/profiles/{$user->username}/notifications")->json();

        $this->assertCount(1, $response);
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read () {

        create(DatabaseNotification::class);

        $user = auth()->user();

        $this->assertCount(1, $user->unreadNotifications);

        $notificationId = $user->unreadNotifications->first()->id;
        $this->delete("/profiles/{$user->username}/notifications/{$notificationId}");

        $this->assertCount(0, $user->fresh()->unreadNotifications);

    }
}
