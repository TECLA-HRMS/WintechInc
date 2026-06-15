<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\CompanyRegistration;

class CompanyRegistrationNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $registration;
    public $adminName;

    /**
     * Create a new message instance.
     */
    public function __construct(CompanyRegistration $registration, $adminName = 'Admin')
    {
        $this->registration = $registration;
        $this->adminName = $adminName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Company Registration - ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.company-registration-notification',
            with: [
                'registration' => $this->registration,
                'adminName' => $this->adminName,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        $attachments = [];

        // Attach job brief if exists
        if ($this->registration->job_brief_path && file_exists(storage_path('app/public/' . $this->registration->job_brief_path))) {
            $attachments[] = storage_path('app/public/' . $this->registration->job_brief_path);
        }

        return $attachments;
    }

    /**
     * Build the message (alternative method for Laravel < 9.x)
     */
    public function build()
    {
        $mail = $this->view('emails.company-registration-notification')
                    ->subject('New Company Registration - ' . config('app.name'))
                    ->with([
                        'registration' => $this->registration,
                        'adminName' => $this->adminName,
                    ]);

        // Attach job brief file if exists
        if ($this->registration->job_brief_path && file_exists(storage_path('app/public/' . $this->registration->job_brief_path))) {
            $mail->attach(storage_path('app/public/' . $this->registration->job_brief_path), [
                'as' => 'Job_Description_' . $this->registration->name . '.' . pathinfo($this->registration->job_brief_path, PATHINFO_EXTENSION),
                'mime' => $this->getMimeType($this->registration->job_brief_path),
            ]);
        }

        // Attach company logo if exists
        if ($this->registration->company_logo_path && file_exists(storage_path('app/public/' . $this->registration->company_logo_path))) {
            $mail->attach(storage_path('app/public/' . $this->registration->company_logo_path), [
                'as' => 'Company_Logo_' . $this->registration->name . '.' . pathinfo($this->registration->company_logo_path, PATHINFO_EXTENSION),
                'mime' => $this->getMimeType($this->registration->company_logo_path),
            ]);
        }

        return $mail;
    }

    /**
     * Get MIME type for file
     */
    private function getMimeType($filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'txt' => 'text/plain',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ];

        return $mimeTypes[$extension] ?? 'application/octet-stream';
    }
}