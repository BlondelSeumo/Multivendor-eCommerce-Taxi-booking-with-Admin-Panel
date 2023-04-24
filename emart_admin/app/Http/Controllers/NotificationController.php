<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\VendorUsers;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id='')
    {

        return view("notification.index")->with('id',$id);
    }

    public function send($id='')
    {
        return view('notification.send')->with('id',$id);
    }

    public function broadcastnotification(Request $request){

        $fcm=$request->fcm;

        /*$fcm="fc-4OJHRRXOtKr_TiFc6Kf:APA91bEn4XWugvl9cT9X4qHSvokbtQiQDSOilTNmfZwn36UARtKWBScTjxSb9zTFwFEKTo1BxNsDEM6hcFd93BMka6ohpVBkWFOR41ztnsHkEFgW-HQRMMrk0TWI55u7c1dgKG97_5zV";*/

        $authorName=$request->authorName;
        $response = array();
        if($fcm){
            $server_key = env('FIREBASE_KEY');
            if($server_key){
                $target = $fcm;

                $url = 'https://fcm.googleapis.com/fcm/send';
                $fields = array();
                $fields['priority']="high";
                $fields['notification']['title']=$request->subject;
                $fields['notification']['body'] = $request->message;

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


