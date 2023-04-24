<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorUsers;

class CouponController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
      public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        $exist = VendorUsers::where('user_id',$id)->first();
        $id=$exist->uuid;
        return view("coupons.index")->with('id',$id);;
    }

    public function edit($id)
    {
        return view('coupons.edit')->with('id', $id);
    }

    public function create()
    {
        $user = Auth::user();
        $id = Auth::id();
        $exist = VendorUsers::where('user_id',$id)->first();
        $id=$exist->uuid;
        return view('coupons.create')->with('id',$id);
    }

}


