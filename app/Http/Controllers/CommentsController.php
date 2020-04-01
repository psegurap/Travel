<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TripsComments;
use App\TripsCommentsReplies;

class CommentsController extends Controller
{
    //--------------- TRIPS ------------------------//
    public function store_comment(Request $request){
        $data = [
            'comment' => $request->comment_details['comment'],
            'user_name' => $request->comment_details['name'],
            'comment' => $request->comment_details['comment'],
            'user_email' => $request->comment_details['email'],
            'language' => $request->lang,
            'trip_id' => $request->comment_details['trip_id'],
            'status' => 0
        ];

        if(!$request->comment_details['replying']){
            $data['trip_id'] = $request->comment_details['trip_id'];
            TripsComments::create($data);
        }else{
            $data['comment_id'] = $request->comment_details['comment_id'];
            TripsCommentsReplies::create($data);
        }
        $comments = TripsComments::with('replies')->get();
        return $comments;
    }


}
