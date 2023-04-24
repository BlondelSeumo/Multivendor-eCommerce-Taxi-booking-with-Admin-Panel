<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorUsers;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
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
        return view("specialOffer.index")->with('id',$id);
    }

}
