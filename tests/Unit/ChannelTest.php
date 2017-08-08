<?php

namespace Tests\Unit;

use Tests\DatabaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChannelTest extends DatabaseTestCase
{
    /** @test */
    public function a_channel_consists_of_threads () {
        $channel = create('App\Models\Channel');
        $thread = create('App\Models\Thread', ['channel_id' => $channel->id]);

        $this->assertTrue($channel->threads->contains($thread));
    }
}
