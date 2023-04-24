<?php
/**
 * File name: RestaurantController.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

class RestaurantController extends Controller
{

	  public function index()
    {

        return view("restaurants.index");
    }


  public function edit($id)
    {
    	    return view('restaurants.edit')->with('id',$id);
    }


}
