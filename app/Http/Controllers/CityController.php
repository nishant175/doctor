<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::where('state_id', $request->input('stateId'))->get();
        $data = '<select required  class="form-control" name="city"><option value="">-- Please select --</option>';
        foreach($cities as $city){
         $data .=  '<option value="'.$city->id.'">'. $city->name .'</option>';
        }
        $data .= '</select>';
        echo $data; die;
    }
}
