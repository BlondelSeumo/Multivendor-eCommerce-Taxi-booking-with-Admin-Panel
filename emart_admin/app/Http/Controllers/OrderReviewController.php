<?php

namespace App\Http\Controllers;


class OrderReviewController extends Controller
{  

   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id='')
    {

       return view("order_reviews.index")->with('id',$id);
    }

    public function create()
    {
        
       return view("order_reviews.create");
    }

    public function edit($id)
    {
        
       return view("order_reviews.edit")->with('id',$id);
    }


}
