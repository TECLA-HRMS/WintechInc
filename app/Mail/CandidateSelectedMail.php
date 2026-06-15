<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateSelectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $job_title;
    public $email;

    public function __construct($applicationData)
    {
        // Handle both object and array
        if (is_object($applicationData)) {
            $this->name = $applicationData->name ?? $applicationData->first_name . ' ' . $applicationData->last_name;
            $this->job_title = $applicationData->job_title ?? 'the position';
            $this->email = $applicationData->email;
        } else {
            $this->name = $applicationData['name'] ?? '';
            $this->job_title = $applicationData['job_title'] ?? 'the position';
            $this->email = $applicationData['email'] ?? '';
        }

        \Log::info('CandidateSelectedMail constructed', [
            'name' => $this->name,
            'job_title' => $this->job_title,
            'email' => $this->email
        ]);
    }

    public function build()
    {
        \Log::info('Building CandidateSelectedMail for delivery', [
            'to' => $this->email,
            'name' => $this->name
        ]);

        return $this->subject('Congratulations! You Have Been Selected for ' . $this->job_title)
                    ->view('emails.selected') // Use view instead of markdown for your HTML template
                    ->with([
                        'name' => $this->name,
                        'job_title' => $this->job_title,
                    ]);
    }
}