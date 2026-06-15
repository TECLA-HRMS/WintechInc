<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomNewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailSubject;
    public $mailBody;
    public $subscriberEmail;

    public function __construct($subject, $body, $subscriberEmail)
    {
        $this->mailSubject     = $subject;
        $this->mailBody        = $body;
        $this->subscriberEmail = $subscriberEmail;
    }

    public function build()
    {
        return $this->subject($this->mailSubject)
                    ->view('emails.custom-newsletter');
    }
}
