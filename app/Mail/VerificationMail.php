<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($participant, $verificationToken)
    {
        $this->participant = $participant;
        $this->verificationToken = $verificationToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject("Aanmelding Salve Mundi FHICT introductie")
                ->markdown('mails/signup',['participant'=> $this->participant, 'verificationToken' => $this->verificationToken]);
    }
}
