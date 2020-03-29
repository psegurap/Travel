<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuickFeedback;

class LayoutsController extends Controller
{

    public function store_quick_feedback(Request $request){
        $data = [
            'visitor_name' => $request->feedback_info['name'],
            'visitor_feedback' => $request->feedback_info['feedback'],
            'img_thumbnail' => $request->feedback_info['img_thumbnail'],
            'language' => $request->feedback_info['lang'],
            'status' => 0,
        ]; 

        QuickFeedback::create($data);
        return response()->json('', 200);

    }

    public function all_quick_feedbacks(){
        $feedbacks = QuickFeedback::all();
        return view('admin.maintenance.quick_feedback', compact('feedbacks'));
    }

    public function update_feedback($id)
    {
        $feedback = QuickFeedback::find($id);
        if($feedback->status == 1){
            QuickFeedback::find($id)->update(['status' => 0]);
        }else{
            QuickFeedback::find($id)->update(['status' => 1]);
        }
        $feedbacks = QuickFeedback::all();
        return response()->json($feedbacks, 200);
    }
    

    //------------------- ATTACHMENTS ---------------------//
    
    public function quick_feedback_store_attachment(Request $request){
        //Getting path to upload files
        $path = base_path() . "/public/QuickFeedbackUsers";
        //Files coming from user
        $files = $request->file();

        //If the path doesn't exist, create it
        if(!file_exists($path)){
            mkdir($path);
        }

        //Running over every file to insert it in server
        foreach ($files['file'] as $file) {
            $file->move($path, $file->getClientOriginalName());
        }

        return response()->json("Saved", 200);
    }
}
