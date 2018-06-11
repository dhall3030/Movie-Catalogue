<?php
namespace App\Helpers;
use App\Movie;
use App\Tag;
use App\Tag_Detail;
use Illuminate\Support\Facades\Facade; 


class TagHelper extends Facade 
{

	public static function getTags($tags){

		$movie_tags = array();

		$i = 0;

		foreach ($tags as $tag) {

			$movie_tags[$i] = $tag->tag->name;

			$i++;
		}


		return $movie_tags;
	

	}


}
