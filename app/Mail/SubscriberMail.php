<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriberMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $broadcast_data;

    public function __construct($coming_data)
    {
        $this->broadcast_data = $coming_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject($this->broadcast_data->subject)
                    ->view('admin.mail.broadcast_mail');
        if(count($this->broadcast_data->attachments) > 0){
            foreach ($this->broadcast_data->attachments as $picture) {
                $email->attach($picture);
            }
        }
        return $email;
    }
}
