<?php

namespace App\Http\Controllers;
use App\Models\VendorUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class VendorController extends Controller
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
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cart = session()->get('cart', []);
		return view('vendor.vendor',['cart'=>$cart]);
    }

	public function categoryList()
    {
        return view('vendor.categorylist');
    }

    public function categoryDetail($id)
    {
        return view('vendor.list',['id'=>$id]);
    }

     public function sendnotification(Request $request){

        $fcm=$request->fcm;
        $authorName=$request->authorName;
        $response = array();
        /*$fcm="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
        if($fcm){
                $server_key = env('FIREBASE_KEY');
                if($server_key){
                    $target = $fcm;
                    /*$target="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
                    /*$target="eE5Pq9zASCqcvAwrJuC9gm:APA91bGoMT81ZTgEGoROebTCg2WpxwtkiYw_aQL-cSkRhRIpW4FV8LiSiFswSweN4Pbu6mmQnpYYWTZZFbXezo74oGxezD-SNtfiWbsk-1d9BCzJXb_H5GxwrvdnLzaueJieqkNdo6hL";*/
                    /*$target="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $fields = array();
                    $fields['priority']="high";
                    $fields['notification']['title']="New Dyining Request!";
                    $fields['notification']['body'] = $authorName." has sent dyining request";
                    $fields['notification']['sound'] = 'default';
                    $fields['data']['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
                    $fields['data']['id'] = '1';
                    $fields['data']['status'] = 'done';
                    if(is_array($target)){
                        $fields['registration_ids'] = $target;
                    }else{
                        $fields['to'] = $target;
                    }

                    $headers = array(
                        'Content-Type:application/json',
                      'Authorization:key='.$server_key
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
                    $result=json_decode($result);
                    $response = array();
                    $response['target'] = $target;
                    $response['fields'] = $fields;
                    $response['result'] = $result;

                }else{
                    $response = array();
                    $response['message'] = 'Firebase Server key not found!';
                    $response['target'] = '';
                    $response['fields'] = '';
                    $response['result'] = '';

                }
        }

        $res=array('status'=>true,'request_complete'=>true,'response'=>$response);
        echo json_encode($res);exit;

    }
}
