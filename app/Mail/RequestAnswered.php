<?php

namespace App\Mail;

use App\Answer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class RequestAnswered extends Mailable
{
    use Queueable, SerializesModels;

    protected $answer;//модель отвтета, из-за котрого отпавляется письмо
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $support_request = $this->answer->support_request->first();

        $from = Auth::user();

        $subject = 'Re: "' . $support_request->subject . '( id=' . $support_request->id . ' )"';

        return $this->from($from->email)->subject($subject)->view('email.answer')->with([
            'msg'  => $this->answer->answer,
        ]);
    }
}
