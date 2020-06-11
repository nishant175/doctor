<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function hospital()
   	{
   		return $this->belongsTo('App\Hospital');
   	}

   	public function category()
   	{
   		return $this->belongsTo('App\Category');
   	}
}
