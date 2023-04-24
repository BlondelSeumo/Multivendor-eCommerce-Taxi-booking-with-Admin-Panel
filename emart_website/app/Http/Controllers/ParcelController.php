<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VendorUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Session;

class ParcelController extends Controller
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


    public function parcel($id)
    {
        return view('parcel.parcel')->with('id', $id);
    }
    public function parcelOrders()
    {
        return view('parcel.parcel_orders');
    }
    public function parcelCheckout()
    {
        $email = Auth::user()->email;

        $user = VendorUsers::where('email', $email)->first();

        $parcel_cart = Session::get('parcel_cart', []);

        return view('parcel.parcel_checkout', ['parcel_cart' => $parcel_cart, 'id' => $user->uuid]);
    }

    public function parcelCart(Request $request)
    {
        $req = $request->all();
        $parcelCategoryId = $req['parcelCategoryId'];
        $section_id = $req['section_id'];
        $parcel_cart = Session::get('parcel_cart', []);

        $parcelType = $req['parcelType'];
        $senderAddress = $req['senderAddress'];
        $senderName = $req['senderName'];
        $senderPhone = $req['senderPhone'];
        $senderParcelWeight = $req['senderParcelWeight'];
        $senderParcelWeightName = $req['senderParcelWeightName'];
        $senderNote = $req['senderNote'];
        $senderArrive = $req['senderArrive'];
        $receiverAddress = $req['receiverAddress'];
        $receiverName = $req['receiverName'];
        $receiverPhone = $req['receiverPhone'];
        $sender_address_lng = $req['sender_address_lng'];
        $sender_address_lat = $req['sender_address_lat'];
        $receiver_address_lng = $req['receiver_address_lng'];
        $receiver_address_lat = $req['receiver_address_lat'];
        $delivery_charge = $req['delivery_charge'];
        $isSchedule = $req['isSchedule'];

        $tax_type = $req['tax_type'];
        $tax_lable = $req['tax_lable'];
        $tax_amount = $req['tax_amount'];

        $discount = $req['discount'];
        $total_pay = 0;
        $parcelDeliveryCharge = 0;
        $kmradius = 0;
        if (@$delivery_charge && @$sender_address_lng && @$sender_address_lat && @$receiver_address_lng && @$receiver_address_lat) {

            if (!empty($delivery_charge)) {

                $kmradius = $this->distance($sender_address_lng, $sender_address_lat, $receiver_address_lng, $receiver_address_lat, 'K');

                $parcelDeliveryCharge = round($kmradius * $delivery_charge);

                $total_pay = $parcelDeliveryCharge;


            }
        }

        $parcel_cart['parcelDeliveryCharge'] = $parcelDeliveryCharge;
        $parcel_cart['parcelDeliveryKM'] = $kmradius;

        if (!empty($tax_type)) {
            if ($tax_type == "fix") {
                $tax_total_amount = $tax_amount;

            } else {
                $tax_total_amount = round((($tax_amount * $total_pay) / 100), 2);
            }
            $parcel_cart['tax_amount'] = $tax_amount;
            $parcel_cart['tax_type'] = $tax_type;
            $parcel_cart['tax_label'] = $tax_lable;
            $parcel_cart['tax_total_amount'] = $tax_total_amount;
        }

        $total_pay = $total_pay + $tax_total_amount;

        $parcel_cart['section_id'] = $section_id;
        $parcel_cart['parcelType'] = $parcelType;
        $parcel_cart['parcelCategoryId'] = $parcelCategoryId;
        $parcel_cart['senderAddress'] = $senderAddress;
        $parcel_cart['senderName'] = $senderName;
        $parcel_cart['senderPhone'] = $senderPhone;
        $parcel_cart['senderParcelWeight'] = $senderParcelWeight;
        $parcel_cart['senderParcelWeightName'] = $senderParcelWeightName;
        $parcel_cart['senderNote'] = $senderNote;
        $parcel_cart['senderArrive'] = $senderArrive;
        $parcel_cart['receiverAddress'] = $receiverAddress;
        $parcel_cart['receiverName'] = $receiverName;
        $parcel_cart['receiverPhone'] = $receiverPhone;
        $parcel_cart['sender_address_lat'] = $sender_address_lat;
        $parcel_cart['sender_address_lng'] = $sender_address_lng;
        $parcel_cart['receiver_address_lng'] = $receiver_address_lng;
        $parcel_cart['receiver_address_lat'] = $receiver_address_lat;
        $parcel_cart['total_pay'] = $total_pay;
        $parcel_cart['deliveryCharge'] = $delivery_charge;
        $parcel_cart['coupon'] = [];
        $parcel_cart['parcelImages'] = $req['parcelImages'];

        $parcel_cart['isSchedule'] = $isSchedule;
        $parcel_cart['senderPickupDateTime'] = $req['senderPickupDateTime'];
        $parcel_cart['receiverPickupDateTime'] = $req['receiverPickupDateTime'];
        $parcel_cart['decimal_degits'] = $req['decimal_degits'];

        Session::put('parcel_cart', $parcel_cart);
        Session::save();
        $res = array('status' => true, 'html' => view('parcel.parcel_checkout', ['parcel_cart' => $parcel_cart])->render());
        echo json_encode($res);
        exit;

    }

    public function distance($lon1, $lat1, $lon2, $lat2, $unit)
    {

        $theta = $lon2 - $lon1;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = 6378.8*acos($dist);
        return $dist;
        //$dist = rad2deg($dist);
        //$miles = $dist * 60 * 1.1515;
        //$unit = strtoupper($unit);

        // if ($unit == "K") {
        //     return ($miles * 1.609344);
        // } else if ($unit == "N") {
        //     return ($miles * 0.8684);
        // } else {
        //     return $miles;
        // }
    }

    public function applyParcelCoupon(Request $request)
    {
        if ($request->coupon_code) {
            $parcel_cart = Session::get('parcel_cart');
            $parcel_cart['coupon']['coupon_code'] = $request->coupon_code;
            $parcel_cart['coupon']['coupon_id'] = $request->coupon_id;
            $parcel_cart['coupon']['discount'] = $request->discount;
            $parcel_cart['coupon']['discountType'] = $request->discountType;


            $total_item_price = $parcel_cart['parcelDeliveryCharge'];

            $discount_amount = 0;
            /*Disctount*/

            if (@$parcel_cart['coupon'] && $parcel_cart['coupon']['discountType']) {
                $discountType = $parcel_cart['coupon']['discountType'];
                $coupon_code = $parcel_cart['coupon']['coupon_code'];
                $coupon_id = @$parcel_cart['coupon']['coupon_id'];
                $discount = $parcel_cart['coupon']['discount'];
                if ($discountType == "Fix Price") {
                    $discount_amount = $parcel_cart['coupon']['discount'];
                    if ($discount_amount > $total_item_price) {
                        $discount_amount = $total_item_price;
                    }
                } else {
                    $discount_amount = $parcel_cart['coupon']['discount'];
                    $discount_amount = round((($total_item_price * $discount_amount) / 100), 2);
                    if ($discount_amount > $total_item_price) {
                        $discount_amount = $total;
                    }
                }
            }
            $parcel_cart['coupon']['coupon_code'] = $request->coupon_code;
            $parcel_cart['coupon']['coupon_id'] = $request->coupon_id;
            $parcel_cart['coupon']['discount_amount'] = $discount_amount;
            $parcel_cart['coupon']['discount'] = $discount;
            $parcel_cart['coupon']['discountType'] = $request->discountType;

            $total_item_price = $total_item_price - $discount_amount;

            if ($parcel_cart['tax_type'] == 'percent') {
                $tax_total_amount = round((($parcel_cart['tax_amount'] * $total_item_price) / 100), 2);
            } else {
                $tax_total_amount = $parcel_cart['tax_amount'];
            }

            $parcel_cart['tax_total_amount'] = $tax_total_amount;
            $total_item_price = $total_item_price + $tax_total_amount;
            $parcel_cart['total_pay'] = $total_item_price;

            Session::put('parcel_cart', $parcel_cart);
            Session::save();
            $res = array('status' => true, 'html' => view('parcel.parcel_checkout', ['parcel_cart' => $parcel_cart])->render());
            echo json_encode($res);
            exit;
        }
    }

    public function parcelOrderProccessing(Request $request)
    {
        $cart_order = $request->all();
        $email = Auth::user()->email;
        $user = VendorUsers::where('email', $email)->first();
        $parcel_cart = Session::get('parcel_cart', []);

        $parcel_cart['cart_order'] = $cart_order;
        Session::put('parcel_cart', $parcel_cart);
        Session::save();

        $res = array('status' => true);
        echo json_encode($res);
        exit;
    }

    public function processParcelOrderPay()
    {

        $email = Auth::user()->email;
        $user = VendorUsers::where('email', $email)->first();
        $parcel_cart = Session::get('parcel_cart', []);

        if (@$parcel_cart['cart_order']) {
            if ($parcel_cart['cart_order']['payment_method'] == 'razorpay') {
                $razorpaySecret = $parcel_cart['cart_order']['razorpaySecret'];
                $razorpayKey = $parcel_cart['cart_order']['razorpayKey'];
                $authorName = $parcel_cart['cart_order']['authorName'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];
                $amount = 0;
                return view('parcel.razorpay', ['is_checkout' => 1, 'parcel_cart' => $parcel_cart, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'razorpaySecret' => $razorpaySecret, 'razorpayKey' => $razorpayKey, 'cart_order' => $parcel_cart['cart_order']]);
            } else if ($parcel_cart['cart_order']['payment_method'] == 'payfast') {
                $payfast_merchant_key = $parcel_cart['cart_order']['payfast_merchant_key'];
                $payfast_merchant_id = $parcel_cart['cart_order']['payfast_merchant_id'];
                $payfast_isSandbox = $parcel_cart['cart_order']['payfast_isSandbox'];

                $payfast_return_url = route('parcel_success');
                $payfast_notify_url = route('parcel_notify');
                $payfast_cancel_url = route('process_parcel_order_pay');


                $authorName = $parcel_cart['cart_order']['authorName'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];
                $amount = 0;
                $token = uniqid();
                Session::put('payfast_payment_token', $token);
                Session::save();
                $payfast_return_url = $payfast_return_url . '?token=' . $token;

                return view('parcel.payfast', ['is_checkout' => 1, 'parcel_cart' => $parcel_cart, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'payfast_merchant_key' => $payfast_merchant_key, 'payfast_merchant_id' => $payfast_merchant_id, 'payfast_isSandbox' => $payfast_isSandbox, 'payfast_return_url' => $payfast_return_url, 'payfast_notify_url' => $payfast_notify_url, 'payfast_cancel_url' => $payfast_cancel_url, 'cart_order' => $parcel_cart['cart_order']]);
            } else if ($parcel_cart['cart_order']['payment_method'] == 'paystack') {

                $paystack_public_key = $parcel_cart['cart_order']['paystack_public_key'];
                $paystack_secret_key = $parcel_cart['cart_order']['paystack_secret_key'];
                $paystack_isSandbox = $parcel_cart['cart_order']['paystack_isSandbox'];

                $authorName = $parcel_cart['cart_order']['authorName'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];
                $amount = 0;

                require_once(base_path() . '/paystack-php-master/vendor/autoload.php');
                define("PaystackPublicKey", $paystack_public_key);
                define("PaystackSecretKey", $paystack_secret_key);
                \Paystack\Paystack::init($paystack_secret_key);
                $payment = \Paystack\Transaction::initialize([
                    'email' => $email,
                    'amount' => (int)($total_pay * 100),
                ]);

                Session::put('paystack_authorization_url', $payment->authorization_url);
                Session::put('paystack_access_code', $payment->access_code);
                Session::put('paystack_reference', $payment->reference);
                Session::save();

                if ($payment->authorization_url) {
                    $script = "<script>window.location = '" . $payment->authorization_url . "';</script>";
                    echo $script;
                    exit;
                } else {
                    $script = "<script>window.location = '" . url('') . "';</script>";
                    echo $script;
                    exit;
                }


            } else if ($parcel_cart['cart_order']['payment_method'] == 'flutterwave') {

                $currency = "USD";
                if (@$parcel_cart['cart_order']['currencyData']['code']) {
                    $currency = $parcel_cart['cart_order']['currencyData']['code'];
                }
                $flutterWave_secret_key = $parcel_cart['cart_order']['flutterWave_secret_key'];
                $flutterWave_public_key = $parcel_cart['cart_order']['flutterWave_public_key'];
                $flutterWave_isSandbox = $parcel_cart['cart_order']['flutterWave_isSandbox'];
                $flutterWave_encryption_key = $parcel_cart['cart_order']['flutterWave_encryption_key'];

                $authorName = $parcel_cart['cart_order']['authorName'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];

                Session::put('flutterwave_pay', 1);
                Session::save();

                $token = uniqid();
                Session::put('flutterwave_pay_tx_ref', $token);
                Session::save();

                return view('parcel.flutterwave', ['is_checkout' => 1, 'parcel_cart' => $parcel_cart, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'flutterWave_secret_key' => $flutterWave_secret_key, 'flutterWave_public_key' => $flutterWave_public_key, 'flutterWave_isSandbox' => $flutterWave_isSandbox, 'flutterWave_encryption_key' => $flutterWave_encryption_key, 'token' => $token, 'cart_order' => $parcel_cart['cart_order'], 'currency' => $currency]);


            } else if ($parcel_cart['cart_order']['payment_method'] == 'mercadopago') {

                $currency = "USD";
                if (@$parcel_cart['cart_order']['currencyData']['code']) {
                    $currency = $parcel_cart['cart_order']['currencyData']['code'];
                }
                $mercadopago_public_key = $parcel_cart['cart_order']['mercadopago_public_key'];
                $mercadopago_access_token = $parcel_cart['cart_order']['mercadopago_access_token'];
                $mercadopago_isSandbox = $parcel_cart['cart_order']['mercadopago_isSandbox'];
                $mercadopago_isEnabled = $parcel_cart['cart_order']['mercadopago_isEnabled'];

                $id = $parcel_cart['cart_order']['id'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];

                $items['title'] = $id;
                $items['quantity'] = 1;
                $items['unit_price'] = floatval($total_pay);

                $fields[] = $items;
                $item['items'] = $fields;
                $item['back_urls']['failure'] = route('process_parcel_order_pay');
                $item['back_urls']['pending'] = route('parcel_notify');
                $item['back_urls']['success'] = route('parcel_success');
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
                $authorName = $parcel_cart['cart_order']['authorName'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];

                if ($mercadopago_isSandbox == "true") {
                    $payment_url = $mercadopago->sandbox_init_point;
                } else {
                    $payment_url = $mercadopago->init_point;
                }
                echo "<script>location.href = '" . $payment_url . "';</script>";
                exit;

            } else if ($parcel_cart['cart_order']['payment_method'] == 'stripe') {


                $stripeKey = $parcel_cart['cart_order']['stripeKey'];
                $stripeSecret = $parcel_cart['cart_order']['stripeSecret'];
                $authorName = $parcel_cart['cart_order']['authorName'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];

                $senderAddress = $parcel_cart['cart_order']['senderAddress'];
                $stripeSecret = $parcel_cart['cart_order']['stripeSecret'];
                $stripeKey = $parcel_cart['cart_order']['stripeKey'];
                $isStripeSandboxEnabled = $parcel_cart['cart_order']['isStripeSandboxEnabled'];
                $authorName = $parcel_cart['cart_order']['authorName'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];
                $amount = 0;
                return view('parcel.stripe', ['is_checkout' => 1, 'parcel_cart' => $parcel_cart, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'stripeSecret' => $stripeSecret, 'stripeKey' => $stripeKey, 'cart_order' => $parcel_cart['cart_order'], 'senderAddress' => $senderAddress]);

            } else if ($parcel_cart['cart_order']['payment_method'] == 'paypal') {

                $paypalSecret = $parcel_cart['cart_order']['paypalSecret'];
                $paypalKey = $parcel_cart['cart_order']['paypalKey'];

                $ispaypalSandboxEnabled = $parcel_cart['cart_order']['ispaypalSandboxEnabled'];
                $authorName = $parcel_cart['cart_order']['authorName'];
                $total_pay = $parcel_cart['cart_order']['total_pay'];

                return view('parcel.paypal', ['is_checkout' => 1, 'parcel_cart' => $parcel_cart, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'paypalSecret' => $paypalSecret, 'paypalKey' => $paypalKey, 'cart_order' => $parcel_cart['cart_order']]);
            }
        } else {
            return redirect()->route('parcel_checkout');
        }

    }

    public function parcelRazorpayPayment(Request $request)
    {
        $input = $request->all();
        $email = Auth::user()->email;
        $user = VendorUsers::where('email', $email)->first();
        $parcel_cart = Session::get('parcel_cart', []);
        $api_secret = $parcel_cart['cart_order']['razorpaySecret'];
        $api_key = $parcel_cart['cart_order']['razorpayKey'];
        $api = new Api($api_key, $api_secret);

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

                $parcel_cart['payment_status'] = true;
                Session::put('parcel_cart', $parcel_cart);
                Session::save();

            } catch (Exception $e) {
                return $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->route('parcel_success');

    }

    public function processParcelStripePayment(Request $request)
    {
        $email = Auth::user()->email;
        $input = $request->all();

        $parcel_cart = Session::get('parcel_cart', []);
        if (@$parcel_cart['cart_order'] && $input['token_id']) {

            if ($parcel_cart['cart_order']['stripeKey'] && $parcel_cart['cart_order']['stripeSecret']) {
                $currency = "usd";
                if (@$parcel_cart['cart_order']['currency']) {
                    $currency = $parcel_cart['cart_order']['currency'];
                }
                $stripeSecret = $parcel_cart['cart_order']['stripeSecret'];
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
                        'amount' => ($parcel_cart['cart_order']['total_pay'] * 1000),
                        'currency' => $currency,
                        'description' => 'Emart Order',
                        'source' => $input['token_id'],
                    ]);

                    /*}*/
                    $parcel_cart['payment_status'] = true;
                    Session::put('parcel_cart', $parcel_cart);
                    Session::put('success', 'Payment successful');
                    Session::save();
                    $res = array('status' => true, 'data' => $charge, 'message' => 'success');
                    echo json_encode($res);
                    exit;

                } catch (Exception $e) {
                    $parcel_cart['payment_status'] = false;
                    Session::put('parcel_cart', $parcel_cart);
                    Session::put('error', $e->getMessage());
                    Session::save();
                    $res = array('status' => false, 'message' => $e->getMessage());
                    echo json_encode($res);
                    exit;
                }

            }
        }


    }

    public function processParcelPaypalPayment(Request $request)
    {
        $email = Auth::user()->email;
        $input = $request->all();

        $parcel_cart = Session::get('parcel_cart', []);
        if (@$parcel_cart['cart_order']) {
            if ($parcel_cart['cart_order']) {

                $parcel_cart['payment_status'] = true;
                Session::put('parcel_cart', $parcel_cart);
                Session::put('success', 'Payment successful');
                Session::save();
                $res = array('status' => true, 'data' => array(), 'message' => 'success');
                echo json_encode($res);
                exit;

            }
        }


        $parcel_cart['payment_status'] = false;
        Session::put('parcel_cart', $parcel_cart);
        Session::put('error', 'Faild Payment');
        Session::save();
        $res = array('status' => false, 'message' => 'Faild Payment');
        echo json_encode($res);
        exit;

    }

    public function parcelSuccess()
    {
        $parcel_cart = Session::get('parcel_cart', []);

        $order_json = array();
        $email = Auth::user()->email;
        $user = VendorUsers::where('email', $email)->first();

        if (isset($_GET['token'])) {
            $payfast_payment = Session::get('payfast_payment_token');
            if ($payfast_payment == $_GET['token']) {
                $parcel_cart['payment_status'] = true;
                Session::put('parcel_cart', $parcel_cart);
                Session::put('success', 'Payment successful');
                Session::save();
            }
        }

        if (isset($_GET['reference'])) {
            $paystack_reference = Session::get('paystack_reference');
            $paystack_access_code = Session::get('paystack_access_code');
            if ($paystack_reference == $_GET['reference']) {
                $parcel_cart['payment_status'] = true;
                Session::put('parcel_cart', $parcel_cart);
                Session::put('success', 'Payment successful');
                Session::save();
            }
        }

        if (isset($_GET['transaction_id']) && isset($_GET['tx_ref']) && isset($_GET['status'])) {
            $flutterwave_pay_tx_ref = Session::get('flutterwave_pay_tx_ref');
            if ($_GET['status'] == 'successful' && $flutterwave_pay_tx_ref == $_GET['tx_ref']) {
                $parcel_cart['payment_status'] = true;
                Session::put('parcel_cart', $parcel_cart);
                Session::put('success', 'Payment successful');
                Session::save();
            } else {
                return redirect()->route('checkout');
            }
        }

        if (isset($_GET['preference_id']) && isset($_GET['payment_id']) && isset($_GET['status'])) {

            $mercadopago_preference_id = Session::get('mercadopago_preference_id');
            if ($_GET['status'] == 'approved' && $mercadopago_preference_id == $_GET['preference_id']) {
                $parcel_cart['payment_status'] = true;
                Session::put('parcel_cart', $parcel_cart);
                Session::put('success', 'Payment successful');
                Session::save();
            } else {
                return redirect()->route('checkout');
            }
        }

        $payment_method = (@$parcel_cart['cart_order']['payment_method']) ? $parcel_cart['cart_order']['payment_method'] : 'cod';
        return view('parcel.success', ['parcel_cart' => $parcel_cart, 'id' => $user->uuid, 'email' => $email, 'payment_method' => $payment_method]);
    }

    public function parcelOrderComplete(Request $request)
    {
        $parcel_cart = array();

        Session::put('success', 'Your order has been successful!');
        $fcm = $request->fcm;
        $authorName = $request->authorName;
        $response = array();
        $parcel_cart['cart_order']['authorName'] = $authorName;
        Session::put('parcel_cart', $parcel_cart);

        /*$fcm="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
        if ($fcm) {
            $server_key = env('FIREBASE_KEY');
            if ($server_key) {
                $target = $fcm;
                /*$target="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
                /*$target="eE5Pq9zASCqcvAwrJuC9gm:APA91bGoMT81ZTgEGoROebTCg2WpxwtkiYw_aQL-cSkRhRIpW4FV8LiSiFswSweN4Pbu6mmQnpYYWTZZFbXezo74oGxezD-SNtfiWbsk-1d9BCzJXb_H5GxwrvdnLzaueJieqkNdo6hL";*/
                /*$target="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
                $url = 'https://fcm.googleapis.com/fcm/send';
                $fields = array();
                $fields['priority'] = "high";
                $fields['notification']['title'] = "New Order!";
                $fields['notification']['body'] = $authorName . " has Ordered";
                $fields['notification']['sound'] = 'default';
                $fields['data']['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
                $fields['data']['id'] = '1';
                $fields['data']['status'] = 'done';
                if (is_array($target)) {
                    $fields['registration_ids'] = $target;
                } else {
                    $fields['to'] = $target;
                }

                $headers = array(
                    'Content-Type:application/json',
                    'Authorization:key=' . $server_key
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                if ($result === FALSE) {
                    die('FCM Send Error: ' . curl_error($ch));
                }
                curl_close($ch);
                $result2 = $result;
                $result = json_decode($result);
                $response = array();
                $response['target'] = $target;
                $response['fields'] = $fields;
                $response['result'] = $result;

            } else {
                $response = array();
                $response['message'] = 'Firebase Server key not found!';
                $response['target'] = '';
                $response['fields'] = '';
                $response['result'] = '';

            }
        }
        Session::save();
        $res = array('status' => true, 'order_complete' => true, 'html' => view('parcel.success', ['parcel_cart' => $parcel_cart, 'order_complete' => true, 'is_checkout' => 1])->render(), 'response' => $response);
        echo json_encode($res);
        exit;

    }
}
