<?php

namespace App\Http\Controllers;

use App\Events\RequestAnswered;
use App\Events\SupportRequestChanged;
use App\SupportRequest;
use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Создать ответ.
     *
     * @param Request $request
     * @param int $support_request_id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request, $support_request_id)
    {
        //сообщения могут отправлять либо менеджеры, либо клиенты, создавшие заявку

        //заявка
        $support_request = SupportRequest::findOrFail($support_request_id);

        if( $support_request->user_id !== $request->user()->id && !$request->user()->is_manager) abort(403, 'Unauthorized action.');

        if($request->user()->is_manager){
            $support_request->is_answered = true;
            $support_request->save();
        }

        //Запись Отвтета в базу, и редирект на его редактирование
        if($request->isMethod('post')){

            $model = new Answer();

            $model->user_id = $request->user()->id;

            $model->support_request_id = $support_request_id;

            $model->answer = $request->post('answer', NULL);

            $model->save();

            event(new RequestAnswered($model));

            return redirect()->route('request_view', ['id' => $support_request_id]);
        }
        //вывод формы
        return view('answer\form',[
            'answer' => "",
            'action' => route('answer_create', ['support_request_id' => $support_request_id]),
            'support_request_id' => $support_request_id
        ]);
    }

    /**
     * Редактировать ответ.
     * @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {
        $model = Answer::findOrFail($id);

        $this->authorize('update', $model);


        //Запись ответа в базу, и редирект на ее редактирование
        if($request->isMethod('post')){

            $model->answer = $request->post('answer', NULL);

            $model->save();

            //event(new SupportRequestChanged($model));

            return redirect()->route('answer_update', ['id' => $model->id]);
        }
        //вывод формы
        return view('answer\form',[
            'answer' => $model->answer,
            'action' => route('answer_update', ['id' => $model->id]),
            'support_request_id' => $model->support_request->id
        ]);
    }
}
