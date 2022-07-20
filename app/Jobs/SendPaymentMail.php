<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Participant;
use App\Models\ConfirmationToken;
use App\Mail\emailConfirmationSignup;
use Illuminate\Support\Facades\Mail;

class SendPaymentMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Participant $participant;
    private ConfirmationToken $confirmationToken;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Participant $participant, ConfirmationToken $confirmationToken)
    {
        $this->participant = $participant;
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::bcc($this->participant)
            ->send(new emailConfirmationSignup($this->participant, $this->confirmationToken));
        $this->release();
    }
}
