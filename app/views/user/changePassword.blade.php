@extends('...layout')
@section('content')
{{ Form::open(array('url' => route('save_password'), 'class' => 'form-register')) }}
    <h2 class="form-signin-heading">Change Password</h2>
    {{ HTML::ul($errors->all(), array('class'=>'errors alert alert-danger')) }}
    {{ Form::label('password', 'Old Password') }}
    {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Old Password', 'required')) }}
    {{ Form::label('new_password', 'New Password') }}
    {{ Form::password('new_password', array('class' => 'form-control', 'placeholder'=>'New Password', 'required')) }}
    {{ Form::label('confirm_password', 'Confirm Password') }}
    {{ Form::password('confirm_password', array('class' => 'form-control', 'placeholder'=>'Confirm Password', 'required')) }}

    {{ Form::submit('Change Password', array('class' => 'btn btn-lg btn-primary btn-block')) }}
{{ Form::close() }}
@stop