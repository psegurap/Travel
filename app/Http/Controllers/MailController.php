<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Mail\SubscriberMail;
use App\Mail\NewSubscriberNotification;
use App\Mail\AdminSubscriberNotification;
use App\Mail\ReservationCreatedMail;
use App\Mail\ReservationCreatedAdminMail;
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
        $broadcast_object->attachments = $this->GetAttachments($request->attach_reference);

        
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

        if(count($broadcast_object->attachments)){
            foreach ($broadcast_object->attachments as $picture) {
                unlink($picture);
            }
            $parent_path = base_path() . "/public/broadcastImages/" . $request->attach_reference;
            rmdir($parent_path);
        }
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

    public static function SendBookingDetails($reservation, $trip, $customer, $country){

        if(App::getLocale() == 'es'){
            $reservation_status = "En progreso"; 
            $trip_name = $trip['title_es'];
            $country_name = $country['country_es'];
            $subject = env('APP_NAME') . " - Información de reserva";
        }else{
            $reservation_status = "Pending"; 
            $trip_name = $trip['title_en'];
            $country_name = $country['country_en'];
            $subject = env('APP_NAME') . " - Booking information";
        }


        $data = new \stdClass;
        $data->ticket_number = $reservation['id'];
        $data->reservation_status = $reservation_status;
        $data->trip_selected = $trip_name;
        $data->trip_url = $trip['id'];
        $data->adults_quantity = $reservation['adults_amount'];
        $data->kids_quantity = $reservation['kids_amount'];
        $data->adults_total = $reservation['adults_total'];
        $data->kids_total = $reservation['kids_total'];
        $data->adults_kids_total = $reservation['total_amount'];
        $data->customer_name = $customer['customer_name'];
        $data->customer_email = $customer['customer_email'];
        $data->customer_address = $customer['customer_adddress'];
        $data->customer_city = $customer['customer_city'];
        $data->customer_zipCode = $customer['customer_zipCode'];
        $data->customer_country = $country_name;
        $data->customer_phone = $customer['customer_cellphone'];
        $data->subject = $subject;

        $admins = User::where('admin', 1)->get();

        Mail::to($data->customer_email)->send(new ReservationCreatedMail($data));

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new ReservationCreatedAdminMail($data));
        }

    }




    //------------------- ATTACHMENTS ---------------------//
    
    public function GetAttachments($picture_path){
        $path = base_path() . "/public/broadcastImages/" . $picture_path;
        $attachments = [];

        if(file_exists($path)){
            $coming_files = scandir($path);
            foreach ($coming_files as $file) {
                if($file != "" && $file != "." && $file != ".."){
                    $file_with_path = base_path() . "/public/broadcastImages/" . $picture_path . "/" . $file;
                    array_push($attachments, $file_with_path);
                }
            }
        }
        return $attachments;
    }
}
