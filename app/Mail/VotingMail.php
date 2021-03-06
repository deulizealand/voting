<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VotingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $vote, $mailSubject, $body;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vote, $mailSubject,$body)
    {
        $this->vote = $vote;
        $this->mailSubject = $mailSubject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.vote')
                    ->to($this->vote)
                    ->subject($this->mailSubject)
                    ->with('data',$this->body);
    }
}
