@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @if (session('error'))
                        <div class="alert">
                            {{ session('error') }}
                        </div>
                        @else
                        <div class="alert">
                            Нет ошибок
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection
