<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Trip;
use App\Post;
use App\Category;
use App\QuickFeedback;
use App\TripsCommentsReplies;
use App\TripsComments;
use App\WorldCountries;
use App\BuyingCustomer;
use App\ReservationDetail;
use App\Http\Controllers\MailController;


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
        $recent_trips = Trip::with('categories')->where('available_date', '<', date("Y-m-d"))->orderBy('available_date', 'desc')->take(3)->get();
        $feedbacks = QuickFeedback::where('language', App::getLocale())->where('status', 1)->inRandomOrder()->take(3)->get();
        return view('index', compact('some_trips', 'categories', 'popular_trips', 'recent_trips', 'feedbacks'));
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

    }

    public function about()
    {
        $some_trips = Trip::inRandomOrder()->take(2)->get();
        $recent_trips = Trip::with('categories')->where('available_date', '<', date("Y-m-d"))->orderBy('available_date', 'desc')->take(3)->get();
        $feedbacks = QuickFeedback::where('language', App::getLocale())->where('status', 1)->inRandomOrder()->take(3)->get();
        
        return view('about', compact('some_trips', 'recent_trips', 'feedbacks'));
    }

    public function destinations()
    {
        $trips = Trip::with('categories')->orderBy('available_date', 'desc')->take(6)->get();
        $amount_trips = count(Trip::all());
        $categories = Category::inRandomOrder()->take(6)->get();
        $recent_trips = Trip::with('categories')->where('available_date', '<', date("Y-m-d"))->orderBy('available_date', 'desc')->take(3)->get();

        return view('destinations', compact('trips', 'categories', 'amount_trips', 'recent_trips'));
    }

    public function load_more_destinations(Request $request){
        $new_amount = ($request->current_amount + 3);
        $trips = Trip::with('categories')->orderBy('available_date', 'desc')->take($new_amount)->get();
        return response()->json($trips, 200);
    }

    public function single_destinations($id)
    {
        $trip = Trip::with('categories', 'comments.replies', 'user:id,name,img_thumbnail,slogan_es,slogan_en,attach_reference')->find($id);
        $trip['attachments'] =  $this->GetAttachments($trip['picture_path']); 

        if($trip['available_date'] > date("Y-m-d")){
            $trip['available_to_book'] = true;
        }else{
            $trip['available_to_book'] = false;
        }
        
        $some_trips = Trip::inRandomOrder()->where('id', '!=', $id)->take(4)->orderBy('available_date', 'desc')->get();

        return view('destination_details', compact('trip', 'some_trips'));
    }

    public function booking($id){
        $trip = Trip::with('categories', 'comments.replies', 'user:id,name,img_thumbnail,slogan_es,slogan_en,attach_reference')->find($id);
        $trip['attachments'] =  $this->GetAttachments($trip['picture_path']); 
        if(App::getLocale() == 'es'){
            $countries = WorldCountries::orderBy('country_es', 'asc')->get();
        }else{
            $countries = WorldCountries::orderBy('country_en', 'asc')->get();
        }

        return view('create_booking', compact('trip', 'countries'));
    }

    public function save_booking(Request $request){
        $customer_info = $request->customer_info;
        $totals = $request->totals;
        $costumer_data = [
            'customer_name' =>  $customer_info['user_name'],
            'customer_email' =>  $customer_info['user_email'],
            'customer_adddress' =>  $customer_info['user_street'],
            'customer_city' =>  $customer_info['user_city'],
            'customer_zipCode' =>  $customer_info['user_zipCode'],
            'customer_country' =>  $customer_info['user_country'],
            'customer_cellphone' =>  $customer_info['user_mainPhone'],
            'customer_homephone' =>  $customer_info['user_secondPhone'],
            'customer_notes' =>  $customer_info['user_notes'],
            'language' =>  $customer_info['lang'],
            'status' =>  1
        ];

        $buying_customer = BuyingCustomer::create($costumer_data);

        $reservation_data = [
            'adults_amount' =>  $customer_info['adults_amount'],
            'kids_amount' =>  $customer_info['kids_amount'],
            'adults_total' =>  $totals['adults_total'],
            'kids_total' =>  $totals['kids_total'],
            'total_amount' =>  $totals['adults_kids_total'],
            'customer_id' =>  $buying_customer->id,
            'trip_id' =>  $request->trip,
            'reservation_status' =>  1,
            'status' =>  1,
        ];

        $reservation_details = ReservationDetail::create($reservation_data);

        $reservation_details = ReservationDetail::with('customer', 'trip')->find($reservation_details->id);
        $trip = $reservation_details['trip'];
        $customer = $reservation_details['customer'];
        $country = WorldCountries::find($customer['customer_country']);

        MailController::SendBookingDetails($reservation_details, $trip, $customer, $country);

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

    


    //----------------- ATTACHMENTS ----------------//

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
