<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitals = Hospital::paginate(10);
        return View('hospitals.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('hospitals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:hospitals',
            'address' => 'required',
            'pincode'  => 'required|numeric',
            
        ]);
        $hospitals = Hospital::create($validatedData);
        return redirect('/hospitals')->with('success', 'Hospital is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        return View('hospitals.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospital $hospital)
    {
        $nameCheck = ($request->input('name') != '') && ($request->input('name') != $hospital->name);
        if ($nameCheck){
            $validatedData = $request->validate([
                'name' => 'required|max:255|unique:diagnostic_centres',
                'address' => 'required',
                'pincode' => 'required|numeric',
            ]);
        } else {
            $validatedData = $request->validate([
                'address' => 'required',
                'pincode' => 'required|numeric',
            ]);
        }
        
        
        $hospital->update($validatedData);
        return back()->with('success', 'Hospital updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
    }
}
