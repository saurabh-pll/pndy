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
        $patientcount = Patient::count();
        $labs = DiagnosticCentre::count();
        $chemists = Chemist::count();

        if ($user->isAdmin()) {
            return view('pages.admin.home');
        }

        return view('pages.user.home', compact('testcount', 'patientcount', 'labs', 'chemists'));
    }
}
