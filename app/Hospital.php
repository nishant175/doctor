<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
   	use SoftDeletes;

   	public function hospital()
   	{
   		return $this->hasMany('App\Doctors');
   	}
}
