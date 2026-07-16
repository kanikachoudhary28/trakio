<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentData;

    public function __construct($studentData)
    {
        $this->studentData = $studentData;
    }

    public function build()
    {
        return $this->subject('Welcome to Trakio - Your Login Credentials')
                    ->view('admin.emails.student_welcome');
    }
}