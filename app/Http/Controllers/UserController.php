<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\DemoMail;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $insert=DB::table('users')->insert([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>$request['password'],
        ]);

        $otp=random_int(100000,999999);
        session()->put('push',$otp);
        $email=$request['email'];
        session()->put('email',$email);
        $time=time();
        session()->put('time',$time);
        $mailData=[
            'title'=>'Verification code',
            'body'=>$otp,
        ];
        Mail::to($request['email'],)->send(new DemoMail($mailData));
        return view('otp');
    }

    public function otp(Request $request){
        $getotp=session()->get('push');
        //return $getotp;
        
        $req=$request['otp'];
        $email=session()->get('email');

        $time=session()->get('time');
        $current=time();
        if($getotp==$req && $current - $time <= 120){
            DB::table('users')->where('email',$email)->update([
                'verify'=>'1',
            ]);
            return "verified";
        }else{
            return "otp is not correct";
        }
    }

    public function forgotForm(){
        return view('forgotForm');
    }

    public function forgot(Request $request){
        $email=$request['email'];
        session()->put('email',$email);
        $user=DB::select("SELECT * FROM `users` WHERE `email`='$email'");

        $otp=random_int(100000,999999);
        session()->put('otp',$otp);
        $mailData=[
            'title'=>'Change Password',
            'body'=>$otp,
        ];
        Mail::to($email)->send(new DemoMail($mailData));
        return view('forgot',compact('user'));
    }

    public function changePassword(Request $request){
        $otp=$request['otp'];
        $getotp=session()->get('otp');
        if($getotp==$otp){
            $pass=$request['password'];
            $email=session()->get('email');
            DB::update("UPDATE `users` SET `password`='$pass' WHERE `email`='$email' ");
            return "updated";
        }else{
            return "invalid otp";
        }
    }


    /**
     * Display the specified resource.
     */
    public function verify(Request $request)
    {
        DB::update("UPDATE `users` SET `verify`='1' WHERE `email`='$email'");
        return "verified";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
