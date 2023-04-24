<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorUsers;
use App\Models\User;
use Razorpay\Api\Api;

use Session;
class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	if(!isset($_COOKIE['section_id']) && !isset($_COOKIE['address_name'])) {
    		\Redirect::to('set-location')->send();
		}
		
        $this->middleware('auth');
        error_reporting(0); 
    }

   /**
     * Write code on Method
     *
     * @return response()
     */
    public function checkout()
    {
        $email = Auth::user()->email;
        
        $user = VendorUsers::where('email',$email)->first();
        
        $cart = Session::get('cart', []);

        if(Session::get('takeawayOption')=="true"){
             
        }else{
        	
	        $deliveryChargemain=@$_COOKIE['deliveryChargemain'];
	        $address_lat=@$_COOKIE['address_lat'];
	        $address_lng=@$_COOKIE['address_lng'];
	        $vendor_latitude=@$_COOKIE['vendor_latitude'];
	        $vendor_longitude=@$_COOKIE['vendor_longitude'];
			
			if(isset($_COOKIE['service_type']) == "Ecommerce Service" && isset($_COOKIE['ecommerce_delivery_charge'])){
				$cart['deliverychargemain'] = $_COOKIE['ecommerce_delivery_charge'];
			}else{
				if(@$deliveryChargemain && @$address_lat && @$address_lng && @$vendor_latitude && @$vendor_longitude){
		            $deliveryChargemain=json_decode($deliveryChargemain);
		            if(!empty($deliveryChargemain)){
		                $delivery_charges_per_km=$deliveryChargemain->delivery_charges_per_km;
		                $minimum_delivery_charges=$deliveryChargemain->minimum_delivery_charges;
		                $minimum_delivery_charges_within_km=$deliveryChargemain->minimum_delivery_charges_within_km;
		                $kmradius=$this->distance($address_lat, $address_lng, $vendor_latitude, $vendor_longitude, 'K');
		                if($minimum_delivery_charges_within_km >$kmradius){
		                    $cart['deliverychargemain']=$minimum_delivery_charges;
		                }else{
		                    $cart['deliverychargemain']=round(($kmradius*$delivery_charges_per_km), 2);
		                }
		                $cart['deliverykm']=$kmradius;
		                
		            }
		        }	
			}
	        
	        $cart['deliverycharge']=@$cart['deliverychargemain'];
	        
	        Session::put('cart', $cart);
	        Session::save();
        }

        return view('checkout.checkout',['is_checkout'=>1,'cart'=>$cart,'id'=>$user->uuid]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function proccesstopay()
    {

        $email = Auth::user()->email;
        $user = VendorUsers::where('email',$email)->first();
        $cart = Session::get('cart', []);

        
        if(@$cart['cart_order']){
            if($cart['cart_order']['payment_method']=='razorpay'){
                $razorpaySecret=$cart['cart_order']['razorpaySecret'];
                $razorpayKey=$cart['cart_order']['razorpayKey'];
                $authorName=$cart['cart_order']['authorName'];
                $total_pay=$cart['cart_order']['total_pay'];
                $amount=0;
                return view('checkout.razorpay',['is_checkout'=>1,'cart'=>$cart,'id'=>$user->uuid,'email'=>$email,'authorName'=>$authorName,'amount'=>$total_pay,'razorpaySecret'=>$razorpaySecret,'razorpayKey'=>$razorpayKey,'cart_order'=>$cart['cart_order']]);
            }else if($cart['cart_order']['payment_method']=='payfast'){
                $payfast_merchant_key=$cart['cart_order']['payfast_merchant_key'];
                $payfast_merchant_id=$cart['cart_order']['payfast_merchant_id'];
                $payfast_isSandbox=$cart['cart_order']['payfast_isSandbox'];
                /*$payfast_return_url=$cart['cart_order']['payfast_return_url'];
                $payfast_notify_url=$cart['cart_order']['payfast_notify_url'];
                $payfast_cancel_url=$cart['cart_order']['payfast_cancel_url'];*/

                $payfast_return_url=route('success');
                $payfast_notify_url=route('notify');
                $payfast_cancel_url=route('pay');
                

                $authorName=$cart['cart_order']['authorName'];
                $total_pay=$cart['cart_order']['total_pay'];
                $amount=0;
                $token = uniqid();
                Session::put('payfast_payment_token', $token);
                Session::save();
                $payfast_return_url=$payfast_return_url.'?token='.$token;

                return view('checkout.payfast',['is_checkout'=>1,'cart'=>$cart,'id'=>$user->uuid,'email'=>$email,'authorName'=>$authorName,'amount'=>$total_pay,'payfast_merchant_key'=>$payfast_merchant_key,'payfast_merchant_id'=>$payfast_merchant_id,'payfast_isSandbox'=>$payfast_isSandbox,'payfast_return_url'=>$payfast_return_url,'payfast_notify_url'=>$payfast_notify_url,'payfast_cancel_url'=>$payfast_cancel_url,'cart_order'=>$cart['cart_order']]);
            }else if($cart['cart_order']['payment_method']=='paystack'){

                $paystack_public_key=$cart['cart_order']['paystack_public_key'];
                $paystack_secret_key=$cart['cart_order']['paystack_secret_key'];
                $paystack_isSandbox=$cart['cart_order']['paystack_isSandbox'];

                $authorName=$cart['cart_order']['authorName'];
                $total_pay=$cart['cart_order']['total_pay'];
                $amount=0;
                
                require_once(base_path().'/paystack-php-master/vendor/autoload.php');
                define("PaystackPublicKey",$paystack_public_key);
                define("PaystackSecretKey",$paystack_secret_key);
                \Paystack\Paystack::init($paystack_secret_key);
                $payment = \Paystack\Transaction::initialize([
                        'email' => $email,
                        'amount' =>(int)($total_pay*100),
                ]);
                Session::put('paystack_authorization_url', $payment->authorization_url);
                Session::put('paystack_access_code', $payment->access_code);
                Session::put('paystack_reference', $payment->reference);
                Session::save();
                if($payment->authorization_url){
                    $script = "<script>window.location = '".$payment->authorization_url."';</script>";
                    echo $script;
                    exit;
                }else{
                    $script = "<script>window.location = '".url('')."';</script>";
                    echo $script;
                    exit;
                }


            }else if($cart['cart_order']['payment_method']=='flutterwave'){

                $currency="USD";
                if(@$cart['cart_order']['currencyData']['code']){
                    $currency=$cart['cart_order']['currencyData']['code'];
                }
                $flutterWave_secret_key=$cart['cart_order']['flutterWave_secret_key'];
                $flutterWave_public_key=$cart['cart_order']['flutterWave_public_key'];
                $flutterWave_isSandbox=$cart['cart_order']['flutterWave_isSandbox'];
                $flutterWave_encryption_key=$cart['cart_order']['flutterWave_encryption_key'];

                $authorName=$cart['cart_order']['authorName'];
                $total_pay=$cart['cart_order']['total_pay'];
                
                Session::put('flutterwave_pay',1);
                Session::save();

                $token = uniqid();
                Session::put('flutterwave_pay_tx_ref', $token);
                Session::save();

                return view('checkout.flutterwave',['is_checkout'=>1,'cart'=>$cart,'id'=>$user->uuid,'email'=>$email,'authorName'=>$authorName,'amount'=>$total_pay,'flutterWave_secret_key'=>$flutterWave_secret_key,'flutterWave_public_key'=>$flutterWave_public_key,'flutterWave_isSandbox'=>$flutterWave_isSandbox,'flutterWave_encryption_key'=>$flutterWave_encryption_key,'token'=>$token,'cart_order'=>$cart['cart_order'],'currency'=>$currency]);


            }else if($cart['cart_order']['payment_method']=='stripe'){


                $stripeKey = $cart['cart_order']['stripeKey'];
                $stripeSecret = $cart['cart_order']['stripeSecret'];
                $authorName = $cart['cart_order']['authorName'];
                $total_pay = $cart['cart_order']['total_pay'];
                $address_line1 = $cart['cart_order']['address_line1'];
                $address_line2 = $cart['cart_order']['address_line2'];
                $address_zipcode = $cart['cart_order']['address_zipcode'];
                $address_city = $cart['cart_order']['address_city'];
                $address_country = $cart['cart_order']['address_country'];


                $stripeSecret = $cart['cart_order']['stripeSecret'];
                $stripeKey = $cart['cart_order']['stripeKey'];
                $isStripeSandboxEnabled = $cart['cart_order']['isStripeSandboxEnabled'];
                $authorName = $cart['cart_order']['authorName'];
                $total_pay = $cart['cart_order']['total_pay'];
                $amount = 0;
                return view('checkout.stripe', ['is_checkout' => 1, 'cart' => $cart, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'stripeSecret' => $stripeSecret, 'stripeKey' => $stripeKey, 'cart_order' => $cart['cart_order']]);

            }else if($cart['cart_order']['payment_method']=='paypal'){


                $paypalKey=$cart['cart_order']['paypalKey'];
                $paypalSecret=$cart['cart_order']['paypalSecret'];
                $authorName=$cart['cart_order']['authorName'];
                $total_pay=$cart['cart_order']['total_pay'];
                $address_line1=$cart['cart_order']['address_line1'];
                $address_line2=$cart['cart_order']['address_line2'];
                $address_zipcode=$cart['cart_order']['address_zipcode'];
                $address_city=$cart['cart_order']['address_city'];
                $address_country=$cart['cart_order']['address_country'];

                $paypalSecret=$cart['cart_order']['paypalSecret'];
                $paypalKey=$cart['cart_order']['paypalKey'];
                //echo "<pre>";print_r($cart['cart_order']);exit;
                $ispaypalSandboxEnabled=$cart['cart_order']['ispaypalSandboxEnabled'];
                $authorName=$cart['cart_order']['authorName'];
                $total_pay=$cart['cart_order']['total_pay'];
                $amount=0;
                return view('checkout.paypal',['is_checkout'=>1,'cart'=>$cart,'id'=>$user->uuid,'email'=>$email,'authorName'=>$authorName,'amount'=>$total_pay,'paypalSecret'=>$paypalSecret,'paypalKey'=>$paypalKey,'cart_order'=>$cart['cart_order']]);
            }
            else if ($cart['cart_order']['payment_method'] == 'mercadopago') {

//                $currency = "USD";
//                if (@$cart['cart_order']['currencyData']['code']) {
//                    $currency = $cart['cart_order']['currencyData']['code'];
//                }
//                $mercadopago_public_key = $cart['cart_order']['mercadopago_public_key'];
//                $mercadopago_access_token = $cart['cart_order']['mercadopago_access_token'];
//                $mercadopago_isSandbox = $cart['cart_order']['mercadopago_isSandbox'];
//                $mercadopago_isEnabled = $cart['cart_order']['mercadopago_isEnabled'];
//                $quantity = $cart['cart_order']['quantity'];
//                $id = $cart['cart_order']['id'];
//                $total_pay = $cart['cart_order']['total_pay'];
//
//                $items['title'] = $id;
//                $items['quantity'] = 1;
//                $items['unit_price'] = floatval($total_pay);
//
//                $fields[] = $items;
//                $item['items'] = $fields;
//                $item['back_urls']['failure'] = route('pay');
//                $item['back_urls']['pending'] = route('notify');
//                $item['back_urls']['success'] = route('success');
//                $item['auto_return'] = 'all';
//                Session::put('mercadopago_pay', 1);
//                Session::save();
//                $url = "https://api.mercadopago.com/checkout/preferences";
//                $data = array('Accept: application/json', 'Authorization:Bearer ' . $mercadopago_access_token);
//                /*$ch = curl_init();
//                curl_setopt($ch, CURLOPT_URL,$urladdress);
//                curl_setopt($ch, CURLOPT_POST, true);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($item));
//                curl_setopt($ch, CURLOPT_HEADER, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER ,  $data);
//                $mercadopago = curl_exec ($ch);
//                curl_close($ch);*/
//                $post_data = json_encode($item);
//                $ch = curl_init($url);
//                curl_setopt($ch, CURLOPT_POST, 1);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization:Bearer " . $mercadopago_access_token));
//                $response = curl_exec($ch);
//                $mercadopago = json_decode($response);
//
//                Session::put('mercadopago_preference_id', $mercadopago->id);
//                Session::save();
//                if ($mercadopago === null) {
//                    die(curl_error($ch));
//                }
//                $authorName = $cart['cart_order']['authorName'];
//                $total_pay = $cart['cart_order']['total_pay'];
//                if ($mercadopago_isSandbox == "true") {
//                    $payment_url = $mercadopago->sandbox_init_point;
//                } else {
//                    $payment_url = $mercadopago->init_point;
//                }
//                echo "<script>location.href = '" . $payment_url . "';</script>";
//                exit;
//                //return view('checkout.mercadopago',['is_checkout'=>1,'cart'=>$cart,'id'=>$user->uuid,'email'=>$email,'authorName'=>$authorName,'amount'=>$total_pay,'payment_url'=>$payment_url,'cart_order'=>$cart['cart_order']]);


                $currency = "USD";
                if (@$cart['cart_order']['currencyData']['code']) {
                    $currency = $cart['cart_order']['currencyData']['code'];
                }
                $mercadopago_public_key = $cart['cart_order']['mercadopago_public_key'];
                $mercadopago_access_token = $cart['cart_order']['mercadopago_access_token'];
                $mercadopago_isSandbox = $cart['cart_order']['mercadopago_isSandbox'];
                $mercadopago_isEnabled = $cart['cart_order']['mercadopago_isEnabled'];

                $id = $cart['cart_order']['id'];
                $total_pay = $cart['cart_order']['total_pay'];

                $items['title'] = $id;
                $items['quantity'] = 1;
                $items['unit_price'] = floatval($total_pay);

                $fields[] = $items;
                $item['items'] = $fields;
                $item['back_urls']['failure'] = route('pay');
                $item['back_urls']['pending'] = route('notify');
                $item['back_urls']['success'] = route('success');
                $item['auto_return'] = 'all';
                Session::put('mercadopago_pay', 1);
                Session::save();
                $url = "https://api.mercadopago.com/checkout/preferences";
                $data = array('Accept: application/json', 'Authorization:Bearer ' . $mercadopago_access_token);

                $post_data = json_encode($item);
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization:Bearer " . $mercadopago_access_token));
                $response = curl_exec($ch);
                $mercadopago = json_decode($response);

                Session::put('mercadopago_preference_id', $mercadopago->id);
                Session::save();
                if ($mercadopago === null) {
                    die(curl_error($ch));
                }
                $authorName = $cart['cart_order']['authorName'];
                $total_pay = $cart['cart_order']['total_pay'];

                if ($mercadopago_isSandbox == "true") {
                    $payment_url = $mercadopago->sandbox_init_point;
                } else {
                    $payment_url = $mercadopago->init_point;
                }
                echo "<script>location.href = '" . $payment_url . "';</script>";
                exit;
            }
        }else{
            return redirect()->route('checkout');
        }
            
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function processStripePayment(Request $request)
    {
        $email = Auth::user()->email;
        $input = $request->all();
        // echo "<pre>";print_r($input);exit;
        $cart = Session::get('cart', []);
        if (@$cart['cart_order'] && $input['token_id']) {
            if ($cart['cart_order']['stripeKey'] && $cart['cart_order']['stripeSecret']) {
                $currency = "usd";
                if (@$cart['cart_order']['currency']) {
                    $currency = $cart['cart_order']['currency'];
                }
                $stripeSecret = $cart['cart_order']['stripeSecret'];
                $stripe = new \Stripe\StripeClient($stripeSecret);

                $name = $input['name'];
                //$email
                $address_line1 = $input['address_line1'];
                $address_line2 = $input['address_line2'];
                $address_city = $input['address_city'];
                $address_state = $input['address_state'];
                $address_country = $input['address_country'];
                $address_zipcode = $input['address_zipcode'];


                try {

                    /*if($customer->id){*/
                    $charge = $stripe->charges->create([
                        /*'customer'=>$customer->id,*/
                        'amount' => ($cart['cart_order']['total_pay'] * 1000),
                        'currency' => $currency,
                        'description' => 'Foodei Order',
                        'source' => $input['token_id'],
                    ]);

                    /*}*/

                    $cart['payment_status'] = true;
                    Session::put('cart', $cart);
                    Session::put('success', 'Payment successful');
                    Session::save();
                    $res = array('status' => true, 'data' => $charge, 'message' => 'success');
                    echo json_encode($res);
                    exit;

                } catch (Exception $e) {

                    $cart['payment_status'] = false;
                    Session::put('cart', $cart);
                    Session::put('error', $e->getMessage());
                    Session::save();
                    $res = array('status' => false, 'message' => $e->getMessage());
                    echo json_encode($res);
                    exit;
                }

            }
        }


    }


    public function processMercadoPagoPayment(Request $request)
    {
        $email = Auth::user()->email;
        $input = $request->all();
        $cart = Session::get('cart', []);
        print_r($input['token_id']);
        exit;

        if (@$cart['cart_order'] && $input['token_id']) {
            if ($cart['cart_order']['PublicKey'] && $cart['cart_order']['AccessToken']) {
                $currency = "usd";
                if (@$cart['cart_order']['currency']) {
                    $currency = $cart['cart_order']['currency'];
                }
                $mercadopagoAccess = $cart['cart_order']['AccessToken'];
                // $mercadopago = new \Stripe\StripeClient($mercadopagoAccess);

                $name = $input['name'];
                //$email
                // $address_line1=$input['address_line1'];
                // $address_line2=$input['address_line2'];
                // $address_city=$input['address_city'];
                // $address_state=$input['address_state'];
                // $address_country=$input['address_country'];
                // $address_zipcode=$input['address_zipcode'];
                $urladdress = "https://api.mercadopago.com/checkout/preferences";
                $data = "PublicKey=" . $request->input('PublicKey') . "&AccessToken=" . $request->input('AccessToken') . "&amount=" . $request->input('amount');
                //curl_exec($curl)
                // $ch = curl_init(); curl_setopt($ch, CURLOPT_URL,"$urladdress");
                // curl_setopt($ch, CURLOPT_POST, 1);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($ch, CURLOPT_HEADER, 0);
                // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
                // $mercadopago = curl_exec ($ch);
                // print_r($mercadopago);
                // if($mercadopago === FALSE) {
                //     die(curl_error($ch));
                // }
                // else {

                // /*if($customer->id){*/
                //     $charge = $mercadopago->charges->create([
                //       /*'customer'=>$customer->id,*/
                //       'amount' => ($cart['cart_order']['total_pay']*1000),
                //       'currency' => $currency,
                //       'description' => 'Foodei Order',
                //       'source' => $input['token_id'],
                //     ]);

                // /*}*/
                // $cart['payment_status']=true;
                // Session::put('cart', $cart);
                // Session::put('success', 'Payment successful');
                // Session::save();
                //     $res=array('status'=>true,'data'=>$data,'message'=>'success');
                //     echo json_encode($res);exit;

                // }
                // catch (Exception $e) {
                //     $cart['payment_status']=false;
                //     Session::put('cart', $cart);
                //     Session::put('error',$e->getMessage());
                //     Session::save();
                //     $res=array('status'=>false,'message'=>$e->getMessage());
                //     echo json_encode($res);exit;
                // }

            }
        }


    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function processPaypalPayment(Request $request)
    {   
        $email = Auth::user()->email;
        $input=$request->all();
        
        $cart = Session::get('cart', []);
         if(@$cart['cart_order']){
            if($cart['cart_order']){
                        
                $cart['payment_status']=true;
                Session::put('cart', $cart);
                Session::put('success', 'Payment successful');
                Session::save();
                $res=array('status'=>true,'data'=>array(),'message'=>'success');
                echo json_encode($res);exit;
                
            }
        }
        

        $cart['payment_status']=false;
        Session::put('cart', $cart);
        Session::put('error','Faild Payment');
        Session::save();
        $res=array('status'=>false,'message'=>'Faild Payment');
        echo json_encode($res);exit;

    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function razorpaypayment(Request $request)
    {
        $input = $request->all();
        $email = Auth::user()->email;
        $user = VendorUsers::where('email',$email)->first();
        $cart = Session::get('cart', []);
        $api_secret=$cart['cart_order']['razorpaySecret'];
        $api_key=$cart['cart_order']['razorpayKey'];
        $api = new Api($api_key, $api_secret);
        
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                
                $cart['payment_status']=true;
                Session::put('cart', $cart);
                Session::save();

            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
          
        Session::put('success', 'Payment successful');
        return redirect()->route('success');

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function success()
    {
        $cart = Session::get('cart', []);
        //echo "<pre>";print_r($cart['cart_order']);exit;
        $order_json=array();
        $email = Auth::user()->email;
        $user = VendorUsers::where('email',$email)->first();

        if(isset($_GET['token'])){
            $payfast_payment=Session::get('payfast_payment_token');
            if($payfast_payment==$_GET['token']){
                $cart['payment_status']=true;
                Session::put('cart', $cart);
                Session::put('success', 'Payment successful');
                Session::save();
            }
        }

        if(isset($_GET['reference'])){
            $paystack_reference=Session::get('paystack_reference');
            $paystack_access_code=Session::get('paystack_access_code');
            if($paystack_reference==$_GET['reference']){
                $cart['payment_status']=true;
                Session::put('cart', $cart);
                Session::put('success', 'Payment successful');
                Session::save();
            }
        }

        if(isset($_GET['transaction_id']) && isset($_GET['tx_ref']) && isset($_GET['status'])){
            $flutterwave_pay_tx_ref = Session::get('flutterwave_pay_tx_ref');
            if($_GET['status']=='successful' && $flutterwave_pay_tx_ref==$_GET['tx_ref']){
                $cart['payment_status']=true;
                Session::put('cart', $cart);
                Session::put('success', 'Payment successful');
                Session::save();
            }else{
                return redirect()->route('checkout');
            }
        }

        if(isset($_GET['preference_id']) && isset($_GET['payment_id']) && isset($_GET['status'])){

            $mercadopago_preference_id = Session::get('mercadopago_preference_id');
            if($_GET['status']=='approved' && $mercadopago_preference_id==$_GET['preference_id']){
                $cart['payment_status']=true;
                Session::put('cart', $cart);
                Session::put('success', 'Payment successful');
                Session::save();
            }else{
                return redirect()->route('checkout');
            }
        }

        $payment_method=(@$cart['cart_order']['payment_method'])?$cart['cart_order']['payment_method']:'cod';
        return view('checkout.success',['cart'=>$cart,'id'=>$user->uuid,'email'=>$email,'payment_method'=>$payment_method]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function orderProccessing(Request $request)
    {
        $cart_order=$request->all();
        $email = Auth::user()->email;
        $user = VendorUsers::where('email',$email)->first();
        $cart = Session::get('cart', []);

        $cart['cart_order']=$cart_order;
        Session::put('cart', $cart);
        Session::save();
        $res=array('status'=>true);
        echo json_encode($res);exit;
    }


    public function proccesspaystack(Request $request)
    {

        require_once(base_path().'/paystack-php-master/vendor/autoload.php');
        define("PaystackPublicKey",'pk_test_c93bb0dbcaeac750c5ec6b2282202bcfb5fda920');
        define("PaystackSecretKey",'sk_test_20cfa0da9619e469027805e16b2a3a0c7beb9394');

        \Paystack\Paystack::init('sk_test_20cfa0da9619e469027805e16b2a3a0c7beb9394');

         $payment = \Paystack\Transaction::initialize([
                'email' => 'jame@gosling.com',
                'amount' => '3000'
            ]);
         //$payment->authorization_url
         //$payment->access_code
         //$payment->reference

        echo "<pre>";print_r($payment);exit;
        /*//Note This form will be setup as per you requirement. in my case i needed to pay for sms units
        echo $this->Form->create(null,['url'=>['controller'=>'as-per-requirement','action'=>'purchase-sms']]);
        echo $this->Form->input('amount',['templates'=>['inputContainer'=>'<div class="form-group">{{content}}<p class="  mb-3 mt-2"> <span  id="allocatedUnits" class="text-danger pull-right small ">0 </span><span class="small pull-right text-muted mr-2 ">UNIT(S) Worth: </span><span class="small text-muted mr-2"> Send to </span><span  id="reach" class="text-danger small ">0 </span></p></div>'],'class'=>'form-control','style'=>'resize:none','maxlength'=>"290",'options'=>['500'=>'500','1000'=>'1000','1500'=>'1500','2000'=>'2000','3000'=>'3000','5000'=>'5000','7000'=>'7000','10000'=>'10000'],'empty'=>'Select amount you want to pay','id'=>'sms-amount']);
       echo $this->Form->submit('PURCHASE UNITS',['class'=>'btn btn-sm btn-danger btn-block mt-2   ']);
       echo $this->Form->end();*/

       exit;

        //cakephp-paystack-master

    }
    
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function failed()
    {
        echo "failed payment";
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    
    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {

          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);

          if ($unit == "K") {
              return ($miles * 1.609344);
          } else if ($unit == "N") {
              return ($miles * 0.8684);
          } else {
              return $miles;
          }
    }
}
