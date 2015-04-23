@extends('layout')
@section('content')
    <div class="alert-success alert">
        <h3>{{ $message }}</h3>
        <em>Go to <a href="{{ $back_url }}">{{ $back_title }}</a></em>
    </div>
@stop