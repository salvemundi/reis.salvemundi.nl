<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Participant;

class VerifySignUpWaitingList extends Mailable
{
    use Queueable, SerializesModels;

    private Participant $participant;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant) {
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->subject("Confirmation e-mail verification")
                ->markdown('mails/verifySignUpWaitingList', ['participant'=> $this->participant]);
    }
}
