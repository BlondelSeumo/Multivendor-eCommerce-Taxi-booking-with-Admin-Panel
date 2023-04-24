<?php

namespace App\Http\Controllers;

class RentalController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rentalOrders()
    {
        return view("rental_orders.index");
    }

    public function rentalOrderEdit($id)
    {
    	return view('rental_orders.edit')->with('id', $id);
    }

}


