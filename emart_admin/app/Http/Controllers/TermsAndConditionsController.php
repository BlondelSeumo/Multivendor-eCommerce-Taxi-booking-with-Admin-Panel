<?php

namespace App\Http\Controllers;

class TermsAndConditionsController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
       return view("terms_conditions.index");
    }

    public function privacyindex()
    {
       return view("privacy_policy.index");
    }
}
