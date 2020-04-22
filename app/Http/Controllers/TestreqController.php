<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Testreq;
use App\Request as AReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Auth;
use App\Test;

class TestreqController extends Controller
{
    public function searchByUniqueID(Request $request)
    {
        $uniqueID = $request->input('unique_id');
        $user = Auth::user();
        $lab_id = $user->affiliation->id;
        $result = Testreq::where('unique_id', 'like', $uniqueID)->first();
        if ($result) {
            if ($result->diagnostic_centre_id === $lab_id) {
                $reqResult = AReq::find($result->request_id)->with('hospital')->first();
                $test = Test::find($result->test_id)->first();
                $patient = Patient::find($result->patient_id);
                $result->price = DB::table('diagnostic_centre_test')->where('diagnostic_centre_id', $lab_id)->where('test_id', $test->id)->value('price');
                $result->test_name = $test->name;
                
                $data =[
                    'test' => $result,
                    'patient' => $patient,
                    'request' => $reqResult ,
                ];
                return view('labsmanagement.show-request')->with($data);
            } else {
                return back()->with('error', 'Request is not assigned to you!');
            }
            
        } else {
           
            return back()->with('error', 'Unique ID not found!');
        }
    }
}
