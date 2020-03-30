@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <h2>{{$subject}}</h2>
                </div>
                <div class="row">
                    <h3>Клиент:{{$user_name}}</h3>
                </div>


                <div class="row">
                    <div class="m-md-3">{{$message}}</div>
                </div>
                <div class="row">
                    <div class="m-md-3">file:&nbsp;&nbsp;<a href="/storage/{{$file}}">file</a></div>
                </div>
                <div class="row">
                    <div class="offset-md-1 col-md-11">
                        @foreach($answers as $answer)
                            <div class="row m-md-3 border-bottom">
                                <div class="row col-md-10">{{$answer->answer}}</div>
                                <div class="row offset-md-2  col-md-2">ответил:&nbsp;{{$answer->user->name}}</div>
                                <div class="row offset-md-2  col-md-6">дата:&nbsp;{{$answer->updated_at}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div><a href="{{route('answer_create', ['support_request_id' => $id])}}">Ответить</a> </div>
                    &nbsp;
                    <div><a href="{{route('welcome')}}">К списку завявок</a> </div>
                </div>
            </div>
        </div>
    </div>
@endsection
