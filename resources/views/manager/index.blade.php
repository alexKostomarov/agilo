@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Страница менеджера</h2>

                <div class="card">
                    <div class="row">
                        <div class="col-md-1 border-bottom border-right">id</div>
                        <div class="col-md-3 border-bottom border-right">Тема</div>
                        <div class="col-md-2 border-bottom border-right">Клиент</div>
                        <div class="col-md-2 border-bottom border-right">Просмотренные</div>
                        <div class="col-md-2 border-bottom border-right">С ответом</div>
                        <div class="col-md-2 border-bottom border-right">Закрытые</div>
                    </div>

                </div>


                <div class="card">
                    <div class="row">
                        <div class="offset-md-6 col-md-2 border-bottom border-right">
                            <select size="1" onchange="locateTo(this)">
                                <option value=""         @if($filters['viewed'] == 2) selected @endif>Все</option>
                                <option value="viewed=1" @if($filters['viewed'] == 1) selected @endif>Да</option>
                                <option value="viewed=0" @if($filters['viewed'] == 0) selected @endif>Нет</option>
                            </select>
                        </div>
                        <div class="col-md-2 border-bottom border-right">
                            <select size="1" onchange="locateTo(this)">
                                <option value=""         @if($filters['answered'] == 2) selected @endif>Все</option>
                                <option value="answered=1" @if($filters['answered'] == 1) selected @endif>Да</option>
                                <option value="answered=0" @if($filters['answered'] == 0) selected @endif>Нет</option>
                            </select>
                        </div>
                        <div class="col-md-2 border-bottom border-right">
                            <select size="1" onchange="locateTo(this)">
                                <option value=""         @if($filters['closed'] == 2) selected @endif>Все</option>
                                <option value="closed=1" @if($filters['closed'] == 1) selected @endif>Да</option>
                                <option value="closed=0" @if($filters['closed'] == 0) selected @endif>Нет</option>
                            </select>
                        </div>
                    </div>

                </div>
                @foreach($requests as $req)
                <div class="card">
                    <div class="row">
                        <div class="col-md-1 border-bottom border-right"><a href="{{route('request_view', ['id'=>$req->id])}}">{{$req->id}}</a></div>
                        <div class="col-md-3 border-bottom border-right"><a href="{{route('request_view', ['id'=>$req->id])}}">{{$req->subject}}</a></div>
                        <div class="col-md-2 border-bottom border-right">{{$req->user_id}}</div>
                        <div class="col-md-2 border-bottom border-right">@if($req->is_viewed) Да @else Нет @endif</div>
                        <div class="col-md-2 border-bottom border-right">@if($req->is_answered)Да @else Нет @endif</div>
                        <div class="col-md-2 border-bottom border-right">@if($req->is_closed)Да @else Нет @endif</div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

<script language="JavaScript">
    locateTo = function (select) {
        console.log(select);
        var filter = select.options[select.selectedIndex].value;
        console.log('{{route('manager')}}' + '/' + filter);
        window.location.href = '{{route('manager')}}' + '/' + filter ;
    }
</script>
