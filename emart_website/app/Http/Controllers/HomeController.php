<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$route = \Route::currentRouteName();
		
    	if(!isset($_COOKIE['section_id']) && !isset($_COOKIE['address_name']) && $route != "set-location"){
    		\Redirect::to('set-location')->send();
		}
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (isset($_COOKIE['service_type']) && $_COOKIE['service_type'] == 'Parcel Delivery Service') {
	        return view('parcel.homeParcel');
	    } else if (isset($_COOKIE['service_type']) && $_COOKIE['service_type'] == 'Rental Service') {
	        return view('rental.index');
	    } else if (isset($_COOKIE['service_type']) && $_COOKIE['service_type'] == 'Ecommerce Service') {
	        return view('ecommerce.index');
	    } else if (isset($_COOKIE['service_type']) && $_COOKIE['service_type'] == 'Multivendor Delivery Service') {
	        return view('multivendor.index');
	    } else if (isset($_COOKIE['service_type']) && $_COOKIE['service_type'] == 'Cab Service') {
	        return view('cab_service.index');
	    }
    }
	
	public function setLocation()
    {
    	return view('layer');
    }
}