<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Post;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function destinations()
    {
        $trips = Trip::with('categories')->orderBy('created_at', 'desc')->get();
        $categories = Category::with('posts')->take(6)->get();
        $recent_posts = Post::orderBy('created_at', 'desc')->take(4)->get();

        return view('destinations', compact('trips'));
    }

    public function single_destinations($id)
    {
        $trip = Trip::with('categories')->find($id);
        $trip['attachments'] =  $this->GetAttachments($trip['picture_path']); 
        
        $some_trips = Trip::inRandomOrder(4)->where('id', '!=', $id)->get();

        return view('destination_details', compact('trip', 'some_trips'));
    }

    public function blog()
    {
        $posts = Post::with('categories')->orderBy('created_at', 'desc')->get();
        $categories = Category::with('posts')->take(6)->get();
        $recent_posts = Post::orderBy('created_at', 'desc')->take(4)->get();

        return view('blog', compact('posts', 'categories', 'recent_posts'));
    }

    public function single_blog($id)
    {
        $post = Post::with('categories')->find($id);
        $post['attachments'] =  $this->GetAttachmentsBlog($post['picture_path']); 

        // dd($post);
        $recent_posts = Post::orderBy('created_at', 'desc')->where('id', '!=', $id)->take(4)->get();
        $categories = Category::with('posts')->take(6)->get();

        $previous_post = Post::where('id', '<', $post['id'])->orderBy('id', 'desc')->first();
        $next_post = Post::where('id', '>', $post['id'])->orderBy('id')->first();

        // dd($previous_trip, $next_trip);

        return view('blog_details', compact('post', 'recent_posts', 'categories', 'previous_post', 'next_post'));
    }

    public function contact()
    {
        return view('contact');
    }


    public function GetAttachments($picture_path){
        $path = base_path() . "/public/tripsImages/" . $picture_path;
        // return $path;

        // $coming_files = scandir($path);
        // return $coming_files;
        
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

    public function GetAttachmentsBlog($picture_path){
        $path = base_path() . "/public/blogImages/" . $picture_path;
        // return $path;

        // $coming_files = scandir($path);
        // return $coming_files;
        
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

}
