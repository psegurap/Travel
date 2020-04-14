<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Category;
use App\Trip;
use Auth;
class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.trips.add_new', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Setting our data to be inserted
        $data = [
            'img_thumbnail' => $request->trip_info['img_thumbnail'],
            'picture_path' => $request->trip_info['attach_reference'],
            'user_id' => Auth::user()->id,
            'status' => $request->trip_info['status'],
            'adult_price' => $request->trip_info['adult_price'],
            'kid_price' => $request->trip_info['kid_price'],
            'available_date' => $request->trip_info['available_date'],
        ];

        //validation to set in specific language
        if($request->lang == 'es'){
            $data['title_es'] = $request->trip_info['title'];
            $data['content_es'] = $request->trip_info['content'];
            $data['short_description_es'] = $request->trip_info['short_description'];
        }else{
            $data['title_en'] = $request->trip_info['title'];
            $data['content_en'] = $request->trip_info['content'];
            $data['short_description_en'] = $request->trip_info['short_description'];
        }

        //getting categories to attach to trip
        $categories = Category::find($request->trip_info['categories']);

        //creating trip; also inserting relationship in pivot table
        Trip::create($data)->categories()->attach($categories);

        return response()->json("Trip Saved", 200);

    }

    public function all_trips(){
        $trips = Trip::orderBy('created_at', 'desc')->get();
        return view('admin.trips.all_trips', compact('trips'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trip = Trip::with('categories')->find($id);
        $trip['attachments'] =  $this->GetAttachments($trip['picture_path']); 

        $categories = Category::all();
        return view('admin.trips.edit', compact('trip', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = [
            'img_thumbnail' => $request->trip_info['img_thumbnail'],
            'adult_price' => $request->trip_info['adult_price'],
            'kid_price' => $request->trip_info['kid_price'],
            'available_date' => $request->trip_info['available_date'],
            'status' => $request->trip_info['status'],
        ];

        if($request->lang == 'es'){
            $data['title_es'] = $request->trip_info['title'];
            $data['content_es'] = $request->trip_info['content'];
            $data['short_description_es'] = $request->trip_info['short_description'];
        }else{
            $data['title_en'] = $request->trip_info['title'];
            $data['content_en'] = $request->trip_info['content'];
            $data['short_description_en'] = $request->trip_info['short_description'];
        }

        Trip::find($request->trip_info['id'])->update($data);
        Trip::find($request->trip_info['id'])->categories()->detach();

        $categories = Category::find($request->trip_info['categories']);
        Trip::find($request->trip_info['id'])->categories()->attach($categories);

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    //------------------- ATTACHMENTS ---------------------//
    
    public function StoreGalery(Request $request){
        //Getting path to upload files
        $path = base_path() . "/public/tripsImages/" . $request->attach_reference;
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

        return response()->json("Galery Saved", 200);
    }

    public function StoreDefault(Request $request){
        //Getting path to upload files
        $path = base_path() . "/public/tripsImages/" . $request->attach_reference;
        $files = $request->file();

        //If the path doesn't exist, create it
        if(!file_exists($path)){
            mkdir($path);
        }

        //Running over every file to insert it in server
        foreach ($files['file'] as $file) {
            $file->move($path,$file->getClientOriginalName());
        }

        //Getting the most recent trip; that way we can send the user to the trip details
        $trip = Trip::where('picture_path' , $request->attach_reference)->first();
        return response()->json($trip->id, 200);
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
