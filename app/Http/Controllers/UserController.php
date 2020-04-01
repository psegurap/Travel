<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('admin.user_panel', compact('user'));
    }

    public function update_profile(Request $request){
        $data = [
            'name' => $request->user_details['name'],
            'img_thumbnail' => $request->user_details['picture'],
            'slogan_en' => $request->user_details['slogan_en'],
            'slogan_es' => $request->user_details['slogan_es'],
            'attach_reference' => $request->user_details['attach_reference'],
        ];

        User::find(Auth::user()->id)->update($data);
    }

    //------------------- ATTACHMENTS ---------------------//
    
    public function store_picture(Request $request){
        //Getting path to upload files
        $path = base_path() . "/public/UsersPictures/" . $request->attach_reference;
        $files = $request->file();

        //If the path doesn't exist, create it
        if(!file_exists($path)){
            mkdir($path);
        }

        if(file_exists($path)){
            $coming_files = scandir($path);
            foreach ($coming_files as $file) {
                if($file != "" && $file != "." && $file != ".."){
                    unlink($path . "/" . $file);
                }
            }
        }

        //Running over every file to insert it in server
        foreach ($files['file'] as $file) {
            $file->move($path,$file->getClientOriginalName());
        }
    }

    public function GetAttachments($picture_path){
        $path = base_path() . "/public/tripsImages/" . $picture_path;
        $attachments = [];

        if(file_exists($path)){
            $coming_files = scandir($path);
            foreach ($coming_files as $file) {
                if($file != "" && $file != "." && $file != ".."){
                    array_push($attachments, $file);
                }
            }
        }
        return $attachments;
    }

    public function DeletePicture(Request $request){
        $picture = $request->picture;
        $picture_path = $request->path;
        $path = base_path() . "/public/tripsImages/" . $picture_path . "/" . $picture;
        unlink($path);
        return $this->GetAttachments($picture_path);
    }
}
