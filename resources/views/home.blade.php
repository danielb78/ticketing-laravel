@extends('layouts/master')
@section('title', 'Home')
@section('content')
    <div class="row banner">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-md-12">
            <h1 class="text-center margin-top-100 editContent">
                Ticketing System
            </h1>
            <h3 class="text-center margin-top-100 editContent">{!! trans('main.subtitle') !!}</h3>
            <div class="text-center">
                <img src="img/ticketing.jpg" width="292" height="385" alt="Placeholder for ticketing">
            </div>
        </div>
    </div>
    </div>
@endsection