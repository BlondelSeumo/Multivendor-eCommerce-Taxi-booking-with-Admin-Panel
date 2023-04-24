<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	  public function index()
    {
        return view("categories.index");
    }

     public function edit($id)
    {
    	return view('categories.edit')->with('id', $id);
    }

    public function create()
    {
        return view('categories.create');
    }

}


