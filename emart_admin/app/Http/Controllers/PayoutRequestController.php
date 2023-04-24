<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayoutRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id="")
    {
        return view("payoutRequests.drivers.index")->with("id",$id);
    }

    public function vendor($id="")
    {
        return view("payoutRequests.vendor.index")->with("id",$id);
    }

}
