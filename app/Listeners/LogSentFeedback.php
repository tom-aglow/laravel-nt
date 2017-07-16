<?php

namespace App\Listeners;

use App\Events\FeedbackSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSentFeedback
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FeedbackSending  $event
     * @return void
     */
    public function handle(FeedbackSending $event)
    {
        //
    }
}
