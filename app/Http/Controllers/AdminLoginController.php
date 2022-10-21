<?php

namespace App\Http\Controllers;

use App\Models\AdminLoginModel;
use App\Models\adminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminLoginController extends Controller
{


    function SignIn(){
        return view('Login.SignUpSignIn');
    }
    function OnSignIn(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $userCount=AdminLoginModel::where('email','=',$email)->where('password','=',$password)->count();
        if ($userCount==1){
            // $request->session()->put('email',$email);
            // $request->storage()->put('email',$email);
            Cookie::queue('email',$email,10);
            return 1;
        }
        else{
            return 0;
        }
    }

    function OnLogOut(Request $request){
        $request->session()->flush();
        \Cookie::queue(\Cookie::forget('email'));
        return redirect('/');
    }

    //password reset
    function resetPage(){
        return view('PasswordReset');
    }

    public function ResetPassword(Request $request){
        $password=$request->input('password');
        $id='1';
        $result= AdminLoginModel::where('id',$id)->update([
            'password'=>$password
        ]);
        return $result;
    }
    public function UserProfile($email){


        $result= adminModel::where('email',$email)->get();
        return $result;
    }
}
