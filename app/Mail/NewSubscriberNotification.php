<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App;

class NewSubscriberNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $notification_object;

    public function __construct($data)
    {
        $this->notification_object = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        

        $subject = '';
        if(App::getLocale() == 'es'){
            $subject = '¡Gracias por suscribirte!';
        }else{
            $subject = 'Thank you for subscribing!';
        }
        return $this->subject($subject)
                    ->view('admin.mail.new_subscriber_notification');
    }
}
