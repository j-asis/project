@extends('layout')
@section('content')
    <div class="alert-success alert">
        <h3>{{ Session::get('message') }}</h3>
        <em>Go to <a href="{{ Session::get('back_url')  }}">{{ Session::get('back_title')  }}</a></em>
    </div>
@stop