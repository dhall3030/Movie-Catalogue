<?php

namespace App\Helpers;

use App\Movie;
use App\Image;

use Illuminate\Support\Facades\Facade;

class UploadHelper extends Facade 
{


	public static function uploadImage($image,$movie_id){


		
		// $fileName = time().'.'.$image->getClientOriginalExtension();

  // 	$image->move(public_path('storage'), $fileName);

  		$path = $image->store('public');
  		
      $fileName =basename($path);
      
      $movie = Movie::find($movie_id);

  		$image = new Image();

  		$image->image_name = $fileName;

  		$movie->images()->save($image);

	}




}