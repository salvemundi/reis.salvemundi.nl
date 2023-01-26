<?php

namespace App\Mail;

use App\Models\Blog;
use App\Models\ConfirmationToken;
use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class participantMail extends Mailable
{
    use Queueable, SerializesModels;

    private Participant $participant;
    private Blog $blog;
    private ConfirmationToken $confirmationToken;
    private bool $sendToken;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant, Blog $blog, bool $sendToken)
    {
        $this->participant = $participant;
        $this->blog = Blog::find($blog->id);
        $this->sendToken = $sendToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $newConfirmationToken = null;
        Log::info($this->sendToken);
        if($this->sendToken == 1 && !$this->participant->hasCompletedAllPayments()) {
            $newConfirmationToken = new ConfirmationToken();
            $newConfirmationToken->participant()->associate($this->participant);
            $newConfirmationToken->save();
        }
        if($newConfirmationToken != null) {
            return $this->markdown('mails/participantMail', ['participant' => $this->participant, 'konttent' => $this->blog->content, 'confirmationToken' => $newConfirmationToken])->subject($this->blog->name);
        } else {
            return $this->markdown('mails/participantMail', ['participant' => $this->participant, 'konttent' => $this->blog->content])->subject($this->blog->name);

        }
    }
}
