<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [];


    public function record()
    {
      return $this->morphTo();
    }

    



}
