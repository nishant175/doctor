<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Doctor;
use App\Hospital;
use App\Category;
use DB;
use Cache;
use Config;

class DoctorController extends Controller
{
    /**
     * Display a listing of the active resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::connection()->enableQueryLog();
        $doctors = Cache::remember('doctors', Config::get('constants.seconds.one_day'), function () {
            return Doctor::get();
        });

        //$queries = DB::getQueryLog();

        //\Log::info($queries);

        return view('admin.doctor.index', compact('doctors'));
    }

    /**
     * Display a listing of the Trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $doctors = Doctor::onlyTrashed()->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospitals = Hospital::get();
        $categories = Category::get();
        return view('admin.doctor.create', compact('hospitals', 'categories'));
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
            'name' => 'required|min:3|max:255',
            'slug' => 'required|unique:doctors',
            'designation' => 'required|min:3|max:255',
            'experience' => 'required|min:3|max:255',
            'qualification' => 'required|min:1',
            'speciality' => 'required|min:1',
        ]);

        $data = $request->all();

        if(isset($data['qualification']))
        {
            $qualification = $data['qualification'];
            unset($data['qualification']);
            $data['qualification'] = implode(',', $qualification);
        }

        if(isset($data['speciality']))
        {
            $speciality = $data['speciality'];
            unset($data['speciality']);
            $data['speciality'] = implode(',', $speciality);
        }

        Doctor::create($data);

        return redirect()->route('doctor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('admin.doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctor.index');
    }      
}
