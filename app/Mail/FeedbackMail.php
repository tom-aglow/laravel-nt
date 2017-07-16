<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {
        return $this->view('mails.feedback ')
            ->subject(config('blog.mail.feedbackSubject'))
            ->from([
                'address' => $this->data['email']
            ])
            ->with([
                'data' => $this->data,
            ]);
    }
}
