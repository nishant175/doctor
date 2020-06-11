<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function doctor()
   	{
   		return $this->hasMany('App\Doctor');
   	}
}
