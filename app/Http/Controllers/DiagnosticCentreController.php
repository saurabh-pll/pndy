<?php

namespace App\Http\Controllers;

use App\DiagnosticCentre;
use Illuminate\Http\Request;
use App\Test;
use Doctrine\DBAL\Schema\View;

class DiagnosticCentreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = DiagnosticCentre::paginate(10);
        return View('labsmanagement.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tests = Test::all();

        return View('labsmanagement.create', compact('tests'));
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
            'address' => 'required',
            'pincode'  => 'required|numeric',
            'mobile'  => 'required|numeric',
            'email'   => 'nullable|email',
            'payment_mechanism' => 'required',
            'payment_frequency' => 'required',
        ]);
        $lab = DiagnosticCentre::create($validatedData);
        $tests = $request->input('tests');
        $prices = $request->input('price');
        if($tests){
            for ($i=0; $i < count($tests); $i++) { 
                $lab->tests()->attach([$tests[$i] => ['price' => $prices[$i]]]);
            }
        }
        return redirect('/labs')->with('success', 'Diagnostic Lab is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiagnosticCentre  $diagnosticCentre
     * @return \Illuminate\Http\Response
     */
    public function show(DiagnosticCentre $diagnosticCentre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DiagnosticCentre  $diagnosticCentre
     * @return \Illuminate\Http\Response
     */
    public function edit(DiagnosticCentre $lab)
    {
        $tests = Test::all();
        return View('labsmanagement.edit', compact('lab', 'tests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiagnosticCentre  $diagnosticCentre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiagnosticCentre $lab)
    {
        $nameCheck = ($request->input('name') != '') && ($request->input('name') != $lab->name);
        if ($nameCheck){
            $validatedData = $request->validate([
                'name' => 'required|max:255|unique:diagnostic_centres',
                'address' => 'required',
                'pincode' => 'required|numeric',
                'mobile'  => 'required|numeric',
                'email'   => 'nullable|email',
                'payment_mechanism' => 'required',
                'payment_frequency' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'address' => 'required',
                'pincode' => 'required|numeric',
                'mobile'  => 'required|numeric',
                'email'   => 'nullable|email',
                'payment_mechanism' => 'required',
                'payment_frequency' => 'required',
            ]);
        }
        
        
        $lab->update($validatedData);
        $tests = (array) $request->input('tests');
        $prices = (array) $request->input('price');
        $pivotedData = array();
        foreach ($tests as $key => $value) {
            $pivotedData[$value] = array ('price' => $prices[$key]);
        }
        $lab->tests()->sync($pivotedData);
        return back()->with('success', 'Diagnostic Lab updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DiagnosticCentre  $diagnosticCentre
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiagnosticCentre $lab)
    {
        $lab->tests()->detach();
        $lab->delete();
    }
}
