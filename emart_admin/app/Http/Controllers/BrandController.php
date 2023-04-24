<?php

namespace App\Http\Controllers;


class brandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function brand()
    {
        return view('brands.index');
    }
    public function brandEdit($id)
    {
        return view('brands.edit')->with('id',$id);
    }

    public function brandCreate()
    {
        return view('brands.create');
    }

}