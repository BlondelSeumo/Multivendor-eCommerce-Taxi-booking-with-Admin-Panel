<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorUsers;
use Illuminate\Support\Facades\Auth;
use Session;

class AllVendorsController extends Controller
{
    public function __construct()
    {
    	if(!isset($_COOKIE['section_id']) && !isset($_COOKIE['address_name'])) {
    		\Redirect::to('set-location')->send();
		}
    }
	
    public function index()
    {
        return view('allvendors.index');
    }
    
    public function dineinVendors(){
        return view ('dinein.index');
    }
	
	public function VendorsbyCategory($id)
    {
        return view('allvendors.bycategory',['id' => $id]);
    }
}
