<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $job_title;
    public $status;

    public function __construct($name, $job_title, $status)
    {
        $this->name      = $name;
        $this->job_title = $job_title;
        $this->status    = $status;
    }

    public function build()
    {
        $subjects = [
            'pending'     => 'Application Received – ' . $this->job_title,
            'reviewed'    => 'Your Application Has Been Reviewed – ' . $this->job_title,
            'shortlisted' => 'Great News! You\'ve Been Shortlisted – ' . $this->job_title,
            'selected'    => 'Congratulations! You\'ve Been Selected – ' . $this->job_title,
            'rejected'    => 'Application Update – ' . $this->job_title,
        ];

        $subject = $subjects[$this->status] ?? 'Application Status Update – ' . $this->job_title;

        return $this->subject($subject)
                    ->view('emails.application_status')
                    ->with([
                        'name'      => $this->name,
                        'job_title' => $this->job_title,
                        'status'    => $this->status,
                    ]);
    }
}
