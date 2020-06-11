<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Doctor;
use App\Hospital;
use App\Category;
use DB;
use Cache;
use Config;
use Illuminate\Support\Carbon;

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
        /*$doctors = Cache::remember('doctors', Config::get('constants.seconds.one_second'), function () {
            return Doctor::get();
        });*/

        //$queries = DB::getQueryLog();

        //\Log::info($queries);

        $doctors = Doctor::get();
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

    public function backToList(Request $request)
    {
        $id = $request->input('id');
        DB::connection()->enableQueryLog();
        Doctor::whereId($id)->restore();
        $queries = DB::getQueryLog();
        \Log::info($queries);
        return redirect()->route('doctor.index');
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
    public function edit(Doctor $doctor)
    {
        $hospitals = Hospital::get();
        $categories = Category::get();
        return view('admin.doctor.create', compact('doctor', 'hospitals', 'categories'));
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
            'name' => 'required|min:3|max:255',
            'slug' => 'required|unique:doctors,slug,'.$id,
            'designation' => 'required|min:3|max:255',
            'experience' => 'required|min:3|max:255',
            'qualification' => 'required|min:1',
            'speciality' => 'required|min:1',
        ]);

        $data = $request->except(['_token', '_method']);

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

        Doctor::whereId($id)->update($data);

        return redirect()->route('doctor.index');
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
