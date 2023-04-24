<?php

namespace App\Http\Controllers;

class ParcelController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	  public function index()
    {
        return view("parcel.parcelCategory");
    }

    public function create()
    {
        return view("parcel.create");
    }

    public function edit($id)
    {
    	return view('parcel.edit')->with('id', $id);
    }
    public function view($id)
    {
    	return view('parcel.view')->with('id', $id);
    }

    public function parcelWeight()
    {
        return view("parcel_weight.index");
    }

    public function parcelCoupons()
    {
        return view("parcel_coupons.index");
    }

    public function parcelCouponsCreate()
    {
        return view("parcel_coupons.create");
    }

    public function parcelCouponsEdit($id)
    {
    	return view('parcel_coupons.edit')->with('id', $id);
    }

    public function parcelOrders()
    {
        return view("parcel_orders.index");
    }

    public function parcelOrderEdit($id)
    {
    	return view('parcel_orders.edit')->with('id', $id);
    }

}


