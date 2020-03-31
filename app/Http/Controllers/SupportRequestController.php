<?php

namespace App\Http\Controllers;

use App\Events\SupportRequestChanged;
use Illuminate\Http\Request;
use App\SupportRequest;

class SupportRequestController extends Controller
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
     * Посмотреть заявку.
     * @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view(Request $request, $id)
    {
        $model = SupportRequest::findOrFail($id);

        $this->authorize('view', $model);

        $cur_user = $request->user();

        if( $cur_user->is_manager ){
            $model->is_viewed = true;
            $model->save();
        }



        //вывод формы
        return view('client\view',[
            'id' => $id,
            'user_name' => $model->user->name,
            'subject' => $model->subject,
            'message' => $model->message,
            'file' => $model->file,
            'answers' => $model->answers
        ]);

    }

    /**
     * Создать заявку.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        //Запись заявки в базу, и редирект на ее редактирование
        if($request->isMethod('post')){

            $subject = $request->post('subject', "");

            $message = $request->post('message', "");

            $path = null;

            $file_name = null;

            if ($request->hasFile('file')) {

                $file = $request->file('file');

                $path = $file->store("public");

                $file_name = strrchr($path, '/') ;
            }


            $model = new SupportRequest();

            $model->user_id = $request->user()->id;

            $model->subject = $subject;

            $model->message = $message;

            $model->file = $file_name;

            $model->link = bin2hex(random_bytes(16));

            $model->save();

            event(new SupportRequestChanged($model));

            return redirect()->route('request_view', ['id' => $model->id]);
        }
        //вывод формы
        return view('client.form',[
            'subject' => "",
            'message' => "",
            'action' => route('request_create')
        ]);
    }

    /**
     * Редактировать заявку.
     * @param int $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id)
    {
        $model = SupportRequest::findOrFail($id);

        $this->authorize('update', $model);

        //Запись заявки в базу, и редирект на ее редактирование
        if($request->isMethod('post')){

            $subject = $request->post('subject', "");

            $message = $request->post('message', "");

            $path = null;

            if ($request->hasFile('file')) {

                $file = $request->file('file');

                $path = $file->store("docs");
            }


            $model->subject = $subject;

            $model->message = $message;

            $model->file = $path;

            $model->save();

            event(new SupportRequestChanged($model));

            return redirect()->route('request_view', ['id' => $model->id]);
        }


        //вывод формы
        return view('client.form',[
            'id' => $model->id,
            'subject' => $model->subject,
            'message' => $model->message,
            'file' => $model->file,
            'action' => route('request_update', ['id' => $model->id])
        ]);
    }

    /**
     * Закрыть заявку.
     * @param  Request  $request
     *@param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function close(Request $request, $id)
    {
        $model = SupportRequest::findOrFail($id);

        $this->authorize('close', $model);

        $model->is_closed = true;

        $model->save();

        event(new SupportRequestChanged($model));

        return redirect()->route('client');
    }

    /**
     * Удалить заявку.
     * @param  Request  $request
     *@param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request, $id)
    {
        $model = SupportRequest::findOrFail($id);

        $this->authorize('delete', $model);

        $model->delete();

        return redirect()->route('client');
    }
}
