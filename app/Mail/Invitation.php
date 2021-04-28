<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;
    private $userInvitation;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userInvitation, $subject)
    {
        $this->userInvitation = $userInvitation;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invitataion')
                    ->subject($this->subject)
                    ->with('data',$this->userInvite);
    }
}
