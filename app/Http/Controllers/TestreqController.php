<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Testreq;
use App\Request as AReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use Validator;
use App\Test;

class TestreqController extends Controller
{
    
    public function getTestreq($testreqID){
        $result = $this->searchByID($testreqID);
        if ($result){
            $lab_id = auth()->user()->affiliation->id;
            if ($result->diagnostic_centre_id === $lab_id){
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
            } 
            return back()->with('error', 'Request is not assigned to you!');
        }
        return back()->with('error', 'Request ID not found!'); 

    }
    
    // public function searchByUniqueID(Request $request)
    // {
    //     $result= $this->searchByID($request->input('unique_id'));
    //     if ($result) {
    //         $user = auth()->user();
    //         $lab_id = $user->affiliation->id;
    //         if ($result->diagnostic_centre_id === $lab_id) {
    //             $this->redirectTOShowRequest($result);
    //             // $reqResult = AReq::find($result->request_id)->with('hospital')->first();
    //             // $test = Test::find($result->test_id)->first();
    //             // $patient = Patient::find($result->patient_id);
    //             // $result->price = DB::table('diagnostic_centre_test')->where('diagnostic_centre_id', $lab_id)->where('test_id', $test->id)->value('price');
    //             // $result->test_name = $test->name;
                
    //             // $data =[
    //             //     'test' => $result,
    //             //     'patient' => $patient,
    //             //     'request' => $reqResult ,
    //             // ];
    //             // return view('labsmanagement.show-request')->with($data);
    //         } else {
    //             return back()->with('error', 'Request is not assigned to you!');
    //         }
            
    //     } else {
           
    //         return back()->with('error', 'Unique ID not found!');
    //     }
    // }

    public function genOTP($testreqID){
        $test = $this->searchByID($testreqID);
        if($test){
            $test->status = 1;
            $test->otp = $this->generateNumericOTP(4);
            $test->save();
            return back()->with('success', 'Processing started');
        } else {
            return back()->with('error', 'Unique ID not found!');
        }
    }


    public function complete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp'                  => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $test = $this->searchByID($request->input('unique_id'));
        if($test->status === 1){
            if ($test->otp === $request->input('otp')){
                $test->status = 2;
                $test->completed_at = now();
                $test->save();
                return back()->with('success', 'Diagnostic Test completed successfully!');
            } else {
                return back()->with('error', "Wrong OTP!");
            }
        }elseif($test->status === 2){
            return back()->with('error', 'Test already marked as Completed');
        }
    }

    protected function searchByID($testreqID)
    {
        $result = Testreq::where('unique_id', 'like', $testreqID)->first();
        if ($result){
            return $result;
        }
        return false;
    }

    protected function redirectTOShowRequest(Testreq $result, $msgType = null, $msg = null){
        
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
        return view('labsmanagement.show-request')->with($data)->with($msgType, $msg);
    }
}
