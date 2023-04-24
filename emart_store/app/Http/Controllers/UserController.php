<?php
/**
 * File name: RestaurantController.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\VendorUsers;


class UserController extends Controller
{

public function __construct()
    {
        $this->middleware('auth');
    }
	  public function index()
    {

        return view("settings.users.index");
    }


  public function edit($id)
    {
    	    return view('settings.users.edit')->with('id',$id);
    }

  public function profile()
  {
      	$user = Auth::user();
        $id = Auth::id();
        $exist = VendorUsers::where('user_id',$id)->first();
        $id=$exist->uuid;
      return view('users.profile')->with('id',$id);
  }


}
