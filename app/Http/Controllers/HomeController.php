<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\Post;
use App\Category;
use App;

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
        $some_trips = Trip::inRandomOrder()->take(3)->get();
        $categories = Category::inRandomOrder()->take(6)->get();
        $popular_trips = Trip::with('categories')->inRandomOrder()->take(6)->get();
        return view('index', compact('some_trips', 'categories', 'popular_trips'));
    }

    public function where_search(Request $request){
        $search_data = $request->form;
        $trip_type =  $search_data['trip_type'];

        $current_query = Trip::with('categories')->orderBy('created_at', 'desc');
        if($trip_type != 'All'){
            $trip_type = [$trip_type];
            $current_query->where(function($query) use($trip_type){
                $query->whereHas('categories',function($query) use($trip_type){
                    $query->whereIn('categories.id', $trip_type);
                });
            });
        }

        if($search_data['date'] != null && $search_data['date'] != ''){
            $date =  explode("-", $search_data['date']);
            $current_query->whereYear('created_at', $date[0])->whereMonth('created_at', $date[1]);
        }

        if($search_data['free_input'] != null && $search_data['free_input'] != ''){
            if(App::getLocale() == 'es'){
                $current_query->where('title_es', 'like' , '%' . $search_data['free_input'] . '%');
            }else{
                $current_query->where('title_en', 'like' , '%' . $search_data['free_input'] . '%');
            }
        }

        $trips = $current_query->get();
        return $trips; 

        $trips = Trip::inRandomOrder()->take(10)->get();
        return response()->json($trips, 200);
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
        
        $some_trips = Trip::inRandomOrder()->where('id', '!=', $id)->take(4)->get();

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
