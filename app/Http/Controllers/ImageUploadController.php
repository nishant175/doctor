<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Image;

class ImageUploadController extends Controller
{
    function viewImageUpload()
    {
        $images = Image::all();
        return view('admin.image-upload.upload-view', compact('images'));
    }

    function imageUpload(Request $request)
    {
        $path = public_path('media/uploads/'.Carbon::now()->format('d-m-y'));
        $storagePath = 'media/uploads/'.Carbon::now()->format('d-m-y');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $imageName = time().'.'.$request->file('file')->extension();  
        $request->file('file')->move($path, $imageName);

        $data = ['image' => $storagePath.'/'.$imageName];

        Image::create($data);
   
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }

    function viewAll()
    {
        $images = Image::get();
        return view('admin.image-upload.view-all')->with('images', $images);
    }
}