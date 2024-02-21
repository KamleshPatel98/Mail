<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\Demomail;
use Mail;

class Register extends Controller
{
    public function index(){
        return view('register');
    }

    public function store(Request $request){
        $email=$request['email'];
        session()->put('email',$email);

        DB::table('users')->insert([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>$request['password'],
        ]);

        $mailData=[
            'title'=>'Verification code',
            //'body'=>'<a href="{{ route('user.verify') }}">Click for verify</a>',
        ];
        Mail::to($email)->send(new DemoMail($mailData));
    }

    public function forgot(){
        return view('forgotreg');
    }

    public function forgotPass(Request $request){
        $email=$request['email'];
        //$select=DB::select("SELECT * FROM WHERE `email`='$email'");

        $mailData=[
            'title'=>'Forgot Passwors',
        ];
        Mail::to($email)->send(new DemoMail($mailData));
    }

    public function changepass(){
        return view('changeform');
    }

    public function changepassword(Request $request){
        $pass=$request['password'];
        $email=session()->get('email');
        DB::update("UPDATE `users` SET  `password`='$pass' WHERE `email`='$email'");
        return "successfully";
    }

    public function verify(Request $request){
        $otp=session()->get('otp');
        $email=session()->get('email');
        $getotp=$request['otp'];

        DB::table('users')->where('email',$email)->update([
            'verify'=>'1',
        ]);
        return "verified";
    }
}
