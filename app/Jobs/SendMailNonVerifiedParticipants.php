<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Participant;
use App\Models\VerificationToken;
use App\Mail\emailNonVerifiedParticipants;
use Illuminate\Support\Facades\Mail;

class SendMailNonVerifiedParticipants implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Participant $participant;
    private VerificationToken $verificationToken;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Participant $participant, VerificationToken $verificationToken) {
        $this->participant = $participant;
        $this->verificationToken = $verificationToken;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::bcc($this->participant)
            ->send(new emailNonVerifiedParticipants($this->participant, $this->verificationToken));
        $this->release();
    }
}
