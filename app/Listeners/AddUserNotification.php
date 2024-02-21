<?php

namespace App\Listeners;

use App\Events\AddUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddUserNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AddUser $event): void
    {
        Mail::to($event->mailData->email)->send(new DemoMail($event->mailData->name));
    }
}
