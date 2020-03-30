<?php

namespace App\Http\Controllers;

use App\DiagnosticCentre;
use App\Hospital;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Patient;
use App\Test;
use App\Request as PReq;
use App\Testreq;

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
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'hospital_id' => 'required',
            'ailment' => 'required',
            'doctor' => 'nullable|max:255',
            'case_story' => 'nullable',
            'test_id' => 'required',
            'diagnostic_centre_id' => 'required',
            'allotted_date' => 'nullable|date',
            'allotted_time' => 'nullable|date_format:H:i',
            'prescription' => 'required|mimes:pdf,jpeg,png,jpg,bmp|max:2048'
        ]);

        $file = $request->file('prescription');
        $fileName = time() . time().'.'.$file->getClientOriginalExtension(); 
   
        $file->move(public_path('/uploads/'), $fileName);
        $reqData = PReq::create([
            'patient_id' => $request->get('patient_id'),
            'hospital_id' => $request->get('hospital_id'),
            'ailment' => $request->get('ailment'),
            'doctor' => $request->get('doctor'),
            'case_story' => $request->get('case_story'),
            'prescription' => $fileName,
        ]);
        
        $testReq = Testreq::create([
            'request_id' => $reqData->id,
            'patient_id' => $request->get('patient_id'),
            'test_id' => $request->get('test_id'),
            'diagnostic_centre_id' => $request->get('diagnostic_centre_id'),
            'allotted_date' => $request->get('allotted_date'),
            'allotted_time' => $request->get('allotted_time'),
            'unique_id' => $this->generateNumericOTP(6),
            'otp' => $this->generateNumericOTP(4),
        ]);

        return redirect('/patients')->with('success', 'Request for Test is successfully saved. <br> Unique ID: ' . $testReq->unique_id . ' <br> OTP is ' . $testReq->otp);
    }

    public function searchLab(Request $request)
    {
        $testID = $request->input('test_id');
        $labs = DiagnosticCentre::whereHas('tests', function ($q) use ($testID){
            $q->where('id', $testID);
        })->get();
        return response()->json([json_encode($labs),], Response::HTTP_OK);
    }
}
