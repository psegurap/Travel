<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Auth;

class BlogController extends Controller
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
        return view('admin.blog.add_new', compact('categories'));
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
            'img_thumbnail' => $request->post_info['img_thumbnail'],
            'picture_path' => $request->post_info['attach_reference'],
            'user_id' => Auth::user()->id,
            'status' => 1,
        ];

        //validation to set in specific language
        if($request->lang == 'es'){
            $data['title_es'] = $request->post_info['title'];
            $data['content_es'] = $request->post_info['content'];
            $data['short_description_es'] = $request->post_info['short_description'];
        }else{
            $data['title_en'] = $request->post_info['title'];
            $data['content_en'] = $request->post_info['content'];
            $data['short_description_en'] = $request->post_info['short_description'];
        }

        //getting categories to attach to trip
        $categories = Category::find($request->post_info['categories']);

        //creating post; also inserting relationship in pivot table
        Post::create($data)->categories()->attach($categories);

        return response()->json("Post Saved", 200);
    }


    public function all_posts(){
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.blog.all_posts', compact('posts'));
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
        $post = Post::with('categories')->find($id);
        $post['attachments'] =  $this->GetAttachments($post['picture_path']); 

        $categories = Category::all();
        return view('admin.blog.edit', compact('post', 'categories'));
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
            'img_thumbnail' => $request->post_info['img_thumbnail'],
        ];

        if($request->lang == 'es'){
            $data['title_es'] = $request->post_info['title'];
            $data['content_es'] = $request->post_info['content'];
            $data['short_description_es'] = $request->post_info['short_description'];
        }else{
            $data['title_en'] = $request->post_info['title'];
            $data['content_en'] = $request->post_info['content'];
            $data['short_description_en'] = $request->post_info['short_description'];
        }

        Post::find($request->post_info['id'])->update($data);
        Post::find($request->post_info['id'])->categories()->detach();

        $categories = Category::find($request->post_info['categories']);
        Post::find($request->post_info['id'])->categories()->attach($categories);

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
        $path = base_path() . "/public/blogImages/" . $request->attach_reference;
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
        $path = base_path() . "/public/blogImages/" . $request->attach_reference;
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
        $post = Post::where('picture_path' , $request->attach_reference)->first();
        return response()->json($post->id, 200);
    }

    public function GetAttachments($picture_path){
        $path = base_path() . "/public/blogImages/" . $picture_path;
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
        $path = base_path() . "/public/blogImages/" . $picture_path . "/" . $picture;
        unlink($path);
        return $this->GetAttachments($picture_path);
    }

}
