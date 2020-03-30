<?php

namespace App\Http\Controllers;

use App\DiagnosticCentre;
use App\Hospital;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Patient;
use App\Test;

class RequestController extends Controller
{
    
    public function create(Patient $patient)
    {
        $hospitals = Hospital::all();
        $tests = Test::all();
        return View('requests.create', compact('patient', 'tests', 'hospitals'));
    }

    public function store(Request $request)
    {
        //
    }

    public function searchLab(Request $request)
    {
        $testID = $request->input('test_id');
        $labs = DiagnosticCentre::whereHas('tests', $testID)->with('tests')->get();
        return response()->json([json_encode($labs),], Response::HTTP_OK);
    }
}
