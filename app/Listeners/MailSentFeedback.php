<?php

namespace App\Listeners;

use App\Events\FeedbackSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;

class MailSentFeedback
{
    public function __construct()
    {
        //
    }

    public function handle(FeedbackSending $event)
    {
        Mail::to(config('blog.mail.blogAuthor'))
            ->send(new FeedbackMail($event->getInputData()));
    }
}
