<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Doctor;
use App\Hospital;
use App\Category;

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

        $hospitals = Hospital::get();
        return view('admin.hospital.index', compact('hospitals'));
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
        return view('admin.hospital.create');
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
            //'slug' => 'required|unique:doctors',
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
        return view('admin.hospital.create', compact('hospital'));
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
