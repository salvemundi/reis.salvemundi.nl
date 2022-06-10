<?php

namespace App\Mail;

use App\Models\Blog;
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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant, Blog $blog)
    {
        $this->participant = $participant;
        $this->blog = Blog::find($blog->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails/participantMail', ['participant' => $this->participant, 'konttent' => $this->blog->content])->subject($this->blog->name);
    }
}
