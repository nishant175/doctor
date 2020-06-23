<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Doctor;
use App\Hospital;
use App\Category;
use App\State;
use App\City;

class HospitalController extends Controller
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

        $states = State::get();

        $hospitals = Hospital::get();
        return view('admin.hospital.index', compact('hospitals', 'states'));
    }

    /**
     * Display a listing of the Trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $hospitals = Hospital::onlyTrashed()->get();
        return view('admin.hospital.index', compact('hospitals'));
    }

    public function backToList(Request $request)
    {
        $id = $request->input('id');
        Hospital::whereId($id)->restore();
        return redirect()->route('hospital.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::get();
        $cities = [];
        return view('admin.hospital.create', compact('states', 'cities'));
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
            'slug' => 'required|unique:hospitals',
            'description' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'facilities' => 'required|min:1',
        ]);

        $data = $request->all();
        Hospital::create($data);

        return redirect()->route('hospital.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        return view('admin.hospital.show', compact('hospital'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        $states = State::get();
        $cities = City::where('state_id', $hospital->state)->get();
        return view('admin.hospital.create', compact('hospital', 'states', 'cities'));
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
            //'slug' => 'required|unique:doctors',
            'description' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'facilities' => 'required|min:1',
        ]);

        $data = $request->except(['_token', '_method']);

        Hospital::whereId($id)->update($data);

        return redirect()->route('hospital.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return redirect()->route('hospital.index');
    }
}
