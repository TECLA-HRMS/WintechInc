<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobNewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $subscriberEmail;

    public function __construct($job, $subscriberEmail = '')
    {
        $this->job             = $job;
        $this->subscriberEmail = $subscriberEmail;
    }

    public function build()
    {
        return $this->subject('New Job Alert: ' . $this->job['job_title'])
                    ->view('emails.job-newsletter')
                    ->with(['subscriberEmail' => $this->subscriberEmail]);
    }
}
