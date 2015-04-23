@extends('...layout')
@section('content')

    {{ Form::open(array('url' => route('update'), 'class' => 'form-register')) }}
        <h2 class="form-signin-heading">Update Profile</h2>

        {{ HTML::ul($errors->all(), array('class'=>'errors alert alert-danger')) }}
        {{ Form::label('firstname', 'First Name') }}
        {{ Form::text('firstname', $current_user->firstname, array('class' => 'form-control', 'required', 'autofocus' , 'placeholder' => 'First Name')) }}
        {{ Form::label('lastname', 'Last Name') }}
        {{ Form::text('lastname', $current_user->lastname, array('class' => 'form-control', 'required', 'placeholder' => 'Last Name')) }}
        {{ Form::label('username', 'User Name') }}
        {{ Form::text('username', $current_user->username, array('class' => 'form-control', 'required', 'placeholder' => 'Username')) }}
        {{ Form::label('email', 'Email Address') }}
        {{ Form::email('email', $current_user->email, array('class' => 'form-control', 'required', 'placeholder' => 'Email address')) }}

        {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    {{ Form::close() }}

@stop