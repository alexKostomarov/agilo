@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <form id='create-request' action="{{$action}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="row  mb-md-4">
                        <label class="col-md-2">Тема сообщения</label>
                        <input class="offset-md-1 col-md-4" name="subject" value="{{$subject}}">
                    </div>
                    <div class="row mb-md-4">
                        <label class="col-md-2">Сообщение</label>
                        <textarea class="offset-md-1 col-md-4" name="message">{{$message}}</textarea>
                    </div>

                    <div class="row mb-md-4">
                        <label class="col-md-2">Файл</label>
                        <input type="file" class="offset-md-1 col-md-4" name="file" />
                        <div>{{$file ?? ""}}</div>
                    </div>

                    <div class="row">
                        <button class="offset-md-5 col-md-2" onclick="
                            event.preventDefault();
                            getElementById('create-request').submit();">
                            Отправить
                        </button>
                    </div>
                    <div class="row">
                        <a href="{{route("client")}}">К списку заявок</a>
                    </div>



                </form>
            </div>
        </div>
    </div>
@endsection
