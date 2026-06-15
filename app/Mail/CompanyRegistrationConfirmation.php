<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CompanyRegistration;

class CompanyRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct(CompanyRegistration $registration)
    {
        $this->registration = $registration;
    }

    public function build()
    {
        return $this->subject('Thank You for Your Company Registration')
                    ->view('emails.company-registration-confirmation')
                    ->with(['registration' => $this->registration]);
    }
}