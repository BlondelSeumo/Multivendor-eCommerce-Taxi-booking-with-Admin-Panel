<?php

namespace App\Http\Controllers;


class VendorFiltersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('vendor_filters.index');
    }


    public function edit($id)
    {
        
        return view('vendor_filters.edit')->with('id',$id);
    }

    public function create()
    {
        return view('vendor_filters.create');
    }    
}
