<?php

namespace App\Listeners;

use App\Events\SupportRequestChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


use App\User;
class SendSupportRequestNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SupportRequestChanged  $event
     * @return void
     */
    public function handle(SupportRequestChanged $event)
    {
        $model = $event->model;

        $manager = User::where('is_manager', true)->first();


        Mail::to($manager)->send(new \App\Mail\SupportRequestChanged($model) );


    }
}
