<?php

namespace App\Http\Controllers;

class DriverController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	  public function index()
    {
        return view("drivers.index");
    }

    public function edit($id)
    {
    	return view('drivers.edit')->with('id', $id);
    }
     public function create()
    {
        return view('drivers.create');
    }

    public function view($id)
    {
    	return view('drivers.view')->with('id', $id);
    }

}


