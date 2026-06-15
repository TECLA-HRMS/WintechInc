<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CoursePdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;

    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Your Course Syllabus')
                    ->view('emails.course_pdf')
                    ->attach($this->pdfPath, [
                        'as' => 'course_syllabus.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}