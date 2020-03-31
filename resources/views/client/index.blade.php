@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h1>Страница клиента {{Auth::user()->name}}</h1>

                    @if(Auth::user()->is_manager)
                        <div><a  href="{{ route('manager') }}"> перейти на страницу менеджера</a></div>
                    @endif
                    <div class="request-new">
                        <a href="{{route('request_create')}}">Подать заявку</a>
                    </div>
                    <div class="request-list">
                        <h1>Список заявок</h1>
                        <div class="request-head row">
                            <div class="col-md-4">Тема</div>
                            <div class="col-md-2">Просмотрена</div>
                            <div class="col-md-2">Есть ответ</div>
                            <div class="col-md-2">Закрыта</div>
                         </div>
                        @foreach($requests as $request)
                            <div class="request row">
                                <div class="subject col-md-4">
                                    @if($request->is_closed)
                                        {{$request->subject}}
                                    @else
                                        <a href="{{route('request_view', ['id' => $request->id])}}">{{$request->subject}}</a>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if($request->is_viewed)
                                        просмотрена
                                    @else
                                        не просмотрена
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if($request->is_answered)
                                        есть ответ
                                    @else
                                        еще нет ответа
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if($request->is_closed)
                                        закрыта
                                    @else
                                        <a href="{{route("request_close", ['id' => $request->id])}}">закрыть</a>
                                    @endif
                                </div>
                                
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
