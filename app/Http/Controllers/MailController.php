<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

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
}
