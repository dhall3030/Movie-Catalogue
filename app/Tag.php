<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    
    public $primaryKey ='tag_id';

    public $timestamps = false;

    public function details()
	{
    
    return $this->hasMany('App\Tag_Detail','tag_id', 'tag_id');
	
	}




}


