<?php

namespace App\Http\Controllers;


class DriversPayoutController extends Controller
{

   public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id = '')
    {
      
       return view("drivers_payouts.index")->with('id', $id);
       
    }

    public function create()
    {
        
       return view("drivers_payouts.create");
    }

}
