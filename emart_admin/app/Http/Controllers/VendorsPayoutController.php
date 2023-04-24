<?php

namespace App\Http\Controllers;


class VendorsPayoutController extends Controller
{  

   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id='')
    {

       return view("vendors_payouts.index")->with('id',$id);
    }

    public function create($id='')
    {
        
       return view("vendors_payouts.create")->with('id',$id);
    }

}
