<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Mail\SubscriberMail;
use App\Mail\NewSubscriberNotification;
use App\Mail\AdminSubscriberNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Subscriber;
use App\User;
use App\BroadcastRecord;
use Auth;

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

        $boadcast_info = [
            'subject' => $broadcast_details['subject'],
            'language' => App::getLocale(),
            'user_id' => Auth::id()
        ];
        BroadcastRecord::create($boadcast_info);
    }

    public static function new_subscriber_notification($email_address){
        $date = Carbon::now();

        $notification_object = new \stdClass;
        if(App::getLocale() == 'es'){
            $notification_object->logo = base_path() . "/public/img/BIENVENIDO.jpg";
        }else{
            $notification_object->logo = base_path() . "/public/img/WELCOME.jpg";
        }

        Mail::to($email_address)->send(new NewSubscriberNotification($notification_object));
        self::admin_notification_subscriber($email_address);
    }

    public static function admin_notification_subscriber($email_address){
        $date = Carbon::now();

        $message_object = new \stdClass;
        $message_object->user_email = $email_address;
        $message_object->user_lang = App::getLocale(); 
        $message_object->date = $date->toDateString();
        $message_object->time = $date->toTimeString();

        $admins = User::where('admin', 1)->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new AdminSubscriberNotification($message_object));
        }

    }
}
