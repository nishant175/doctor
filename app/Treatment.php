<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $guarded = [];

    public function hospital()
    {
    	return $this->belongsTo('App\Hospital');
    }

    public function doctor()
    {
    	return $this->belongsTo('App\Doctor');
    }
}
