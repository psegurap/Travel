<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::all();
        // dd($subscribers);
        return view('admin.maintenance.subscribers', compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ['email_address' => $request->email, 'status' => 1, 'language' => $request->lang];
        Subscriber::create($data);
        $mailcontroller = MailController::new_subscriber_notification($request->email);
        $result = Subscriber::all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $subscriber = Subscriber::find($id);
        if($subscriber->status == 1){
            Subscriber::find($id)->update(['status' => 0]);
        }else{
            Subscriber::find($id)->update(['status' => 1]);
        }
        $subscribers = Subscriber::all();
        return response()->json($subscribers, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function broadcast_message(){
        return view('admin.maintenance.broadcast_message');
    }



    //------------------- ATTACHMENTS ---------------------//
    
    public function broadcast_attachments(Request $request){
        //Getting path to upload files
        $path = base_path() . "/public/broadcastImages/" . $request->attach_reference;
        //Files coming from user
        $files = $request->file();

        //If the path doesn't exist, create it
        if(!file_exists($path)){
            mkdir($path);
        }

        //Running over every file to insert it in server
        foreach ($files['file'] as $file) {
            $file->move($path,$file->getClientOriginalName());
        }

    }

}
