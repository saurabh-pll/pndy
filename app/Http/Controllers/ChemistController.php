<?php

namespace App\Http\Controllers;

use App\Chemist;
use Illuminate\Http\Request;

class ChemistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chemists = Chemist::paginate(10);
        return View('chemist.index', compact('chemists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('chemist.create');
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
        $chemist = Chemist::create($validatedData);
        return redirect('/chemists')->with('success', 'Chemist is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chemist  $chemist
     * @return \Illuminate\Http\Response
     */
    public function show(Chemist $chemist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chemist  $chemist
     * @return \Illuminate\Http\Response
     */
    public function edit(Chemist $chemist)
    {
        return View('chemist.edit', compact('chemist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chemist  $chemist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chemist $chemist)
    {
        $nameCheck = ($request->input('name') != '') && ($request->input('name') != $chemist->name);
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
        
        
        $chemist->update($validatedData);
        return back()->with('success', 'Chemist updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chemist  $chemist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chemist $chemist)
    {
        $chemist->delete();
    }
}
