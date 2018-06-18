<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   

	protected $table = 'images';
    
    public $primaryKey ='image_id';

   	protected $fillable = [];


    public function record()
    {
      return $this->morphTo();
    }





}
