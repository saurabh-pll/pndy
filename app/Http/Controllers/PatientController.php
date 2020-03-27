<?php

namespace App\Http\Controllers;

use App\Category;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::paginate(10);
        return View('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return View('patients.create', compact('categories'));
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
            'name' => 'required|max:255|unique:diagnostic_centres',
            'age' => 'required|numeric',
            'sex' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode'  => 'required|numeric',
            'mobile'  => 'required|numeric',
            'aadhar_no'   => 'nullable|numeric',
        ]);
        $uploadedFile = $request->file('file');
        $filename = time().$uploadedFile->getClientOriginalName();

        Storage::disk('local')->putFileAs(
        'files/'.$filename,
        $uploadedFile,
        $filename
        );
        $patient = Patient::create([
            'name' => $request->get('name'),
            'age' => $request->get('age'),
            'sex' => $request->get('sex'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'pincode'  => $request->get('pincode'),
            'mobile'  => $request->get('mobile'),
            'aadhar_no'   => $request->get('aadhar_no'),
            'file' => $filename,
        ]);
        $patient->categories()->attach($request->categories);
        return redirect('/patients')->with('success', 'Patient is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
