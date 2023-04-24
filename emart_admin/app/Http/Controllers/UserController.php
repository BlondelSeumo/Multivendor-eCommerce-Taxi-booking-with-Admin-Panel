<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

     public function __construct()
    {
       $this->middleware('auth'); 
    }


	  public function index()
    {

        return view("settings.users.index");
    }


  public function edit($id)
  {
      return view('settings.users.edit')->with('id',$id);
  }

  public function profile()
  {
      $user = Auth::user();
      return view('settings.users.profile', compact(['user']));
  }

  public function update(Request $request,$id){
    $name = $request->input('name');
    $password = $request->input('password');
    $old_password = $request->input('old_password');
    $email = $request->input('email');
    
    if($password == ''){
        $validator = Validator::make($request->all(), [
    		'name' => 'required|max:255',
            'email'=>'required|email'
		]);   
    }else{
        $user = Auth::user();
        if(password_verify($old_password,$user->password)){
          $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'email'=>'required|email'
          ]);

        }else{
            return Redirect()->back()->with(['message' => "Please enter correct old password"]);
        }
     
    }

    if ($validator->fails()) {
      $error = $validator->errors()->first();
      return Redirect()->back()->with(['message' => $error]);
    } 

    $user = User::find($id);
    if($user) {
      $user->name = $name;
      $user->email = $email;
      if($password != ''){
          $user->password = Hash::make($password);
      }
      $user->save();
    }

    return redirect()->back();
  }

   public function create()
  {
      return view('settings.users.create');
  }


}
