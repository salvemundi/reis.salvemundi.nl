<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailVerificationResponse extends Mailable
{
    use Queueable, SerializesModels;

    private Participant $participant;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant)
    {
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
            ->subject("Bevestiging e-mail verificatie")
            ->markdown('mails/emailVerificationResponse',['participant' => $this->participant]);
    }
}
