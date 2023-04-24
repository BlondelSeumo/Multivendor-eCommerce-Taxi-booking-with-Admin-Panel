<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VendorUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Session;

class RentalController extends Controller
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
        error_reporting(0);
    }


    public function index()
    {
        return view('rental.index');
    }

    public function RentalOrders()
    {
        return view('rental.rental_orders');
    }
    public function RentalOrdersDetails($id)
    {
        return view('rental.rental_orders_detail')->with('id', $id);
    }

    public function rentalCars()
    {
        $rentalCarsData = Session::get('rentalCarsData', []);

        return view('rental.rental_cars', ['rentalCarsData' => $rentalCarsData]);
    }

    public function findRentalCars(Request $request)
    {
        $data = $request->all();

        $rentalCarsData = Session::get('rentalCarsData', []);
        $rentalCarsData = $data;
        Session::put('rentalCarsData', $rentalCarsData);
        Session::save();

        $res = array('data' => $rentalCarsData);
        echo json_encode($res);
        exit;
    }

    public function rentalCarsDetails($id)
    {
        $email = Auth::user()->email;

        $user = VendorUsers::where('email', $email)->first();

        $rentalCarsData = Session::get('rentalCarsData', []);

        return view('rental.rental_cars_view', ['rentalCarsData' => $rentalCarsData, 'user_id' => $user->uuid])->with('id', $id);

    }

    public function rentalCarsCheckout($id)
    {
        $email = Auth::user()->email;

        $user = VendorUsers::where('email', $email)->first();

        if ($user->uuid) {
            $rentalCarsData = Session::get('rentalCarsData', []);

            return view('rental.rental_checkout', ['rentalCarsData' => $rentalCarsData, 'user_id' => $user->uuid])->with('id', $id);

        } else {
            return view('auth.loginuser');
        }

    }

    public function rentalOrderComplete(Request $request)
    {
        $rental_cart = array();

        Session::put('success', 'Your order has been successful!');
        $fcm = $request->fcm;
        $authorName = $request->authorName;
        $response = array();
        $rental_cart['cart_order']['authorName'] = $authorName;
        // print_r($rental_cart);
        // exit;
        Session::put('rentalCarsData', $rental_cart);

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
        $res = array('status' => true, 'order_complete' => true, 'html' => view('rental.success', ['rentalCarsData' => $rental_cart, 'order_complete' => true, 'is_checkout' => 1])->render(), 'response' => $response);
        echo json_encode($res);
        exit;

    }

    public function rentalSuccess()
    {
        $rentalCarsData = Session::get('rentalCarsData', []);

        $email = Auth::user()->email;
        $user = VendorUsers::where('email', $email)->first();

        if (isset($_GET['token'])) {
            $payfast_payment = Session::get('payfast_payment_token');
            if ($payfast_payment == $_GET['token']) {
                $rentalCarsData['payment_status'] = true;
                Session::put('rentalCarsData', $rentalCarsData);
                Session::put('success', 'Payment successful');
                Session::save();
            }
        }

        if (isset($_GET['reference'])) {
            $paystack_reference = Session::get('paystack_reference');
            $paystack_access_code = Session::get('paystack_access_code');
            if ($paystack_reference == $_GET['reference']) {
                $rentalCarsData['payment_status'] = true;
                Session::put('rentalCarsData', $rentalCarsData);
                Session::put('success', 'Payment successful');
                Session::save();
            }
        }

        if (isset($_GET['transaction_id']) && isset($_GET['tx_ref']) && isset($_GET['status'])) {
            $flutterwave_pay_tx_ref = Session::get('flutterwave_pay_tx_ref');
            if ($_GET['status'] == 'successful' && $flutterwave_pay_tx_ref == $_GET['tx_ref']) {
                $rentalCarsData['payment_status'] = true;
                Session::put('rentalCarsData', $rentalCarsData);
                Session::put('success', 'Payment successful');
                Session::save();
            }
        }


        if (isset($_GET['preference_id']) && isset($_GET['payment_id']) && isset($_GET['status'])) {

            $mercadopago_preference_id = Session::get('mercadopago_preference_id');
            if ($_GET['status'] == 'approved' && $mercadopago_preference_id == $_GET['preference_id']) {
                $rentalCarsData['payment_status'] = true;
                Session::put('rentalCarsData', $rentalCarsData);
                Session::put('success', 'Payment successful');
                Session::save();
            } else {
                return redirect()->route('checkout');
            }
        }

        $payment_method = (@$rentalCarsData['cart_order']['payment_method']) ? $rentalCarsData['cart_order']['payment_method'] : 'cod';
        return view('rental.success', ['rentalCarsData' => $rentalCarsData, 'id' => $user->uuid, 'email' => $email, 'payment_method' => $payment_method]);
    }

    public function rentalOrderProccessing(Request $request)
    {
        $cart_order = $request->all();
        $email = Auth::user()->email;
        $user = VendorUsers::where('email', $email)->first();
        $rental_cart = Session::get('rentalCarsData', []);

        $rental_cart['cart_order'] = $cart_order;
        Session::put('rentalCarsData', $rental_cart);
        Session::save();

        $res = array('status' => true);
        echo json_encode($res);
        exit;
    }

    public function processRentalOrderPay()
    {

        $email = Auth::user()->email;
        $user = VendorUsers::where('email', $email)->first();
        $rentalCarsData = Session::get('rentalCarsData', []);

        if (@$rentalCarsData['cart_order']) {
            if ($rentalCarsData['cart_order']['payment_method'] == 'razorpay') {
                $razorpaySecret = $rentalCarsData['cart_order']['razorpaySecret'];
                $razorpayKey = $rentalCarsData['cart_order']['razorpayKey'];
                $authorName = $rentalCarsData['cart_order']['authorName'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];

                return view('rental.razorpay', ['is_checkout' => 1, 'rentalCarsData' => $rentalCarsData, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'razorpaySecret' => $razorpaySecret, 'razorpayKey' => $razorpayKey, 'cart_order' => $rentalCarsData['cart_order']]);
            } else if ($rentalCarsData['cart_order']['payment_method'] == 'payfast') {
                $payfast_merchant_key = $rentalCarsData['cart_order']['payfast_merchant_key'];
                $payfast_merchant_id = $rentalCarsData['cart_order']['payfast_merchant_id'];
                $payfast_isSandbox = $rentalCarsData['cart_order']['payfast_isSandbox'];

                $payfast_return_url = route('rental_success');
                $payfast_notify_url = route('rental_notify');
                $payfast_cancel_url = route('process_rental_order_pay');


                $authorName = $rentalCarsData['cart_order']['authorName'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];
                $amount = 0;
                $token = uniqid();
                Session::put('payfast_payment_token', $token);
                Session::save();
                $payfast_return_url = $payfast_return_url . '?token=' . $token;

                return view('rental.payfast', ['is_checkout' => 1, 'rentalCarsData' => $rentalCarsData, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'payfast_merchant_key' => $payfast_merchant_key, 'payfast_merchant_id' => $payfast_merchant_id, 'payfast_isSandbox' => $payfast_isSandbox, 'payfast_return_url' => $payfast_return_url, 'payfast_notify_url' => $payfast_notify_url, 'payfast_cancel_url' => $payfast_cancel_url, 'cart_order' => $rentalCarsData['cart_order']]);
            } else if ($rentalCarsData['cart_order']['payment_method'] == 'paystack') {

                $paystack_public_key = $rentalCarsData['cart_order']['paystack_public_key'];
                $paystack_secret_key = $rentalCarsData['cart_order']['paystack_secret_key'];
                $paystack_isSandbox = $rentalCarsData['cart_order']['paystack_isSandbox'];

                $authorName = $rentalCarsData['cart_order']['authorName'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];
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


            } else if ($rentalCarsData['cart_order']['payment_method'] == 'flutterwave') {

                $currency = "USD";
                if (@$rentalCarsData['cart_order']['currencyData']['code']) {
                    $currency = $rentalCarsData['cart_order']['currencyData']['code'];
                }
                $flutterWave_secret_key = $rentalCarsData['cart_order']['flutterWave_secret_key'];
                $flutterWave_public_key = $rentalCarsData['cart_order']['flutterWave_public_key'];
                $flutterWave_isSandbox = $rentalCarsData['cart_order']['flutterWave_isSandbox'];
                $flutterWave_encryption_key = $rentalCarsData['cart_order']['flutterWave_encryption_key'];

                $authorName = $rentalCarsData['cart_order']['authorName'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];

                Session::put('flutterwave_pay', 1);
                Session::save();

                $token = uniqid();
                Session::put('flutterwave_pay_tx_ref', $token);
                Session::save();

                return view('rental.flutterwave', ['is_checkout' => 1, 'rentalCarsData' => $rentalCarsData, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'flutterWave_secret_key' => $flutterWave_secret_key, 'flutterWave_public_key' => $flutterWave_public_key, 'flutterWave_isSandbox' => $flutterWave_isSandbox, 'flutterWave_encryption_key' => $flutterWave_encryption_key, 'token' => $token, 'cart_order' => $rentalCarsData['cart_order'], 'currency' => $currency]);


            } else if ($rentalCarsData['cart_order']['payment_method'] == 'mercadopago') {

                $currency = "USD";
                if (@$rentalCarsData['cart_order']['currencyData']['code']) {
                    $currency = $rentalCarsData['cart_order']['currencyData']['code'];
                }
                $mercadopago_public_key = $rentalCarsData['cart_order']['mercadopago_public_key'];
                $mercadopago_access_token = $rentalCarsData['cart_order']['mercadopago_access_token'];
                $mercadopago_isSandbox = $rentalCarsData['cart_order']['mercadopago_isSandbox'];
                $mercadopago_isEnabled = $rentalCarsData['cart_order']['mercadopago_isEnabled'];

                $id = $rentalCarsData['cart_order']['id'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];

                $items['title'] = $id;
                $items['quantity'] = 1;
                $items['unit_price'] = floatval($total_pay);

                $fields[] = $items;
                $item['items'] = $fields;
                $item['back_urls']['failure'] = route('process_rental_order_pay');
                $item['back_urls']['pending'] = route('rental_notify');
                $item['back_urls']['success'] = route('rental_success');
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
                $authorName = $rentalCarsData['cart_order']['authorName'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];

                if ($mercadopago_isSandbox == "true") {
                    $payment_url = $mercadopago->sandbox_init_point;
                } else {
                    $payment_url = $mercadopago->init_point;
                }
                echo "<script>location.href = '" . $payment_url . "';</script>";
                exit;

            } else if ($rentalCarsData['cart_order']['payment_method'] == 'stripe') {


                $stripeKey = $rentalCarsData['cart_order']['stripeKey'];
                                
                $stripeSecret = $rentalCarsData['cart_order']['stripeSecret'];
                $authorName = $rentalCarsData['cart_order']['authorName'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];

                $senderAddress = $rentalCarsData['cart_order']['senderAddress'];
                $stripeSecret = $rentalCarsData['cart_order']['stripeSecret'];
                $stripeKey = $rentalCarsData['cart_order']['stripeKey'];
                $isStripeSandboxEnabled = $rentalCarsData['cart_order']['isStripeSandboxEnabled'];
                $authorName = $rentalCarsData['cart_order']['authorName'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];
                $amount = 0;
                return view('rental.stripe', ['is_checkout' => 1, 'rentalCarsData' => $rentalCarsData, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'stripeSecret' => $stripeSecret, 'stripeKey' => $stripeKey, 'cart_order' => $rentalCarsData['cart_order'], 'senderAddress' => $senderAddress]);

            } else if ($rentalCarsData['cart_order']['payment_method'] == 'paypal') {

                $paypalSecret = $rentalCarsData['cart_order']['paypalSecret'];
                $paypalKey = $rentalCarsData['cart_order']['paypalKey'];

                $ispaypalSandboxEnabled = $rentalCarsData['cart_order']['ispaypalSandboxEnabled'];
                $authorName = $rentalCarsData['cart_order']['authorName'];
                $total_pay = $rentalCarsData['cart_order']['total_pay'];

                return view('rental.paypal', ['is_checkout' => 1, 'rentalCarsData' => $rentalCarsData, 'id' => $user->uuid, 'email' => $email, 'authorName' => $authorName, 'amount' => $total_pay, 'paypalSecret' => $paypalSecret, 'paypalKey' => $paypalKey, 'cart_order' => $rentalCarsData['cart_order']]);
            }
        }

    }

    public function rentalRazorpayPayment(Request $request)
    {
        $input = $request->all();
        $email = Auth::user()->email;
        $user = VendorUsers::where('email', $email)->first();
        $rentalCarsData = Session::get('rentalCarsData', []);
        $api_secret = $rentalCarsData['cart_order']['razorpaySecret'];
        $api_key = $rentalCarsData['cart_order']['razorpayKey'];
        $api = new Api($api_key, $api_secret);

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

                $rentalCarsData['payment_status'] = true;
                Session::put('rentalCarsData', $rentalCarsData);
                Session::save();

            } catch (Exception $e) {
                return $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        Session::put('success', 'Payment successful');
        return redirect()->route('rental_success');

    }

    public function processRentalStripePayment(Request $request)
    {
        $email = Auth::user()->email;
        $input = $request->all();

        $rentalCarsData = Session::get('rentalCarsData', []);
       
        if (@$rentalCarsData['cart_order'] && $input['token_id']) {
            
            if ($rentalCarsData['cart_order']['stripeKey'] && $rentalCarsData['cart_order']['stripeSecret']) {
                
                $currency = "USD";
                if (@$rentalCarsData['cart_order']['currency']) {
                    $currency = $rentalCarsData['cart_order']['currency'];
                }
                $stripeSecret = $rentalCarsData['cart_order']['stripeSecret'];
                $stripe =new \Stripe\StripeClient($stripeSecret);

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
                        'amount' => ($rentalCarsData['cart_order']['total_pay'] * 1000),
                        'currency' => $currency,
                        'description' => 'Emart Order',
                        'source' => $input['token_id'],
                        //"address" => ["city" => $address_city, "country" => $address_country, "line1" => $address_line1, "line2" => $address_line2, "postal_code" => $address_zipcode, "state" => $address_state],

                    ]);

                    /*}*/
                    $rentalCarsData['payment_status'] = true;
                    Session::put('rentalCarsData', $rentalCarsData);
                    Session::put('success', 'Payment successful');
                    Session::save();
                    $res = array('status' => true, 'data' => $charge, 'message' => 'success');
                    echo json_encode($res);
                    exit;

                } catch (Exception $e) {
                    $rentalCarsData['payment_status'] = false;
                    Session::put('rentalCarsData', $rentalCarsData);
                    Session::put('error', $e->getMessage());
                    Session::save();
                    $res = array('status' => false, 'message' => $e->getMessage());
                    echo json_encode($res);
                    exit;
                }

            }
        }


    }

    public function processRentalPaypalPayment(Request $request)
    {
        $email = Auth::user()->email;
        $input = $request->all();

        $rentalCarsData = Session::get('rentalCarsData', []);
        if (@$rentalCarsData['cart_order']) {
            if ($rentalCarsData['cart_order']) {

                $rentalCarsData['payment_status'] = true;
                Session::put('rentalCarsData', $rentalCarsData);
                Session::put('success', 'Payment successful');
                Session::save();
                $res = array('status' => true, 'data' => array(), 'message' => 'success');
                echo json_encode($res);
                exit;

            }
        }


        $rentalCarsData['payment_status'] = false;
        Session::put('rentalCarsData', $rentalCarsData);
        Session::put('error', 'Faild Payment');
        Session::save();
        $res = array('status' => false, 'message' => 'Faild Payment');
        echo json_encode($res);
        exit;

    }

    public function applyRentalCoupon(Request $request)
    {
        if ($request->coupon_code) {
            $rental_cart = Session::get('rentalCarsData');
            $rental_cart['coupon']['coupon_code'] = $request->coupon_code;
            $rental_cart['coupon']['coupon_id'] = $request->coupon_id;
            $rental_cart['coupon']['discount'] = $request->discount;
            $rental_cart['coupon']['discountType'] = $request->discountType;

            $startDate = strtotime($rental_cart['startDate']);
            $endDate = strtotime($rental_cart['endDate']);

            $dayDifferent = abs($startDate - $endDate);

            $countDays = $dayDifferent / 86400;  // 86400 seconds in one day

            // and you might want to convert to integer
            $countDays = round($countDays) + 1;

            $carRateAmount = floatval($rental_cart['car_rate']) * $countDays;

            $driverRateAmount = 0;
            if ($rental_cart['isDriver'] == "true") {
                $driverRateAmount = $countDays * floatval($rental_cart['driver_rate']);
            }

            $total_item_price = floatval($carRateAmount) + floatval($driverRateAmount);
            $total_item_price = round($total_item_price, 2);

            $rental_cart['carRateAmount'] = $carRateAmount;
            $rental_cart['total_item_price'] = $total_item_price;
            $rental_cart['countDays'] = $countDays;
            $discount_amount = 0;
            /*Disctount*/

            if (@$rental_cart['coupon'] && $rental_cart['coupon']['discountType']) {
                $discountType = $rental_cart['coupon']['discountType'];
                $coupon_code = $rental_cart['coupon']['coupon_code'];
                $coupon_id = @$rental_cart['coupon']['coupon_id'];
                $discount = $rental_cart['coupon']['discount'];
                if ($discountType == "Fix Price") {
                    $discount_amount = $rental_cart['coupon']['discount'];
                    if ($discount_amount > $total_item_price) {
                        $discount_amount = $total_item_price;
                    }
                } else {
                    $discount_amount = $rental_cart['coupon']['discount'];
                    $discount_amount = round((($total_item_price * $discount_amount) / 100), 2);
                    if ($discount_amount > $total_item_price) {
                        $discount_amount = $total_item_price;
                    }
                }
            }
            $rental_cart['coupon']['coupon_code'] = $request->coupon_code;
            $rental_cart['coupon']['coupon_id'] = $request->coupon_id;
            $rental_cart['coupon']['discount_amount'] = $discount_amount;
            $rental_cart['coupon']['discount'] = $discount;
            $rental_cart['coupon']['discountType'] = $request->discountType;

            $total_item_price = $total_item_price - $discount_amount;

            if ($rental_cart['taxType'] == 'percent') {
                $tax_total_amount = round((($rental_cart['tax'] * $total_item_price) / 100), 2);
            } else {
                $tax_total_amount = $rental_cart['tax'];
            }

            $rental_cart['tax_total_amount'] = $tax_total_amount;
            $total_item_price = $total_item_price + $tax_total_amount;
            $rental_cart['total_pay'] = $total_item_price;

            Session::put('rentalCarsData', $rental_cart);
            Session::save();
            $res = array('status' => true, 'html' => view('rental.rental_checkout', ['rentalCarsData' => $rental_cart])->with('id', $request->rental_user_id));
            echo json_encode($res);
            exit;
        }
    }


}
