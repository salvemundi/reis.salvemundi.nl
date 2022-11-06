<?php

namespace App\Mail;

use App\Models\ConfirmationToken;
use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailConfirmationSignup extends Mailable
{
    use Queueable, SerializesModels;

    private Participant $participant;
    private ConfirmationToken $confirmationToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant, ConfirmationToken $confirmationToken)
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
