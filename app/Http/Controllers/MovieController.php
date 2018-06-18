<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Category;
use App\Tag;
use App\Tag_Detail;
use App\Helpers\UploadHelper;
use App\Helpers\TagHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::paginate(15);
    
        return view('movie.index', ['movies' => $movies]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = Category::pluck('name', 'category_id');

        $tags = Tag::all();
        
        return view('movie.create', compact('categories' ,'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = array(
        'name' => 'required', 
        'year' => 'required',
        'description' => 'required'
        );  

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
                    
        return Redirect::to('/create-movie/')
                        
        ->withErrors($validator) // send back all errors to the login form
        ->withInput(); // send back the input (not the password) so that we can repopulate the form
                    
                    
        } else {


            $movie = new Movie;

            $movie->name = $request->name;
            $movie->year = $request->year;
            $movie->category_id = $request->category_id;
            $movie->description = $request->description;
            
            $movie->save();

            //insert tags

            $arrlength = count($request->tags);

            for($x = 0; $x < $arrlength; $x++) {
                
                $tag = new Tag_Detail;
                $tag->movie_id = $movie->movie_id;
                $tag->tag_id = $request->tags[$x];
                $tag->save();
                
            }


            if($request->user_file != null){

            UploadHelper::uploadImage($request->user_file, $movie->movie_id);

            }

            return Redirect::to('/')->withFlashMessage('Movie Created Successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $movie_id
     * @return \Illuminate\Http\Response
     */
    public function edit($movie_id)
    {
         
        $movie = Movie::find($movie_id);

        // if(@!is_null($movie->images()->where('primary_image',true)->first()->image_name)){

        // $primary_image = $movie->images()->where('primary_image',true)->first()->image_name; 

        // } else {

        // $primary_image = NULL; 

        // }

        $categories = Category::pluck('name', 'category_id');

        $tags = Tag::all();

        //get selected tags and maintain state.
        $selectedTags = TagHelper::getTags($movie->tags);

        //return view('movie.edit' , ['movie' => $movie, 'categories'=>$categories,'tags' => $tags]);
    
      
        return view('movie.edit' , compact('movie', 'categories' ,'tags','selectedTags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $movie_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $movie_id)
    {
        
        
        // var_dump($request->tags);
        // die();


        $movie = Movie::find($movie_id);

        $rules = array(
        'name' => 'required', 
        'year' => 'required',
        'description' => 'required'
        );  

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
                    
        return Redirect::to('/edit-movie/'.$movie_id)
                        
        ->withErrors($validator) // send back all errors to the login form
        ->withInput(); // send back the input (not the password) so that we can repopulate the form
                    
                    
        } else {


           

            $movie->name = $request->name;
            $movie->year = $request->year;
            $movie->category_id = $request->category_id;
            $movie->description = $request->description;
            
            $movie->save();

            //insert tags 

            $deletedRows = Tag_Detail::where('movie_id', $movie_id)->delete();


            $arrlength = count($request->tags);

            for($x = 0; $x < $arrlength; $x++) {
                
                $tag = new Tag_Detail;
                $tag->movie_id = $movie->movie_id;
                $tag->tag_id = $request->tags[$x];
                $tag->save();
                
            }

            if($request->user_file != null){

            UploadHelper::uploadImage($request->user_file, $movie_id);

            }

            return Redirect::to('/')->withFlashMessage('Movie Created Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $movie_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($movie_id)
    {
        
        
        


        $movie = Movie::find($movie_id);
        
        
        //delete all image files on disk attached to movie record
        UploadHelper::deleteImages($movie->images);

        //delete image file records
        $movie->images()->delete();
         
        //delete movie record
        $movie->delete();

        //redirect back to movie page
        return Redirect::to('/')->withFlashMessage('Movie Deleted Successfully.');
    }

    

    /**
     * Set image to primary.
     *
     * @param  int  $image_id
     * @return Illuminate\Support\Facades\Redirect;
     */

    public function setPrimaryImage($image_id){

        //set image to primary 
        $record_id = UploadHelper::setPrimary($image_id);

        //redirect back to movie edit page
        return Redirect::to('/edit-movie/'.$record_id);






    }
    
    /**
     * Remove image record and file from storage.
     *
     * @param  int  $image_id
     * @return Illuminate\Support\Facades\Redirect;
     */


    public function removeImage($image_id){


        $record_id = UploadHelper::deleteSingleImage($image_id);


        return Redirect::to('/edit-movie/'.$record_id)->withFlashMessage('Image Deleted Successfully.');;


    }



}
