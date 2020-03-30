@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <form id='create-answer' action="{{$action}}" method="post">
                    @csrf

                    <div class="row mb-md-4">
                        <label class="col-md-2">Сообщение</label>
                        <textarea class="offset-md-1 col-md-4" name="answer">{{$answer}}</textarea>
                    </div>


                    <div class="row">
                        <button class="offset-md-5 col-md-2" onclick="
                            event.preventDefault();
                            getElementById('create-answer').submit();">
                            Отправить
                        </button>
                    </div>
                    <div class="row">
                        <a href="{{route("client")}}">К списку заявок</a>

                        <a href="{{route("request_view", ['id' => $support_request_id] )}}"  class="offset-md-1">к заявке</a>

                    </div>



                </form>
            </div>
        </div>
    </div>
@endsection
