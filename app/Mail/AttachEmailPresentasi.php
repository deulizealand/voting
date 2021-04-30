<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AttachEmailPresentasi extends Mailable
{
    use Queueable, SerializesModels;
    private $userInvitation;
    public $subject;
    public $fileEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userInvitation, $subject, $fileEmail)
    {
        $this->userInvitation = $userInvitation;
        $this->subject = $subject;
        $this->fileEmail = $fileEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path = storage_path('app/public');
        return $this->markdown('emails.pengantar')
                    ->subject($this->subject)
                    ->attach($this->fileEmail)
                    ->with('data',$this->userInvitation);
    }
}
