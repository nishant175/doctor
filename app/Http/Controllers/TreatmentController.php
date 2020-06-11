<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Doctor;
use App\Hospital;
use App\Treatment;

class TreatmentController extends Controller
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

        $treatments = Treatment::get();
        return view('admin.treatment.index', compact('treatments'));
    }

    /**
     * Display a listing of the Trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $treatments = Treatment::onlyTrashed()->get();
        return view('admin.treatment.index', compact('treatments'));
    }

    public function backToList(Request $request)
    {
        $id = $request->input('id');
        Treatment::whereId($id)->restore();
        return redirect()->route('treatment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$hospitals = Hospital::get();
    	$doctors = Doctor::get();
        return view('admin.treatment.create', compact('hospitals', 'doctors'));
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
            'title' => 'required|min:3|max:150',
            //'slug' => 'required|unique:doctors',
        ]);

        $data = $request->all();

        Treatment::create($data);

        return redirect()->route('treatment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        return view('admin.treatment.show', compact('treatment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        $hospitals = Hospital::get();
        $doctors = Doctor::get();
        return view('admin.treatment.create', compact('treatment', 'hospitals', 'doctors'));
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
            'title' => 'required|min:3|max:150',
            //'slug' => 'required|unique:doctors',
        ]);

        $data = $request->except(['_token', '_method']);

        Treatment::whereId($id)->update($data);

        return redirect()->route('treatment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return redirect()->route('treatment.index');
    }
}
