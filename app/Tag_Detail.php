<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag_Detail extends Model
{
    
	protected $table = 'tag_details';
    
    public $primaryKey ='tag_detail_id';

    public $timestamps = false;


	public function tag()
	{
       return $this->belongsTo('App\Tag', 'tag_id', 'tag_id');

    }


    public function movie()
	{
       return $this->belongsTo('App\Movie', 'movie_id', 'movie_id');

    }
}
