<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorUsers;
use App\Models\User;
use Razorpay\Api\Api;
use Session;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

   /**
     * Write code on Method
     *
     * @return response()
     */
    public function stripePaymentcallback(Request $request)
    {
        
        return response()->json(array('success'=>true,'data'=>$request->all()));  
    }

    public function takeawayOption(Request $request){

       $takeawayOption = $request->input('takeawayOption');
        if($takeawayOption){
            /*$request->session()->put('takeawayOption', $takeawayOption);*/
            Session::put('takeawayOption', $takeawayOption);
            Session::save();

            if($takeawayOption=="true"){
                $cart = Session::get('cart', []);
                $cart['delivery_option']="takeaway";
                $cart['deliverycharge']=0;
                $cart['tip_amount']=0;
                Session::put('cart', $cart);
                Session::save();
            }else{
                $cart = Session::get('cart', []);
                $cart=array();
                $cart['delivery_option']="delivery";   
                if(@$cart['deliverychargemain']){
                    $cart['deliverycharge']=$cart['deliverychargemain'];
                }
                Session::put('cart', $cart);
                Session::save();
            }
            $res=array('status'=>true,'data'=>$takeawayOption,'message'=>'success');
            echo json_encode($res);exit;
            /*return $takeawayOption;*/
        }
       
    }

}
