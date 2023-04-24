<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**       
 * Display a listing of the resource.
 *
 * @param  Illuminate\Http\Request $request
 * @return Response
 */

class ContactUsController extends Controller
{
    public function __construct()
    {
    	if(!isset($_COOKIE['section_id']) && !isset($_COOKIE['address_name'])) {
    		\Redirect::to('set-location')->send();
		}
    }
	
    public function index()
    {
        return view('contact_us.contact_us');
    }
}
