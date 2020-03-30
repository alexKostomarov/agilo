<?php

namespace App\Mail;

use App\SupportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportRequestChanged extends Mailable
{
    use Queueable, SerializesModels;

    protected $model;//модель запроса, отсылаемого по почте

    /**
     * Create a new message instance.
     *
     * @param SupportRequest $model
     */
    public function __construct(SupportRequest $model)
    {
        $this->model = $model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->model->user()->first();

        $subject = 'Заявка "' . $this->model->subject . '( id=' . $this->model->id . ' )"';

        $subject .= $this->model->is_closed ? " закрыта" : " изменена";

        return $this->from($user->email)->subject($subject)->view('email.request')->with([
            'msg'  => $this->model->message,
            'link' => $this->model->link
        ]);
    }
}
