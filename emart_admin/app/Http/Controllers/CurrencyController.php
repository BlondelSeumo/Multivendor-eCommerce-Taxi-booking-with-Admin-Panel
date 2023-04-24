<?php


namespace App\Http\Controllers;

class CurrencyController extends Controller
{ 


    public function __construct()
    {
        $this->middleware('auth');
    }
    
	    public function index()
    {
       return view("settings.currencies.index");
    }


  public function edit($id)
    {
    	return view('settings.currencies.edit')->with('id',$id);
    }

    public function create(){
       return view('settings.currencies.create');

    }

}