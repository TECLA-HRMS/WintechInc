<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $data;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param array $data
     * @return void
     */
    public function __construct($subject, $data)
    {
        $this->subject = $subject;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->markdown('emails.admin-credentials')
                    ->with(['data' => $this->data]);
    }
}