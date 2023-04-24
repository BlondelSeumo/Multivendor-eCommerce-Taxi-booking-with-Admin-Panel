<?php

/**

 * File name: AjaxController.php

 * Last modified: 2020.06.11 at 16:10:52

 * AjaxController

 * Copyright (c) 2020

 */



namespace App\Http\Controllers\Auth;



use App\Models\VendorUsers;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Laravel\Socialite\Facades\Socialite;

use Prettus\Validator\Exceptions\ValidatorException;



class AjaxController extends Controller

{




    public function setToken(Request $request){

        $userId = $request->userId;
        $uuid = $request->id;
        $password=$request->password;
        $exist = VendorUsers::where('email',$request->email )->get();
        $data = $exist->isEmpty();

        if($exist->isEmpty()){
           
            $user=User::create([
                'name' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

             DB::table('vendor_users')->insert([
                'user_id' => $user->id,
                'uuid' => $uuid,
                'email' => $request->email,
            ]);

        }

        //$user = VendorUsers::where('user_id',$userId)->first();

        $user = User::where('email',$request->email)->first();
        
    
        /* Auth::loginUsingId($user->id, true); */
       Auth::login($user,true);
       $data = array();
       if(Auth::check()){

            $data['access'] = true;
       }

       
        return $data;
    }

    public function setTokenOLD(Request $request){



        $userId = $request->userId;

        $uuid = $request->id;

        $password=$request->password;

        $exist = VendorUsers::where('user_id',$userId )->get();

        $data = $exist->isEmpty();

        if($exist->isEmpty()){

            DB::table('vendor_users')->insert([

                'user_id' => $userId,

                'uuid' => $uuid,

                'email' => $request->email,

                // 'first_name' => $request->firstName,

                // 'last_name' => $request->lastName,

                // 'image_url' => $request->profilePicture,

            ]);



            User::create([

                'name' => $request->email,

                'email' => $request->email,

                'password' => Hash::make($password),

            ]);



        }else{

              /* DB::table('vendor_users')

            ->where('user_id', $userId)

            ->update(['first_name' => $request->firstName,'last_name'=>$request->lastName,'image_url'=>$request->profilePicture]); */



        }



        //$user = VendorUsers::where('user_id',$userId)->first();



        $user = User::where('email',$request->email)->first();

        



        /* Auth::loginUsingId($user->id, true); */

        Auth::login($user,true);

       $data = array();

       if(Auth::check()){



            $data['access'] = true;

       }



       

        return $data;



    }



    public function logoutOLD(Request $request){



        $user_id = Auth::user()->user_id;

        $user = VendorUsers::where('user_id',$user_id)->first();



        try {

            Auth::logout();
            return redirect('/login');

        } catch (\Exception $e) {

              $this->sendError($e->getMessage(), 401);

        }

        

        $data1 = array();

        if(!Auth::check()){

          $data1['logoutuser'] = true;

        }

        return $data1;

    }

    public function logout(Request $request){

        $user_id = Auth::user()->user_id;
        $user = VendorUsers::where('user_id',$user_id)->first();

        try {
            Auth::logout();
            return redirect('/login');
        } catch (\Exception $e) {
              $this->sendError($e->getMessage(), 401);
        }
        
        $data1 = array();
        if(!Auth::check()){
          $data1['logoutuser'] = true;
        }
        return $data1;
    }

    public function newRegister(Request $request){



        $userId = $request->userId;

        $password=$request->password;

            $user=User::create([

                'name' => $request->email,

                'email' => $request->email,

                'password' => Hash::make($password),

            ]);

            DB::table('vendor_users')->insert([

                'user_id' => $user->id,

                'uuid' => $userId,

                'email' => $request->email,

            ]);
            

        $user = User::where('email',$request->email)->first();

        

        Auth::login($user,true);

        $signupdata = array();

        if(Auth::check()){

            $signupdata['access'] = true;

        }

        return $signupdata;

    }





}

