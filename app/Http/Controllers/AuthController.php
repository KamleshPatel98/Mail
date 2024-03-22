<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function registerForm(){
        return view('register');
    }

    public function register(Request $request){
        $$name=$request['name'];
        $rmail=$request['email'];
        session()->put('email',$email);
        $otp=random_int(100000,999999);
        session()->put('otp',$otp);
        $mailData=[
            'title'=>"Welcome to our Website $name",
            'body'=>"your verify otp is : $otp",
        ];
        Mail::to($email)->send(new VerifyMail($mailData));
        $insert=DB::table('users')->insert([
            'name'=>$name,
            'email'=>$request['email'],
            'password'=>bcrypt($request['password']),
        ]);

        return view('otp');
    }

    public function verify(Request $request){
        $email=session()->get('email');
        $otp=session()->get('otp');
        if($otp==$request['otp']){
            DB::table('users')->where('email',$email)->update(['verify'=>1]);
                return "Verified";
        }else{
            return "Otp is not correct";
        }
    }

    public function loginForm(){
        return view('login');
    }

    public function login(Request $request){
        $email=$request['email'];
        $password=$request['password'];

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect()->route('dashboard')->with('success','Sign in successfully');
        }
        else{
            return "something went wrong";
        }
    }
}
