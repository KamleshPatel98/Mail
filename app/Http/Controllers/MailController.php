<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoMail;
use Mail;
use App\Jobs\DemoMailJob;

class MailController extends Controller
{
    public function index(){
        $mailData=[
            'title'=>'kamleshp52170@gmail.com',
            'body'=>'This is body',
        ];

        //Mail::to('karan52170@gmail.com')->send(new DemoMail($mailData));
        //DemoMailJob::dispatch($mailData['title'],$mailData['body']);
        DemoMailJob::dispatch($mailData);
        dd("Email send Successfuly");
    }
}
