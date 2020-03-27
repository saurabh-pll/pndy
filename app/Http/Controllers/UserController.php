<?php

namespace App\Http\Controllers;
use App\Test;
use App\Patient;
use App\DiagnosticCentre;
use App\Chemist;
use Auth;

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

        $testcount = Test::count();
        if(!$testcount) $testcount = 0;
        $patientcount = Patient::count();
        if(!$patientcount) $patientcount = 0;
        $labs = DiagnosticCentre::count();
        if (!$labs) $labs = 0;
        $chemists = Chemist::count();
        if (!$chemists) $chemists = 0;
        if ($user->isAdmin()) {
            return view('pages.admin.home');
        }

        return view('pages.user.home', compact('testcount', 'patientcount', 'labs', 'chemists'));
    }
}
