<?php

namespace App\Http\Controllers;

class SectionController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	  public function index()
    {
        return view("section.index");
    }

     public function edit($id)
    {
    	return view('section.edit')->with('id', $id);
    }

    public function create()
    {
        return view('section.create');
    }

}


