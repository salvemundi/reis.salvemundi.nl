<?php

namespace App\Mail;

use App\Models\ConfirmationToken;
use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class finalPayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private Participant $participant;
    private ConfirmationToken $confirmationToken;

    public function __construct(Participant $participant, ConfirmationToken $confirmationToken) {
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
            ->subject("Final payment")
            ->markdown('mails/finalPayment',['participant' => $this->participant, 'confirmationToken' => $this->confirmationToken]);
    }
}
