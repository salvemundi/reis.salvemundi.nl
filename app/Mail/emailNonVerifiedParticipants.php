<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Participant;
use App\Models\VerificationToken;

class emailNonVerifiedParticipants extends Mailable
{
    use Queueable, SerializesModels;

    private $participant;
    private $verificationToken;
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
            ->subject("Je hebt je email nog niet geverifieerd")
            ->markdown('mails/emailResendVerification', ['participant'=> $this->participant, 'verificationToken' => $this->verificationToken]);
    }
}
