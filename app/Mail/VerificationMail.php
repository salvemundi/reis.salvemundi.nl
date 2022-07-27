<?php

namespace App\Mail;

use App\Models\Participant;
use App\Models\VerificationToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    private Participant $participant;
    private VerificationToken $verificationToken;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant, VerificationToken $verificationToken) {
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
                ->markdown('mails/signup', ['participant'=> $this->participant, 'verificationToken' => $this->verificationToken]);
    }
}
