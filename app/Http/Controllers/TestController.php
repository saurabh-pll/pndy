<?php

namespace App\Http\Controllers;

use App\Test;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::paginate(10);
        return View('testsmanagement.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('testsmanagement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|max:255|unique:tests',
        ], [
            'name.unique'         => 'Test is already saved',
            'name.required'       => 'Name is required',
        ] );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $test = Test::create([
            'name'             => $request->input('name'),
        ]);
        $test->save();
        return redirect('tests/create')->with('success', 'Diagnostic Test created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        // return view('testsmanagement.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {

     return view('testsmanagement.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|max:255|unique:tests',
        ], [
            'name.unique'         => 'Test is already saved',
            'name.required'       => 'Name is required',
        ] );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $test->name = $request->input('name');
        $test->save();
        return back()->with('success', 'Diagnostic Test updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $test->diagnostic_centres()->detach();
        $test->delete();
        return redirect('/tests')->with('success', 'Test is successfully deleted');
    }
}
