<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Mail\SubscriberMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Subscriber;

class MailController extends Controller
{
    public function SendContactMail(Request $request){
        $email_details = $request->email_details;
        $date = Carbon::now();

        $message_object = new \stdClass;
        $message_object->user_name = $email_details['name'];
        $message_object->user_email = $email_details['email'];
        $message_object->subject = $email_details['subject'];
        $message_object->user_lang = $request['lang']; 
        $message_object->user_message = $email_details['message'];
        $message_object->date = $date->toDateString();
        $message_object->time = $date->toTimeString();

        Mail::to('psegurap01@gmail.com')->send(new ContactMail($message_object));

    }

    public function send_broadcast(Request $request){
        $broadcast_details = $request->broadcast_info;
        $date = Carbon::now();
        
        $broadcast_object = new \stdClass;
        $broadcast_object->message = $broadcast_details['message'];
        $broadcast_object->subject = $broadcast_details['subject'];
        $broadcast_object->year = $date->year;

        if(App::getLocale() == 'es'){
            $subscribers = Subscriber::where('status', 1)->where('language', 'es')->get();
        }else{
            $subscribers = Subscriber::where('status', 1)->where('language', 'en')->get();
        }
        foreach ($subscribers as $subscriber) {
            $broadcast_object->email_address = $subscriber->email_address;
            Mail::to($subscriber->email_address)->send(new SubscriberMail($broadcast_object));
        }
        return "DONE";
    }
}
