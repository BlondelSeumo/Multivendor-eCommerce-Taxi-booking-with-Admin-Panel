<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorUsers;
use Illuminate\Http\Request;
class OrderController extends Controller
{

 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$user = Auth::user();
        $id = Auth::id();
        $exist = VendorUsers::where('user_id',$id)->first();
        $id=$exist->uuid;
        return view("orders.index")->with('id',$id);
    }


 	public function edit($id = '',$pid = '',$aid = '',$rid = '')
    {
    	return view('orders.edit')->with('id', $id)->with('pid', $pid)->with('aid', $aid)->with('rid', $rid);
    }
	
 	public function placedOrders()
    {
    	$user = Auth::user();
        $id = Auth::id();
        $exist = VendorUsers::where('user_id',$id)->first();
        $id=$exist->uuid;
    	return view('orders.placed')->with('id', $id);
    }

    public function acceptedOrders()
    {
    	$user = Auth::user();
        $id = Auth::id();
        $exist = VendorUsers::where('user_id',$id)->first();
        $id=$exist->uuid;
    	return view('orders.accepted')->with('id', $id);
    }

public function rejectedOrders()
    {
    	$user = Auth::user();
        $id = Auth::id();
        $exist = VendorUsers::where('user_id',$id)->first();
        $id=$exist->uuid;
    	return view('orders.rejected')->with('id', $id);
}
    
public function sendNotification(Request $request)
    {
        $fcm=$request->fcm;
        $vendorname=$request->vendorname;
        $orderStatus=$request->orderStatus;
        $response=array();
        if($fcm && ($orderStatus=="Order Accepted" || $orderStatus=="Order Rejected")){
                $server_key = env('FIREBASE_KEY');
                if($server_key){
                    $target = $fcm;
                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $fields = array();
                    $fields['priority']="high";
                    if($orderStatus=="Order Accepted"){
                        $fields['notification']['title']="Your Order has Accepted";
                        $fields['notification']['body'] = $vendorname." has Accept Your Order";
                    }else if($orderStatus=="Order Rejected"){
                        $fields['notification']['title']="Your Order has Rejected";
                        $fields['notification']['body'] = $vendorname." has Reject Your Order";
                    }
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

        echo json_encode($response);
        exit;
}

public function orderprint($id='')
{
    return view('orders.print')->with('id', $id);
}
    

}
