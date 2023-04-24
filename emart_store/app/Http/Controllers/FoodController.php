<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\VendorUsers;

class FoodController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
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

   		return view("items.index")->with('id',$id);
    }

    public function edit($id)
    {
    	return view('items.edit')->with('id',$id);
    }

    public function create()
    {
      $user = Auth::user();
      $id = Auth::id();
      $exist = VendorUsers::where('user_id',$id)->first();
      $id=$exist->uuid;

      return view('items.create')->with('id',$id);
    }
}
