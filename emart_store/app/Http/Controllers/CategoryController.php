<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
	  public function index()
    {
        return view("categories.index");
    }

     public function edit($id)
    {
    	return view('categories.edit')->with('id', $id);
    }

}


