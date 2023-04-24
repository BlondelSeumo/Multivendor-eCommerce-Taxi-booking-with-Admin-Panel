<?php

namespace App\Http\Controllers;

class CouponController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
      public function index($id='')
    {
        return view("coupons.index")->with('id',$id);;
    }

    public function edit($id)
    {
        return view('coupons.edit')->with('id', $id);
    }

    public function create($id='')
    {
        return view('coupons.create')->with('id',$id);
    }

}


