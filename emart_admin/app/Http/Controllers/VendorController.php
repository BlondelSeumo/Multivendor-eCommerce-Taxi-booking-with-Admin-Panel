<?php
/**
 * File name: VendorController.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

class VendorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	  public function index()
    {

        return view("vendors.index");
    }


  public function edit($id)
    {
    	    return view('vendors.edit')->with('id',$id);
    }

    public function view($id)
    {
        return view('vendors.view')->with('id',$id);
    }

    public function payout($id)
    {
        return view('vendors.payout')->with('id',$id);
    }

    public function items($id)
    {
        return view('vendors.items')->with('id',$id);
    }

    public function orders($id)
    {
        return view('vendors.orders')->with('id',$id);
    }

    public function reviews($id)
    {
        return view('vendors.reviews')->with('id',$id);
    }

    public function promos($id)
    {
        return view('vendors.promos')->with('id',$id);
    }

    public function create(){
        return view('vendors.create');
    }


}
