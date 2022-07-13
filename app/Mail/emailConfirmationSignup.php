<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailConfirmationSignup extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($participant, $confirmationToken)
    {
        $this->participant = $participant;
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("Afronding inschrijving voor de introductie!")
            ->markdown('mails/emailConfirmationResponse',['participant' => $this->participant, 'confirmationToken' => $this->confirmationToken]);
    }
}
