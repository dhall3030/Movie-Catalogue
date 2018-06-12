<?php

namespace App\Helpers;

use App\Movie;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Facade;

class UploadHelper extends Facade 
{


	public static function uploadImage($images,$movie_id){


		
		// $fileName = time().'.'.$image->getClientOriginalExtension();

    // 	$image->move(public_path('storage'), $fileName);

    	foreach ($images as $image) {	
          
          $path = $image->store('public');
    		
          $fileName =basename($path);
        
          $movie = Movie::find($movie_id);

    		  $image = new Image();

    		  $image->image_name = $fileName;

    		  $movie->images()->save($image);

      }

	}



  public static function deleteImages($images){

      

      $i = 0;

      $file_names = array();

      foreach ($images as $image) {    

               
              $file_names[$i] = $image->image_name;

              $i++;
      }


      $delete = Storage::disk('public')->delete($file_names);



      return $delete;


  }




}