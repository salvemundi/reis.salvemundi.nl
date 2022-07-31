<?php

namespace App\Mail;

use App\Models\Blog;
use App\Models\ConfirmationToken;
use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class participantMail extends Mailable
{
    use Queueable, SerializesModels;

    private $participant;
    private $blog;
    private ConfirmationToken|bool $confirmationToken;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant, Blog $blog, ConfirmationToken|bool $confirmationToken)
    {
        $this->participant = $participant;
        $this->blog = Blog::find($blog->id);
        $this->confirmationToken = $confirmationToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails/participantMail', ['participant' => $this->participant, 'konttent' => $this->blog->content,'confirmationToken' => $this->confirmationToken])->subject($this->blog->name);
    }
}
