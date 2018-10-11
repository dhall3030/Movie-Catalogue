<?php

namespace App\Helpers;

use App\Movie;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Redirect;


 

class UploadHelper extends Facade 
{


	
  /**
     * Upload image or multiple images.
     *
     * @param  Array of files  $images 
     * @param  int  $movie_id ,ID of movie the images will belong to.
     * @return 
     */

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

  /**
     * Delete all images attached to a record.
     *
     * @param object $images
     * @return true if deletion is successfull
     */

  public static function deleteImages($images){

      // var_dump($images);

      // die();

      $i = 0;

      $file_names = array();

      foreach ($images as $image) {    

               
              $file_names[$i] = $image->image_name;

              $i++;
      }


      $delete = Storage::disk('public')->delete($file_names);



      return $delete;


  }
  
  /**
     * Set an uploaded image to be used as primary.
     *
     * @param  ID of image  $image_id
     * @return ID of record the image belongs to.
     */


  public static function setPrimary($image_id){

      //die( $image_id);

      $image = Image::find($image_id);

      $record_id = $image->record_id;

      //die($record_id);

      Image::where('record_id', $record_id)->update(['primary_image' => 0]);

      $image->primary_image = 1;

      $image->save();
     
      return $record_id;

    


  }

  /**
     * Delete individual image 
     *
     * @param  ID of image  $image_id
     * @return  ID of record the image belongs to.
     */
  public static function deleteSingleImage($image_id){

      $image= Image::find($image_id);

      $deleteImageRecord = $image->delete();

      $deleteFile = Storage::disk('public')->delete($image->image_name);

      return $image->record_id;

  }




}