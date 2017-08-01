<?php

namespace Tests\Unit;

use Tests\DatabaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReplyTest extends DatabaseTestCase
{
    /** @test */
    public function it_has_an_owner () {
        $reply = create('App\Models\Reply');

        $this->assertInstanceOf('App\Models\User', $reply->owner);
    }
}
