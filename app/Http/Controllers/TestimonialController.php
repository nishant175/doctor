<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Testimonial;

use File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the active resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::connection()->enableQueryLog();
        /*$doctors = Cache::remember('doctors', Config::get('constants.seconds.one_second'), function () {
            return Doctor::get();
        });*/

        //$queries = DB::getQueryLog();

        //\Log::info($queries);

        $testimonials = Testimonial::get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    /**
     * Display a listing of the Trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $testimonials = Testimonial::onlyTrashed()->get();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function backToList(Request $request)
    {
        $id = $request->input('id');
        Testimonial::whereId($id)->restore();
        return redirect()->route('testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|min:3|max:255',
            'place' => 'required|min:2|max:50',
            'description' => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);

        $data = $request->all();
        $data['image'] = $imageName;

        Testimonial::create($data);

        return redirect()->route('testimonial.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonial.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.create', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'required|min:3|max:255',
            'place' => 'required|min:2|max:50',
            'description' => 'required|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $testimonial = Testimonial::whereId($id)->first();

        if($request->hasfile('image'))
        {
        	$imageName = time().'.'.$request->image->extension();  
   
        	$request->image->move(public_path('images'), $imageName);

        	File::delete(public_path('images/'.$testimonial->image));
        }

        $data = $request->except(['_token', '_method']);
        $data['image'] = $imageName;

        Testimonial::whereId($id)->update($data);

        return redirect()->route('testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('testimonial.index');
    }
}
