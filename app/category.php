<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
    
    public $primaryKey ='category_id';


    public function movies()
	{
    
    return $this->hasMany('App\Movie','movie_id', 'movie_id');
	
	}


}
