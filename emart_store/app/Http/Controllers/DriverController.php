<?php

namespace App\Http\Controllers;

class DriverController extends Controller
{
	  public function index()
    {
        return view("drivers.index");
    }

     public function edit($id)
    {
    	return view('drivers.edit')->with('id', $id);
    }

}


