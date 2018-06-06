<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Category;
use App\Tag;
use App\Tag_Detail;
use App\Helpers\UploadHelper;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($movie_id)
    {
         
        $movie = Movie::find($movie_id);

        $categories = Category::pluck('name', 'category_id');

        $tags = Tag::all();

        //return view('movie.edit' , ['movie' => $movie, 'categories'=>$categories,'tags' => $tags]);
    
        return view('movie.edit' , compact('movie', 'categories' ,'tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($movie_id)
    {
        
        
        $movie = Movie::find($movie_id);

        $movie->images()->delete();

        $movie->delete();

        //$deletedRows = Movie::where('movie_id', $movie_id)->delete();
        
        return Redirect::to('/')->withFlashMessage('Movie Deleted Successfully.');
    }
}
