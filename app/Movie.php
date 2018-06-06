<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    
    public $primaryKey ='movie_id';
    
    public function category()
	{
       return $this->belongsTo('App\Category', 'category_id', 'category_id');

    }

    public function tags()
	{
    
    return $this->hasMany('App\Tag_Detail','movie_id', 'movie_id');
	
	}

    public function images()
    {
    return $this->morphMany('App\Image', 'record');
    }


}
