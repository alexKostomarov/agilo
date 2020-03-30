<?php

namespace App\Listeners;

use App\Events\RequestAnswered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;

class SendRequestAnsweredNotification
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
     * @param  RequestAnswered  $event
     * @return void
     */
    public function handle(RequestAnswered $event)
    {
        $answer = $event->answer;

        $support_request = $answer->support_request;

        $cur_user = Auth::user();



        //Ответ может быть или клиенту или менеджеру. Если текущий юзер клиент, то отвтет менеджеру
        if($cur_user->is_manager)   $recipient = $support_request->user;

        else $recipient = User::where("is_manager", true)->first();


        Mail::to($recipient)->send(new \App\Mail\RequestAnswered($answer) );
    }
}
