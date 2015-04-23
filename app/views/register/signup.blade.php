@extends('...layout')
@section('content')
    {{ Form::open(array('url' => route('register'), 'class' => 'form-register')) }}
        <h2 class="form-signin-heading">User Registration</h2>
        {{ HTML::ul($errors->all(), array('class'=>'errors alert alert-danger')) }}
        {{ Form::label('firstname', 'First Name', array('class' => 'sr-only')) }}
        {{ Form::text('firstname', '', array('class' => 'form-control', 'autofocus' , 'placeholder' => 'First Name')) }}
        {{ Form::label('lastname', 'Last Name', array('class' => 'sr-only')) }}
        {{ Form::text('lastname', '', array('class' => 'form-control', 'placeholder' => 'Last Name')) }}
        {{ Form::label('username', 'User Name', array('class' => 'sr-only')) }}
        {{ Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Username')) }}
        {{ Form::label('email', 'Email Address', array('class' => 'sr-only')) }}
        {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email address')) }}
        {{ Form::label('password', 'password', array('class' => 'sr-only')) }}
        {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password')) }}
        {{ Form::label('confirm_password', 'confirm_password', array('class' => 'sr-only')) }}
        {{ Form::password('confirm_password', array('class' => 'form-control', 'placeholder'=>'Confirm Password')) }}

        {{ Form::submit('Register', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    {{ Form::close() }}
@stop