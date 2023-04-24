<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
	public function __construct()
    {
    	if(!isset($_COOKIE['section_id']) && !isset($_COOKIE['address_name'])) {
    		\Redirect::to('set-location')->send();
		}
    }
	
    function index()
    {
    	 return view('send_email');
    }

    function send(Request $request)
    {
	     $this->validate($request, [
	      'name'     =>  'required',
	      'email'  =>  'required|email',
	      'message' =>  'required'
	     ]);
	
	     $data = array(
	           'name'      =>  $request->name,
	           'message'   =>   $request->message
	       );
	
	    Mail::to(env('MAIL_TO_ADDRESS'))->send(new SendMail($data));
		 
	    return back()->with('success_contact', 'Thanks for contacting us!'); 
    }
}

?>