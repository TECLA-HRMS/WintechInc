<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $newPassword;

    public function __construct($email, $newPassword)
    {
        $this->email = $email;
        $this->newPassword = $newPassword;
    }

    public function build()
    {
        return $this->subject('Your New Password – Wintech Inc')
                    ->view('emails.custom_reset_password');
    }
}
