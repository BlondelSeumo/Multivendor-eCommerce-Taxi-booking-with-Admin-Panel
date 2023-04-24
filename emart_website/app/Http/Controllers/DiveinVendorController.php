<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorUsers;
use Illuminate\Support\Facades\Auth;
use Session;

class DiveinVendorController extends Controller
{
    public function __construct()
    {
    	if(!isset($_COOKIE['section_id']) && !isset($_COOKIE['address_name'])) {
    		\Redirect::to('set-location')->send();
		}
    }
	
    public function index()
    {
        return view ('dinein.index');
    }

    public function dyiningvendor(){
    
        return view('dinein.dyiningvendor');
    }
}
