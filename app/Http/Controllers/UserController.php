<?php

namespace App\Http\Controllers;
use App\Test;
use App\Patient;
use App\DiagnosticCentre;
use App\Chemist;
use App\Testreq;
use Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $currentMonth = date('m');

        $testcount = Test::count();
        if(!$testcount) $testcount = 0;
        $patientcount = Patient::count();
        if(!$patientcount) $patientcount = 0;
        $labs = DiagnosticCentre::count();
        if (!$labs) $labs = 0;
        $chemists = Chemist::count();
        if (!$chemists) $chemists = 0;
        if ($user->isAdmin()) {
            return view('pages.admin.home', compact('testcount', 'patientcount', 'labs', 'chemists'));
        }
        if ($user->hasRole('user')) {
            return view('pages.user.home', compact('testcount', 'patientcount', 'labs', 'chemists'));
        }
        if ($user->hasRole('lab')){
            $lab_id = $user->affiliation->id;
            $testreqs = Testreq::where('diagnostic_centre_id', $lab_id)->whereNull('completed_at')->get();
            $completedtests_monthly = DB::table('testreqs')
                    ->where('diagnostic_centre_id', $lab_id)
                    ->whereRaw('MONTH(completed_at) = ?', [$currentMonth])
                    ->get();
            $pending_payment = DB::table('testreqs')
                    ->where('diagnostic_centre_id', $lab_id)
                    ->whereNotNull('completed_at')
                    ->whereNull('paid_at')
                    ->get();
            return view('pages.lab.home', compact('testreqs', 'completedtests_monthly', 'pending_payment'));
        }
        return view('pages.user.home', compact('testcount', 'patientcount', 'labs', 'chemists'));
    }
}
