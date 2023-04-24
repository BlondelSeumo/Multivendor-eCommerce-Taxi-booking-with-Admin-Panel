<?php

namespace App\Http\Controllers;

class ReviewAttributeController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	  public function index()
    {
        return view("reviewattributes.index");
    }

     public function edit($id)
    {
    	return view('reviewattributes.edit')->with('id', $id);
    }

    public function create()
    {
        return view('reviewattributes.create');
    }

}


