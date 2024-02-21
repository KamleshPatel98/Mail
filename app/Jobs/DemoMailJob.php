<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\DemoMail;
use Mail;

class DemoMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $mailData;
    public function __construct($mailData)
    {
        $this->mailData=$mailData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('kamleshp52170@gmail.com')->send(new DemoMail($this->mailData));
        //echo $body;
    }
}
