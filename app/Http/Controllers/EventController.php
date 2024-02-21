<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\DemoMail;
use Mail;
use App\Events\AddUser;

class EventController extends Controller
{
    public function index(){
        $mailData=User::create([
            'name'=>'kamlesh',
            'email'=>'kamaleshp52170@gmail.com',
            'password'=>'1234',
        ]);
        if($mailData){
            // $mailData=[
            //     'title'=>'hello',
            //     'body'=>'hello world',
            // ];
            // Mail::to('kamleshp52170@gmail.com')->send(new DemoMail($mailData));
            event(new AddUser($mailData));
            echo "Success";
        }else{
            echo "failed";
        }
    }
}
