<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptInvitation extends Mailable
{
    use Queueable, SerializesModels;
    private $userInvite;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userInvite,$subject)
    {
        $this->userInvite = $userInvite;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.accept-invitation')
                    ->subject($this->subject)
                    ->with('data',$this->userInvite);
    }
}
