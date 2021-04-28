<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VotingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $vote, $mailSubject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vote, $mailSubject)
    {
        $this->vote = $vote;
        $this->mailSubject = $mailSubject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.vote')
                    ->subject($this->mailSubject)
                    ->with('data',$this->vote);
    }
}
